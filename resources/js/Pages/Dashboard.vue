<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import VueApexCharts from 'vue3-apexcharts'

export default {
    props: [ 'violation_summary', 'monthly_violations', 'violations_per_academic_year', 'violation_status', 'top_violations'],
    components: {
        AuthenticatedLayout,
        Head,
        apexchart: VueApexCharts,
    },
    data() {
        return {
            viol_summary : {
                chartOptions: {
                    chart: {
                        type: 'donut',
                    },
                    labels: [],
                    legend: {
                        position: 'bottom',
                    },
                    dataLabels: {
                        enabled: true,
                    },
                    tooltip: {
                        y: {
                            formatter: function (value, { series, seriesIndex, w }) {
                                const label = w.config.labels[seriesIndex];
                                return `${label}: ${value} case${value > 1 ? 's' : ''}`;
                            },
                        },
                    },
                    responsive: [
                        {
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 300,
                                },
                                legend: {
                                    position: 'bottom',
                                },
                            },
                        },
                    ],
                    plotOptions: {
                        pie: {
                            donut: {
                            labels: {
                                show: true,
                                total: {
                                show: true,
                                label: 'Total',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0)+ ' cases';
                                },
                                },
                            },
                            },
                        },
                    }
                },
                series: [],
            },

            month_viol: {
                chartOptions: {
                    chart: {
                    id: 'monthly-violations',
                    toolbar: {
                        show: true,
                    },
                    },
                    xaxis: {
                    categories: [], // months
                    },
                    tooltip: {
                    y: {
                        formatter: (val) => `${val} violation${val !== 1 ? 's' : ''}`,
                    },
                    },
                    yaxis: {
                    title: {
                        text: 'No. of Violations',
                    },
                    },
                    // title: {
                    // text: 'Monthly Violations',
                    // align: 'center',
                    // },
                },
                series: [
                    {
                    name: 'Violations',
                    data: [],
                    },
                ],
            },

            viol_per_academic_year: {
                chartOptions: {
                    chart: {
                        id: 'violations-academic-year',
                        toolbar: {
                            show: true,
                        },
                    },
                    xaxis: {
                        categories: [], // Academic Year + Semester
                        title: {
                            text: 'Academic Year',
                        },
                        labels: {
                            rotate: -45,
                            style: {
                                fontSize: '12px',
                            },
                        },
                    },
                    yaxis: {
                        title: {
                            text: 'No. of Violations',
                        },
                    },
                    tooltip: {
                        enabled: true,
                        enabledOnSeries: undefined,
                        shared: true,
                        followCursor: false,
                        intersect: false,
                        inverseOrder: false,
                        custom: undefined,
                        hideEmptySeries: true,
                        fillSeriesColor: false,
                        theme: false,
                        y: {
                            formatter: (val) => `${val} violation${val !== 1 ? 's' : ''}`,
                        },

                    },
                    // title: {
                    //     text: 'Violations per Academic Year',
                    //     align: 'center',
                    // },
                    // dataLabels: {
                    //     enabled: true,
                    // },
                },
                series: [
                    {
                        name: 'Violations',
                        data: [],
                    },
                ],
            },

            viol_status: {
                chartOptions: {
                    chart: {
                    type: 'bar',
                    toolbar: {
                        show: false,
                    },
                    },
                    plotOptions: {
                    bar: {
                        horizontal: true,
                        columnWidth: '50%',
                        borderRadius: 4,
                    },
                    },
                    dataLabels: {
                    enabled: true,
                    },
                    xaxis: {
                    categories: this.violation_status.map(item => item.status),
                    labels: {
                        style: {
                        fontSize: '14px',
                        },
                    },
                    },
                    yaxis: {
                    title: {
                        text: 'Number of Violations',
                    },
                    },
                    tooltip: {
                    y: {
                        formatter: (val) => `${val} violation${val !== 1 ? 's' : ''}`,
                    },
                    },
                    colors: ['#6366f1'], // Indigo
                },
                series: [
                    {
                    name: 'Violations',
                    data: this.violation_status.map(item => item.total_cases),
                    },
                ],
            },

            top_viol: {
                chartOptions: {
                    chart: {
                    type: 'bar',
                    toolbar: { show: false },
                    },
                    plotOptions: {
                    bar: {
                        horizontal: true,
                        barHeight: '60%',
                        borderRadius: 4,
                    },
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: (val) => {
                            const violation = this.top_violations.find(item => item.total === val);
                            return violation ? violation.name + '  -  '+val+'x': ''; // Display the name corresponding to the value
                        },
                    },
                    xaxis: {
                        title: {
                            text: 'Number of Occurrences',
                        },
                        labels: {
                            formatter: val => `${val}`,
                        },
                    },
                    yaxis: {
                        categories: this.yaxisCategories,
                        labels: {
                            style: {
                            fontSize: '14px',
                            fontWeight: 500,
                            },
                        },
                    },
                    tooltip: {
                    y: {
                        formatter: (val) => `${val} violation${val !== 1 ? 's' : ''}`,
                    },
                    },
                    colors: ['#f97316'], // Orange
                },
            series: [
                {
                name: 'Violations',
                data: this.top_violations.map(item => item.total),
                },
            ],
            }



        };
    },
    mounted() {
        // violation summary
        this.viol_summary.chartOptions.labels = this.violation_summary.map(item => item.violation_name);
        this.viol_summary.series = this.violation_summary.map(item => item.total_cases);


        // monthly violations
        const sortedData = this.monthly_violations.sort((a, b) => a.month_number - b.month_number);

        this.month_viol.chartOptions.xaxis.categories = sortedData.map((item) => item.month);
        this.month_viol.series[0].data = sortedData.map((item) => item.total_violations);

        // violations per academic year
        this.viol_per_academic_year.chartOptions.xaxis.categories = this.violations_per_academic_year.map((item) => item.academic_year);
        this.viol_per_academic_year.series[0].data = this.violations_per_academic_year.map((item) => item.total_violations);
    },
    methods: {
        // Define any methods you need here
    },
    computed: {
        yaxisCategories() {
        return this.top_violations.map(item => item.name);
        },
    },
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-1">
            <div class="w-full sm:px-6 lg:px-8 mb-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-2xl text-gray-900">
                        Welcome back, {{ $page.props.auth.user.name }}!
                    </div>
                </div>
            </div>
            <div class="mx-auto max-w-12xl sm:px-6 lg:px-8">
                <!-- Main Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-lg font-semibold mb-4">Monthly Violations</h2>
                        <div class="bg-gray-200 h-auto rounded-lg">
                            <apexchart
                                type="bar"
                                height="350"
                                :options="month_viol.chartOptions"
                                :series="month_viol.series"
                            />
                        </div>
                    </div>

                    <!-- Statistics Panel -->
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-lg font-semibold mb-4">Violation Summary</h2>
                        <div class="bg-gray-200 h-auto rounded-lg">
                            <apexchart
                                type="donut"
                                height="350"
                                :options="viol_summary.chartOptions"
                                :series="viol_summary.series"
                            />
                        </div>
                    </div>
                </div>

                <!-- Secondary Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-lg font-semibold mb-4">Violation/Adademic Year</h2>
                        <div class="bg-gray-200 h-auto rounded-lg">
                            <apexchart
                                type="bar"
                                height="450"
                                :options="viol_per_academic_year.chartOptions"
                                :series="viol_per_academic_year.series"
                            />
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-lg font-semibold mb-4">Violation Status</h2>
                        <div class="bg-gray-200 h-auto rounded-lg">
                            <apexchart
                            type="bar"
                            height="450"
                            :options="viol_status.chartOptions"
                            :series="viol_status.series"
                            />
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-lg font-semibold mb-4">Top Violations</h2>
                        <div class="bg-gray-200 h-auto rounded-lg">
                            <apexchart
                                type="bar"
                                height="450"
                                :options="top_viol.chartOptions"
                                :series="top_viol.series"
                                />
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>
