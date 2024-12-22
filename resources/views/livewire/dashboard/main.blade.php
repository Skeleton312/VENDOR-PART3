<div>
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
                        @foreach ($vendors as $vendor)
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
                        <x-heroicon-o-currency-dollar class="h-6 w-6 text-green-600" />
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
                        <x-heroicon-o-clipboard-document-list class="h-6 w-6 text-blue-600" />
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
                        <x-heroicon-o-user-group class="h-6 w-6 text-purple-600" />
                    </div>
                </div>
            </div>

            <!-- Lead Conversion -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Lead Conversion</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ number_format($kpis['conversionRate'], 1) }}%
                        </p>
                        <p class="text-sm text-gray-600 mt-1">
                            Active Leads: {{ $kpis['activeLeads'] }}
                        </p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <x-heroicon-o-chart-bar class="h-6 w-6 text-yellow-600" />
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
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Project</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vendor</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Value</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($recentProjects as $project)
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
                                                    Carbon\Carbon::parse($project->project_duration_end),
                                                )
                                                    ? 'In Progress'
                                                    : (now()->lt(Carbon\Carbon::parse($project->project_duration_start))
                                                        ? 'Upcoming'
                                                        : 'Completed');

                                                $statusClasses = [
                                                    'In Progress' => 'bg-yellow-100 text-yellow-800',
                                                    'Upcoming' => 'bg-blue-100 text-blue-800',
                                                    'Completed' => 'bg-green-100 text-green-800',
                                                ][$status];
                                            @endphp
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses }}">
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
                        @foreach ($topProducts as $product)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                        <x-heroicon-o-cube class="h-6 w-6 text-gray-600" />
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">{{ $product->product_name }}</p>
                                        <p class="text-sm text-gray-500">{{ $product->product_category }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">{{ $product->sales_count }} sales</p>
                                    <p class="text-sm text-gray-500">Rp {{ number_format($product->product_price) }}
                                    </p>
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
            document.addEventListener('livewire:init', function() {
                Livewire.on('refreshCharts', () => {
                    initCharts();
                });

                function initCharts() {
                    // Pastikan data tersedia sebelum membuat chart
                    const chartData = @json($chartData);

                    // Revenue Trend Chart
                    const revenueTrendCtx = document.getElementById('revenueTrendChart');
                    if (chartData.revenueTrend.labels.length > 0 && revenueTrendCtx) {
                        new Chart(revenueTrendCtx.getContext('2d'), {
                            type: 'line',
                            data: {
                                labels: chartData.revenueTrend.labels,
                                datasets: [{
                                    label: 'Revenue',
                                    data: chartData.revenueTrend.data,
                                    borderColor: '#10B981',
                                    tension: 0.4,
                                    fill: false
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top'
                                    }
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
                    } else {
                        // Fallback jika tidak ada data
                        revenueTrendCtx.innerHTML =
                            '<div class="text-center text-gray-500 py-4">No revenue data available</div>';
                    }

                    // Project Status Chart
                    const projectStatusCtx = document.getElementById('projectStatusChart');
                    if (chartData.projectStatus.labels.length > 0 && projectStatusCtx) {
                        new Chart(projectStatusCtx.getContext('2d'), {
                            type: 'doughnut',
                            data: {
                                labels: chartData.projectStatus.labels,
                                datasets: [{
                                    data: chartData.projectStatus.data,
                                    backgroundColor: ['#3B82F6', '#10B981', '#F59E0B']
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }
                        });
                    } else {
                        projectStatusCtx.innerHTML =
                            '<div class="text-center text-gray-500 py-4">No project status data available</div>';
                    }

                    // Customer Growth Chart
                    const customerGrowthCtx = document.getElementById('customerGrowthChart');
                    if (chartData.customerGrowth.labels.length > 0 && customerGrowthCtx) {
                        new Chart(customerGrowthCtx.getContext('2d'), {
                            type: 'bar',
                            data: {
                                labels: chartData.customerGrowth.labels,
                                datasets: [{
                                    label: 'New Customers',
                                    data: chartData.customerGrowth.data,
                                    backgroundColor: '#6366F1'
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    } else {
                        customerGrowthCtx.innerHTML =
                            '<div class="text-center text-gray-500 py-4">No customer growth data available</div>';
                    }

                    // Lead Conversion Chart
                    const leadConversionCtx = document.getElementById('leadConversionChart');
                    if (chartData.leadConversion.labels.length > 0 && leadConversionCtx) {
                        new Chart(leadConversionCtx.getContext('2d'), {
                            type: 'pie',
                            data: {
                                labels: chartData.leadConversion.labels,
                                datasets: [{
                                    data: chartData.leadConversion.data,
                                    backgroundColor: ['#EF4444', '#F59E0B', '#10B981']
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }
                        });
                    } else {
                        leadConversionCtx.innerHTML =
                            '<div class="text-center text-gray-500 py-4">No lead conversion data available</div>';
                    }

                    // Project Timeline Chart (ApexCharts)
                    const timelineChart = document.getElementById('projectTimelineChart');
                    if (chartData.timelineData.length > 0 && timelineChart) {
                        const timelineOptions = {
                            series: [{
                                data: chartData.timelineData
                            }],
                            chart: {
                                height: 350,
                                type: 'rangeBar',
                                toolbar: {
                                    show: false
                                }
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
                                custom: function({
                                    series,
                                    seriesIndex,
                                    dataPointIndex,
                                    w
                                }) {
                                    const project = w.config.series[seriesIndex].data[dataPointIndex];
                                    const startDate = new Date(project.y[0]).toLocaleDateString();
                                    const endDate = new Date(project.y[1]).toLocaleDateString();

                                    return `
                        <div class="p-2">
                            <strong>${project.x}</strong><br>
                            Start: ${startDate}<br>
                            End: ${endDate}
                        </div>
                    `;
                                }
                            }
                        };

                        const projectTimelineChart = new ApexCharts(timelineChart, timelineOptions);
                        projectTimelineChart.render();
                    } else {
                        timelineChart.innerHTML =
                            '<div class="text-center text-gray-500 py-4">No project timeline data available</div>';
                    }
                }

                // Panggil fungsi inisialisasi chart
                document.addEventListener('livewire:init', initCharts);

                // Initial chart rendering
                initCharts();
            });
        </script>
    @endpush
</div>
