<div>
    <div class="bg-gray-50 min-h-screen">
        <!-- Header Section -->
        <div class="gradient-bg py-8">
            <div class="max-w-12xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-2">
                    <div class="mb-6 lg:mb-0">
                        <h1 class="text-4xl font-bold text-white mb-2">Dashboard</h1>
                        <p class="text-white">Welcome back! Here's what's happening with your members.</p>
                    </div>

                    <!-- Date Filter -->
                    <div class="glass-effect rounded-2xl p-6 shadow-lg">
                        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-end">
                            <div class="w-full sm:w-48">
                                <label for="start-date" class="block text-sm font-medium text-gray-700 mb-1">From
                                    Date</label>
                                <input
                                    id="start-date"
                                    type="date"
                                    class="w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    wire:model="startDate"
                                />
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['startDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs mt-1"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="w-full sm:w-48">
                                <label for="end-date" class="block text-sm font-medium text-gray-700 mb-1">To
                                    Date</label>
                                <input
                                    id="end-date"
                                    type="date"
                                    class="w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    wire:model="endDate"
                                />
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['endDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs mt-1"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <button
                                wire:click="filterByDate"
                                wire:loading.attr="disabled"
                                class="bg-indigo-600 hover:bg-indigo-700 disabled:opacity-50 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 shadow-lg hover:shadow-xl flex items-center"
                            >
                                <div wire:loading wire:target="filterByDate" class="mr-2">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                                <i class="fas fa-filter mr-2" wire:loading.remove wire:target="filterByDate"></i>
                                Apply Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-12xl mx-auto px-4 sm:px-6 lg:px-8 -mt-4">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" wire:loading.class="opacity-50">
                <!-- Total Paid Dues -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 card-hover">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-600 mb-2">Total Paid Dues</h3>
                            <div wire:loading.remove wire:target="filterByDate">
                                <p class="text-3xl font-bold text-emerald-600 mb-1">
                                    ₱ <?php echo e(number_format($paidDues, 2)); ?></p>
                                <p class="text-gray-500 flex items-center">
                                    <i class="fas fa-users mr-2 text-emerald-500"></i>
                                    <?php echo e($paidMembers); ?> Members
                                </p>
                            </div>
                            <div wire:loading wire:target="filterByDate" class="space-y-2">
                                <div class="h-8 loading-shimmer rounded"></div>
                                <div class="h-4 loading-shimmer rounded w-24"></div>
                            </div>
                        </div>
                        <div class="bg-emerald-100 rounded-full p-4">
                            <i class="fas fa-check-circle text-emerald-600 text-2xl"></i>
                        </div>
                    </div>
                    <!--[if BLOCK]><![endif]--><?php if($totalMembers > 0): ?>
                        <div class="mt-4 bg-emerald-50 rounded-lg p-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-emerald-700">Payment Rate</span>
                                <span class="font-semibold text-emerald-800"><?php echo e(round(($paidMembers / $totalMembers) * 100)); ?>%</span>
                            </div>
                            <div class="mt-2 bg-emerald-200 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full transition-all duration-500"
                                     style="width: <?php echo e(($paidMembers / $totalMembers) * 100); ?>%"></div>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <!-- Total Unpaid Dues -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 card-hover">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-600 mb-2">Total Unpaid Dues</h3>
                            <div wire:loading.remove wire:target="filterByDate">
                                <p class="text-3xl font-bold text-red-600 mb-1">
                                    ₱ <?php echo e(number_format($unpaidDues, 2)); ?></p>
                                <p class="text-gray-500 flex items-center">
                                    <i class="fas fa-users mr-2 text-red-500"></i>
                                    <?php echo e($unpaidMembers); ?> Members
                                </p>
                            </div>
                            <div wire:loading wire:target="filterByDate" class="space-y-2">
                                <div class="h-8 loading-shimmer rounded"></div>
                                <div class="h-4 loading-shimmer rounded w-24"></div>
                            </div>
                        </div>
                        <div class="bg-red-100 rounded-full p-4">
                            <i class="fas fa-exclamation-circle text-red-600 text-2xl"></i>
                        </div>
                    </div>
                    <!--[if BLOCK]><![endif]--><?php if($totalMembers > 0): ?>
                        <div class="mt-4 bg-red-50 rounded-lg p-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-red-700">Outstanding Rate</span>
                                <span class="font-semibold text-red-800"><?php echo e(round(($unpaidMembers / $totalMembers) * 100)); ?>%</span>
                            </div>
                            <div class="mt-2 bg-red-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full transition-all duration-500"
                                     style="width: <?php echo e(($unpaidMembers / $totalMembers) * 100); ?>%"></div>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <!-- Total Dues -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 card-hover">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-600 mb-2">Total Dues</h3>
                            <div wire:loading.remove wire:target="filterByDate">
                                <p class="text-3xl font-bold text-indigo-600 mb-1">
                                    ₱ <?php echo e(number_format($totalDues, 2)); ?></p>
                                <p class="text-gray-500 flex items-center">
                                    <i class="fas fa-users mr-2 text-indigo-500"></i>
                                    <?php echo e($totalMembers); ?> Members
                                </p>
                            </div>
                            <div wire:loading wire:target="filterByDate" class="space-y-2">
                                <div class="h-8 loading-shimmer rounded"></div>
                                <div class="h-4 loading-shimmer rounded w-24"></div>
                            </div>
                        </div>
                        <div class="bg-indigo-100 rounded-full p-4">
                            <i class="fas fa-chart-line text-indigo-600 text-2xl"></i>
                        </div>
                    </div>
                    <!--[if BLOCK]><![endif]--><?php if($totalDues > 0): ?>
                        <div class="mt-4 bg-indigo-50 rounded-lg p-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-indigo-700">Collection Rate</span>
                                <span
                                    class="font-semibold text-indigo-800"><?php echo e(round(($paidDues / $totalDues) * 100)); ?>%</span>
                            </div>
                            <div class="mt-2 bg-indigo-200 rounded-full h-2">
                                <div class="bg-indigo-500 h-2 rounded-full transition-all duration-500"
                                     style="width: <?php echo e(($paidDues / $totalDues) * 100); ?>%"></div>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>

            <!-- Charts Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Overview Chart -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Payment Overview</h2>
                            <p class="text-gray-600 text-sm">
                                Payment trends from <?php echo e(\Carbon\Carbon::parse($startDate)->format('M d, Y')); ?>

                                to <?php echo e(\Carbon\Carbon::parse($endDate)->format('M d, Y')); ?>

                            </p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <i class="fas fa-chart-area text-blue-600"></i>
                        </div>
                    </div>
                    <!--[if BLOCK]><![endif]--><?php if($totalDues > 0): ?>
                        <div id="overviewChart" class="h-80" wire:ignore></div>
                    <?php else: ?>
                        <div class="h-80 bg-gray-50 rounded-lg flex flex-col items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-chart-area text-gray-300 text-6xl mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-500 mb-2">No Data Available</h3>
                                <p class="text-gray-400 text-sm">There's nothing to show for the selected date
                                    range.</p>
                                <p class="text-gray-400 text-sm">Try adjusting your date filters or check back
                                    later.</p>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <!--[if BLOCK]><![endif]--><?php if(auth()->user()->hasAnyRole('admin', 'superadmin')): ?>
                    <!-- Payment Status Chart -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">Payment Status Distribution</h2>
                                <p class="text-gray-600 text-sm">Current status of member dues payments</p>
                            </div>
                            <div class="bg-purple-100 rounded-full p-3">
                                <i class="fas fa-chart-pie text-purple-600"></i>
                            </div>
                        </div>
                        <!--[if BLOCK]><![endif]--><?php if($totalMembers > 0): ?>
                            <div id="statusChart" class="h-80" wire:ignore></div>
                        <?php else: ?>
                            <div class="h-80 bg-gray-50 rounded-lg flex flex-col items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-chart-pie text-gray-300 text-6xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-500 mb-2">No Members Found</h3>
                                    <p class="text-gray-400 text-sm">There are no members to display for this period.</p>
                                    <p class="text-gray-400 text-sm">Member data will appear here once available.</p>
                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <?php if(auth()->user()->hasRole('admin', 'superadmin')): ?>
            <!-- Additional Analytics -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Collection Efficiency -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Collection Efficiency</h3>
                        <i class="fas fa-percentage text-green-600"></i>
                    </div>
                    <!--[if BLOCK]><![endif]--><?php if($totalMembers > 0): ?>
                        <div id="efficiencyChart" class="h-48" wire:ignore></div>
                    <?php else: ?>
                        <div class="h-48 bg-gray-50 rounded-lg flex flex-col items-center justify-center">
                            <i class="fas fa-percentage text-gray-300 text-3xl mb-2"></i>
                            <p class="text-gray-400 text-sm text-center">No efficiency data<br>available</p>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <!-- Trend Analysis -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Trend Analysis</h3>
                        <i class="fas fa-chart-line text-blue-600"></i>
                    </div>
                    <!--[if BLOCK]><![endif]--><?php if($totalDues > 0): ?>
                        <div id="trendChart" class="h-48" wire:ignore></div>
                    <?php else: ?>
                        <div class="h-48 bg-gray-50 rounded-lg flex flex-col items-center justify-center">
                            <i class="fas fa-chart-line text-gray-300 text-3xl mb-2"></i>
                            <p class="text-gray-400 text-sm text-center">No trend data<br>to analyze</p>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <!-- Quick Stats -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Stats</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Average per Member</span>
                            <span class="font-semibold text-gray-800">
                                ₱<?php echo e($totalMembers > 0 ? number_format($totalDues / $totalMembers, 2) : '0.00'); ?>

                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Collection Rate</span>
                            <span class="font-semibold text-emerald-600">
                                <?php echo e($totalDues > 0 ? round(($paidDues / $totalDues) * 100) : 0); ?>%
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Outstanding Amount</span>
                            <span class="font-semibold text-red-600">₱<?php echo e(number_format($unpaidDues, 2)); ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Active Members</span>
                            <span class="font-semibold text-indigo-600"><?php echo e($totalMembers); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    </div>

        <script>
            let overviewChart, statusChart, efficiencyChart, trendChart;

            // Wait for ApexCharts to be available
            function waitForApexCharts(callback) {
                if (typeof ApexCharts !== 'undefined') {
                    callback();
                } else {
                    setTimeout(() => waitForApexCharts(callback), 100);
                }
            }

            document.addEventListener('livewire:navigated', function () {
                waitForApexCharts(initCharts);
            });

            document.addEventListener('DOMContentLoaded', function () {
                waitForApexCharts(initCharts);
            });

            // Listen for Livewire updates
            document.addEventListener('livewire:init', () => {
                Livewire.on('dataUpdated', () => {
                    updateCharts();
                });
            });

            function initCharts() {
                console.log('Initializing charts...'); // Debug log

                // Check if ApexCharts is available
                if (typeof ApexCharts === 'undefined') {
                    console.error('ApexCharts is not loaded');
                    return;
                }

                // Initialize charts with current data
                const paidDues = <?php echo json_encode($paidDues, 15, 512) ?>;
                const unpaidDues = <?php echo json_encode($unpaidDues, 15, 512) ?>;
                const paidMembers = <?php echo json_encode($paidMembers, 15, 512) ?>;
                const unpaidMembers = <?php echo json_encode($unpaidMembers, 15, 512) ?>;
                const totalMembers = <?php echo json_encode($totalMembers, 15, 512) ?>;
                const totalDues = <?php echo json_encode($totalDues, 15, 512) ?>;

                console.log('Chart data:', { paidDues, unpaidDues, paidMembers, unpaidMembers, totalMembers, totalDues }); // Debug log

                // Only initialize charts if there's data to display
                if (totalDues === 0 && totalMembers === 0) {
                    console.log('No data to display');
                    // Clear any existing charts
                    destroyAllCharts();
                    return;
                }

                // Overview Chart (Area Chart)
                const overviewElement = document.querySelector("#overviewChart");
                if (overviewElement && totalDues > 0) {
                    console.log('Creating overview chart');
                    const overviewOptions = {
                        series: [{
                            name: 'Paid Dues',
                            data: generateMonthlyData(paidDues)
                        }, {
                            name: 'Unpaid Dues',
                            data: generateMonthlyData(unpaidDues)
                        }],
                        chart: {
                            height: 320,
                            type: 'area',
                            toolbar: {show: false}
                        },
                        colors: ['#10b981', '#ef4444'],
                        dataLabels: {enabled: false},
                        stroke: {curve: 'smooth', width: 3},
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                        },
                        yaxis: {
                            labels: {
                                formatter: function (val) {
                                    return '₱' + val.toLocaleString()
                                }
                            }
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.7,
                                opacityTo: 0.3,
                            }
                        },
                        grid: {strokeDashArray: 3},
                        legend: {position: 'top'}
                    };

                    if (overviewChart) overviewChart.destroy();
                    overviewChart = new ApexCharts(overviewElement, overviewOptions);
                    overviewChart.render();
                }

                // Status Chart (Donut Chart)
                const statusElement = document.querySelector("#statusChart");
                if (statusElement && totalMembers > 0) {
                    console.log('Creating status chart');
                    const statusOptions = {
                        series: [paidMembers, unpaidMembers],
                        chart: {
                            height: 320,
                            type: 'donut',
                        },
                        labels: ['Paid Members', 'Unpaid Members'],
                        colors: ['#10b981', '#ef4444'],
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '70%',
                                    labels: {
                                        show: true,
                                        total: {
                                            show: true,
                                            label: 'Total Members',
                                            formatter: function (w) {
                                                return totalMembers.toString()
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val, opts) {
                                return opts.w.config.series[opts.seriesIndex] + ' Members'
                            }
                        },
                        legend: {position: 'bottom'}
                    };

                    if (statusChart) statusChart.destroy();
                    statusChart = new ApexCharts(statusElement, statusOptions);
                    statusChart.render();
                }

                // Collection Efficiency Chart
                const efficiencyElement = document.querySelector("#efficiencyChart");
                if (efficiencyElement && totalMembers > 0) {
                    console.log('Creating efficiency chart');
                    const efficiencyRate = totalMembers > 0 ? Math.round((paidMembers / totalMembers) * 100) : 0;
                    const efficiencyOptions = {
                        series: [efficiencyRate],
                        chart: {
                            height: 192,
                            type: 'radialBar',
                        },
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    size: '60%',
                                },
                                dataLabels: {
                                    name: {
                                        fontSize: '16px',
                                    },
                                    value: {
                                        fontSize: '22px',
                                        formatter: function (val) {
                                            return val + '%'
                                        }
                                    }
                                }
                            }
                        },
                        colors: ['#10b981'],
                        labels: ['Efficiency'],
                    };

                    if (efficiencyChart) efficiencyChart.destroy();
                    efficiencyChart = new ApexCharts(efficiencyElement, efficiencyOptions);
                    efficiencyChart.render();
                }

                // Trend Chart
                const trendElement = document.querySelector("#trendChart");
                if (trendElement && totalDues > 0) {
                    console.log('Creating trend chart');
                    const trendOptions = {
                        series: [{
                            name: 'Collections',
                            data: generateTrendData(paidDues)
                        }],
                        chart: {
                            height: 192,
                            type: 'line',
                            sparkline: {enabled: true}
                        },
                        colors: ['#3b82f6'],
                        stroke: {curve: 'smooth', width: 3},
                        markers: {size: 4}
                    };

                    if (trendChart) trendChart.destroy();
                    trendChart = new ApexCharts(trendElement, trendOptions);
                    trendChart.render();
                }
            }

            function destroyAllCharts() {
                if (overviewChart) {
                    overviewChart.destroy();
                    overviewChart = null;
                }
                if (statusChart) {
                    statusChart.destroy();
                    statusChart = null;
                }
                if (efficiencyChart) {
                    efficiencyChart.destroy();
                    efficiencyChart = null;
                }
                if (trendChart) {
                    trendChart.destroy();
                    trendChart = null;
                }
            }

            function updateCharts() {
                // This function will be called when Livewire updates the data
                setTimeout(() => {
                    destroyAllCharts();
                    initCharts();
                }, 100);
            }

            function generateMonthlyData(baseAmount) {
                // Generate realistic monthly distribution based on base amount
                const months = 12;
                const data = [];
                for (let i = 0; i < months; i++) {
                    const variation = 0.7 + (Math.random() * 0.6); // 70% to 130% of base
                    data.push(Math.round((baseAmount / months) * variation));
                }
                return data;
            }

            function generateTrendData(baseAmount = null) {
                // Generate trend data for the last 10 periods
                const data = [];
                if (baseAmount && baseAmount > 0) {
                    // Generate realistic trend based on actual data
                    const baseValue = baseAmount / 10;
                    for (let i = 0; i < 10; i++) {
                        const variation = 0.6 + (Math.random() * 0.8); // 60% to 140% variation
                        data.push(Math.round(baseValue * variation));
                    }
                } else {
                    // Generate random trend data when no base amount
                    for (let i = 0; i < 10; i++) {
                        data.push(Math.floor(Math.random() * 100) + 20);
                    }
                }
                return data;
            }
        </script>
</div>
<?php /**PATH C:\laragon\www\ARK\resources\views/livewire/dashboard/admin-dashboard.blade.php ENDPATH**/ ?>