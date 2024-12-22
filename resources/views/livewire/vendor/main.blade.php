<div class="p-6 space-y-6">
    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Time Period</label>
                <select wire:model.live="selectedPeriod" class="w-full rounded-md border-gray-300">
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                <input type="date" wire:model.live="startDate" class="w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                <input type="date" wire:model.live="endDate" class="w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Vendor</label>
                <select wire:model.live="selectedVendor" class="w-full rounded-md border-gray-300">
                    <option value="">All Vendors</option>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor }}">{{ $vendor }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-900">
                        Rp {{ number_format($kpis['totalRevenue']) }}
                    </p>
                    <p class="text-sm text-gray-600 mt-1">
                        Avg: Rp {{ number_format($kpis['avgProjectValue']) }}
                    </p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                   </svg>
               </div>
           </div>
       </div>

       <!-- Total Projects -->
       <div class="bg-white rounded-lg shadow p-6">
           <div class="flex justify-between items-start">
               <div>
                   <p class="text-sm font-medium text-gray-600">Total Projects</p>
                   <p class="text-2xl font-bold text-gray-900">{{ $kpis['totalProjects'] }}</p>
                   <p class="text-sm text-gray-600 mt-1">
                       Pending: {{ $kpis['pendingProjects'] }}
                   </p>
               </div>
               <div class="p-3 bg-blue-100 rounded-full">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                   </svg>
               </div>
           </div>
       </div>

       <!-- Active Vendors -->
       <div class="bg-white rounded-lg shadow p-6">
           <div class="flex justify-between items-start">
               <div>
                   <p class="text-sm font-medium text-gray-600">Active Vendors</p>
                   <p class="text-2xl font-bold text-gray-900">{{ $kpis['activeVendors'] }}</p>
                   <p class="text-sm text-gray-600 mt-1">
                       Partners Network
                   </p>
               </div>
               <div class="p-3 bg-purple-100 rounded-full">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                   </svg>
               </div>
           </div>
       </div>

       <!-- Lead Conversion -->
       <div class="bg-white rounded-lg shadow p-6">
           <div class="flex justify-between items-start">
               <div>
                   <p class="text-sm font-medium text-gray-600">Lead Conversion</p>
                   <p class="text-2xl font-bold text-gray-900">{{ number_format($kpis['conversionRate'], 1) }}%</p>
                   <p class="text-sm text-gray-600 mt-1">
                       Active Leads: {{ $kpis['activeLeads'] }}
                   </p>
               </div>
               <div class="p-3 bg-yellow-100 rounded-full">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                   </svg>
               </div>
           </div>
       </div>
   </div>

   <!-- Charts Section -->
   <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
       <!-- Revenue Trend Chart -->
       <div class="bg-white rounded-lg shadow p-6">
           <h3 class="text-lg font-semibold mb-4">Revenue Trend</h3>
           <div class="h-[400px]" wire:ignore>
               <canvas id="revenueTrendChart"></canvas>
           </div>
       </div>

       <!-- Project Status Distribution -->
       <div class="bg-white rounded-lg shadow p-6">
           <h3 class="text-lg font-semibold mb-4">Project Status</h3>
           <div class="h-[400px]" wire:ignore>
               <canvas id="projectStatusChart"></canvas>
           </div>
       </div>

       <!-- Customer Growth -->
       <div class="bg-white rounded-lg shadow p-6">
           <h3 class="text-lg font-semibold mb-4">Customer Growth</h3>
           <div class="h-[400px]" wire:ignore>
               <canvas id="customerGrowthChart"></canvas>
           </div>
       </div>

       <!-- Lead Conversion Funnel -->
       <div class="bg-white rounded-lg shadow p-6">
           <h3 class="text-lg font-semibold mb-4">Lead Conversion Funnel</h3>
           <div class="h-[400px]" wire:ignore>
               <canvas id="leadConversionChart"></canvas>
           </div>
       </div>
   </div>

   <!-- Project Timeline -->
   <div class="bg-white rounded-lg shadow p-6">
       <h3 class="text-lg font-semibold mb-4">Project Timeline</h3>
       <div class="h-[400px]" wire:ignore>
           <div id="projectTimelineChart"></div>
       </div>
   </div>

   <!-- Recent Activities Grid -->
   <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
       <!-- Recent Projects -->
       <div class="bg-white rounded-lg shadow">
           <div class="p-6">
               <h3 class="text-lg font-semibold mb-4">Recent Projects</h3>
               <div class="overflow-x-auto">
                   <table class="min-w-full divide-y divide-gray-200">
                       <thead>
                           <tr>
                               <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                               <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vendor</th>
                               <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                               <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                           </tr>
                       </thead>
                       <tbody class="bg-white divide-y divide-gray-200">
                           @foreach($recentProjects as $project)
                           <tr>
                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                   {{ $project->project_header }}
                               </td>
                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                   {{ $project->vendor->vendor_name ?? 'N/A' }}
                               </td>
                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                   Rp {{ number_format($project->project_value) }}
                               </td>
                               <td class="px-6 py-4 whitespace-nowrap">
                                   @php
                                       $status = now()->between(
                                           Carbon\Carbon::parse($project->project_duration_start),
                                           Carbon\Carbon::parse($project->project_duration_end)
                                       ) ? 'In Progress' : (now()->lt(Carbon\Carbon::parse($project->project_duration_start)) ? 'Upcoming' : 'Completed');
                                       
                                       $statusClasses = [
                                           'In Progress' => 'bg-yellow-100 text-yellow-800',
                                           'Upcoming' => 'bg-blue-100 text-blue-800',
                                           'Completed' => 'bg-green-100 text-green-800',
                                       ][$status];
                                   @endphp
                                   <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses }}">
                                       {{ $status }}
                                   </span>
                               </td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </div>

       <!-- Top Performing Products -->
       <div class="bg-white rounded-lg shadow">
           <div class="p-6">
               <h3 class="text-lg font-semibold mb-4">Top Products</h3>
               <div class="space-y-4">
                   @foreach($topProducts as $product)
                   <div class="flex items-center justify-between">
                       <div class="flex items-center">
                           <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                               </svg>
                           </div>
                           <div class="ml-4">
                               <p class="text-sm font-medium text-gray-900">{{ $product->product_name }}</p>
                               <p class="text-sm text-gray-500">{{ $product->product_category }}</p>
                           </div>
                       </div>
                       <div class="text-right">
                           <p class="text-sm font-medium text-gray-900">{{ $product->sales_count }} sales</p>
                           <p class="text-sm text-gray-500">Rp {{ number_format($product->product_price) }}</p>
                       </div>
                   </div>
                   @endforeach
               </div>
           </div>
       </div>
   </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('livewire:load', function() {
   // Revenue Trend Chart
   const revenueTrendCtx = document.getElementById('revenueTrendChart').getContext('2d');
   const revenueTrendChart = new Chart(revenueTrendCtx, {
       type: 'line',
       data: {
           labels: @json($chartData['revenueTrend']['labels']),
           datasets: [{
               label: 'Revenue',
               data: @json($chartData['revenueTrend']['data']),
               borderColor: '#10B981',
               tension: 0.4,
               fill: false
           }]
       },
       options: {
           responsive: true,
           plugins: {
               legend: { position: 'top' }
           },
           scales: {
               y: {
                   beginAtZero: true,
                   ticks: {
                       callback: value => 'Rp ' + value.toLocaleString()
                   }
               }
           }
       }
   });

   // Project Status Chart
   const projectStatusCtx = document.getElementById('projectStatusChart').getContext('2d');
   const projectStatusChart = new Chart(projectStatusCtx, {
       type: 'doughnut',
       data: {
           labels: @json($chartData['projectStatus']['labels']),
           datasets: [{
               data: @json($chartData['projectStatus']['data']),
               backgroundColor: ['#3B82F6', '#10B981', '#F59E0B']
           }]
       },
       options: {
           responsive: true,
           plugins: {
               legend: { position: 'bottom' }
           }
       }
   });

   // Customer Growth Chart
   const customerGrowthCtx = document.getElementById('customerGrowthChart').getContext('2d');
   const customerGrowthChart = new Chart(customerGrowthCtx, {
       type: 'bar',
       data: {
           labels: @json($chartData['customerGrowth']['labels']),
           datasets: [{
               label: 'New Customers',
               data: @json($chartData['customerGrowth']['data']),
               backgroundColor: '#6366F1'
           }]
       },
       options: {
           responsive: true,
           plugins: {
               legend: { position: 'top' }
           },
           scales: {
               y: { beginAtZero: true }
           }
       }
   });

   // Lead Conversion Chart
   const leadConversionCtx = document.getElementById('leadConversionChart').getContext('2d');
   const leadConversionChart = new Chart(leadConversionCtx, {
       type: 'pie',
       data: {
           labels: @json($chartData['leadConversion']['labels']),
           datasets: [{
               data: @json($chartData['leadConversion']['data']),
               backgroundColor: ['#EF4444', '#F59E0B', '#10B981']
           }]
       },
       options: {
           responsive: true,
           plugins: {
               legend: { position: 'bottom' }
           }
       }
   });

   // Project Timeline Chart
   const timelineOptions = {
       series: [{
           data: @json($chartData['timelineData'])
       }],
       chart: {
           height: 350,
           type: 'rangeBar',
           toolbar: { show: false }
       },
       plotOptions: {
           bar: {
               horizontal: true,
               distributed: true,
               dataLabels: {
                   hideOverflowingLabels: false
               }
           }
       },
       xaxis: {
           type: 'datetime'
       },
       tooltip: {
           custom: function({series, seriesIndex, dataPointIndex, w}) {
               const project = w.config.series[seriesIndex].data[dataPointIndex];