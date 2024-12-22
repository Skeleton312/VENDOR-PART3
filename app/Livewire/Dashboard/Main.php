<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Project;
use App\Models\Vendor;
use App\Models\Customer;
use App\Models\CustomerInteraction;
use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\Lead;
use App\Models\MarketingCampaign;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Main extends Component
{
    public $selectedVendor = '';
    public $startDate;
    public $endDate;
    public $selectedPeriod = 'monthly';

    public function mount()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');
    }

    public function updatedSelectedPeriod()
    {
        switch($this->selectedPeriod) {
            case 'weekly':
                $this->startDate = now()->startOfWeek()->format('Y-m-d');
                $this->endDate = now()->endOfWeek()->format('Y-m-d');
                break;
            case 'monthly':
                $this->startDate = now()->startOfMonth()->format('Y-m-d');
                $this->endDate = now()->endOfMonth()->format('Y-m-d');
                break;
            case 'yearly':
                $this->startDate = now()->startOfYear()->format('Y-m-d');
                $this->endDate = now()->endOfYear()->format('Y-m-d');
                break;
        }
    }

    protected function getFilteredQuery()
    {
        return Project::query()
            ->join('vendors', 'projects.vendor_id', '=', 'vendors.vendor_id')
            ->when($this->startDate && $this->endDate, function($q) {
                return $q->whereBetween('project_duration_start', [
                    Carbon::parse($this->startDate),
                    Carbon::parse($this->endDate)
                ]);
            })
            ->when($this->selectedVendor, function($q) {
                return $q->where('vendors.vendor_name', $this->selectedVendor);
            });
    }

    protected function getChartData()
    {
        // Revenue Trend Data
        $revenueTrend = $this->getFilteredQuery()
            ->selectRaw('DATE_FORMAT(project_duration_start, "%Y-%m") as month, IFNULL(SUM(project_value), 0) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Project Status Distribution
        $projectStatus = Project::selectRaw('
            CASE 
                WHEN project_duration_start > NOW() THEN "Upcoming"
                WHEN project_duration_end < NOW() THEN "Completed"
                ELSE "In Progress"
            END as status,
            COUNT(*) as count
        ')
        ->groupBy('status')
        ->get();

        // Customer Growth
        $customerGrowth = Customer::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->limit(12)
            ->get();

        // Lead Conversion Rate
        $leadConversion = DB::table('leads')
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Project Timeline Data
        $timelineData = $this->getFilteredQuery()
            ->get()
            ->map(function($project) {
                $start = Carbon::parse($project->project_duration_start);
                $end = Carbon::parse($project->project_duration_end);
                
                return [
                    'x' => $project->project_header,
                    'y' => [
                        strtotime($start) * 1000, 
                        strtotime($end) * 1000
                    ],
                    'fillColor' => now()->between($start, $end) ? '#3B82F6' : 
                        (now()->lt($start) ? '#FCD34D' : '#10B981')
                ];
            });

        return [
            'revenueTrend' => [
                'labels' => $revenueTrend->pluck('month')->toArray() ?: ['No Data'],
                'data' => $revenueTrend->pluck('total')->toArray() ?: [0],
            ],
            'projectStatus' => [
                'labels' => $projectStatus->pluck('status')->toArray() ?: ['No Status'],
                'data' => $projectStatus->pluck('count')->toArray() ?: [0],
            ],
            'customerGrowth' => [
                'labels' => $customerGrowth->pluck('month')->toArray() ?: ['No Data'],
                'data' => $customerGrowth->pluck('count')->toArray() ?: [0],
            ],
            'leadConversion' => [
                'labels' => $leadConversion->pluck('status')->toArray() ?: ['No Status'],
                'data' => $leadConversion->pluck('count')->toArray() ?: [0],
            ],
            'timelineData' => $timelineData->toArray(),
        ];
    }

    protected function getKPIs()
    {
        return [
            'totalProjects' => $this->getFilteredQuery()->count(),
            'totalRevenue' => $this->getFilteredQuery()->sum('project_value'),
            'activeVendors' => User::where('role', 'Vendor')->count(),
            'pendingProjects' => Project::whereDate('project_duration_start', '>', now())->count(),
            'activeLeads' => Lead::where('status', 'follow up')->count(),
            'conversionRate' => Lead::where('status', 'follow up')->count() / (Lead::count() ?: 1) * 100,
            'avgProjectValue' => $this->getFilteredQuery()->avg('project_value') ?? 0,
        ];
    }

    public function render()
    {
        $chartData = $this->getChartData();
        $kpis = $this->getKPIs();
        
        $this->dispatch('chartDataReady', $chartData);

        return view('livewire.dashboard.main', [
            'chartData' => $chartData,
            'kpis' => $kpis,
            'vendors' => Vendor::pluck('vendor_name'),
            'recentProjects' => Project::with(['vendor', 'customer'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
            'topProducts' => Product::withCount(['salesDetails'])
                ->orderBy('sales_details_count', 'desc')
                ->limit(5)
                ->get(),
        ]);
    }
}