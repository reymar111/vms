<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import VueApexCharts from 'vue3-apexcharts';

export default {
    props: ['violation_summary', 'monthly_violations', 'violations_per_academic_year', 'violation_status', 'top_violations', 'years'],
    components: {
        AuthenticatedLayout,
        Head,
        apexchart: VueApexCharts,
    },
    data() {
        return {
            form: useForm({
                current_year: null,
            }),

            current_year: null,
            viol_summary: {
                chartOptions: {
                    chart: { type: 'donut' },
                    labels: [],
                    legend: { position: 'bottom' },
                    dataLabels: { enabled: true },
                    tooltip: {
                        y: {
                            formatter: (value, { seriesIndex, w }) => {
                                const label = w.config.labels[seriesIndex];
                                return `${label}: ${value} case${value > 1 ? 's' : ''}`;
                            },
                        },
                    },
                    responsive: [
                        {
                            breakpoint: 480,
                            options: {
                                chart: { width: 300 },
                                legend: { position: 'bottom' },
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
                                            return w.globals.seriesTotals.reduce((a, b) => a + b, 0) + ' cases';
                                        },
                                    },
                                },
                            },
                        },
                    },
                },
                series: [],
            },

            month_viol: {
                chartOptions: {
                    chart: { id: 'monthly-violations', toolbar: { show: true } },
                    xaxis: { categories: [] },
                    yaxis: { title: { text: 'No. of Violations' } },
                    tooltip: {
                        y: {
                            formatter: val => `${val} violation${val !== 1 ? 's' : ''}`,
                        },
                    },
                },
                series: [{ name: 'Violations', data: [] }],
            },

            viol_per_academic_year: {
                chartOptions: {
                    chart: { id: 'violations-academic-year', toolbar: { show: true } },
                    xaxis: {
                        categories: [],
                        title: { text: 'Academic Year' },
                        labels: { rotate: -45, style: { fontSize: '12px' } },
                    },
                    yaxis: { title: { text: 'No. of Violations' } },
                    tooltip: {
                        y: {
                            formatter: val => `${val} violation${val !== 1 ? 's' : ''}`,
                        },
                    },
                },
                series: [{ name: 'Violations', data: [] }],
            },

            viol_status: {
                chartOptions: {
                    chart: { type: 'bar', toolbar: { show: false } },
                    plotOptions: {
                        bar: { horizontal: true, columnWidth: '50%', borderRadius: 4 },
                    },
                    dataLabels: { enabled: true },
                    xaxis: {
                        categories: this.violation_status.map(item => item.status),
                        labels: { style: { fontSize: '14px' } },
                    },
                    yaxis: { title: { text: 'Number of Violations' } },
                    tooltip: {
                        y: {
                            formatter: val => `${val} violation${val !== 1 ? 's' : ''}`,
                        },
                    },
                    colors: ['#6366f1'],
                },
                series: [{ name: 'Violations', data: this.violation_status.map(item => item.total_cases) }],
            },

            top_viol: {
                chartOptions: {
                    chart: { type: 'bar', toolbar: { show: false } },
                    plotOptions: {
                        bar: { horizontal: true, barHeight: '60%', borderRadius: 4 },
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: (val, { dataPointIndex }) => {
                            const violation = this.top_violations[dataPointIndex];
                            return violation ? `${violation.name} - ${val}x` : '';
                        },
                    },
                    xaxis: {
                        title: { text: 'Number of Occurrences' },
                        labels: { formatter: val => `${val}` },
                    },
                    yaxis: {
                        categories: this.top_violations.map(item => item.name),
                        labels: { style: { fontSize: '14px', fontWeight: 500 } },
                    },
                    tooltip: {
                        y: {
                            formatter: val => `${val} violation${val !== 1 ? 's' : ''}`,
                        },
                    },
                    colors: ['#f97316'],
                },
                series: [{ name: 'Violations', data: this.top_violations.map(item => item.total) }],
            },
        };
    },
    mounted() {
        // violation summary
        this.viol_summary.chartOptions.labels = this.violation_summary.map(item => item.violation_name);
        this.viol_summary.series = this.violation_summary.map(item => item.total_cases);

        // monthly violations
        const sortedData = this.monthly_violations.sort((a, b) => a.month_number - b.month_number);
        this.month_viol.chartOptions.xaxis.categories = sortedData.map(item => item.month);
        this.month_viol.series[0].data = sortedData.map(item => item.total_violations);

        // violations per academic year
        this.viol_per_academic_year.chartOptions.xaxis.categories = this.violations_per_academic_year.map(item => item.academic_year);
        this.viol_per_academic_year.series[0].data = this.violations_per_academic_year.map(item => item.total_violations);
    },
    methods: {
        filterData() {
            this.resetGraph();

            this.form.post('/dashboard', {
                preserveState: true,
                onSuccess: (page) => {

                    this.viol_summary.chartOptions.labels = this.violation_summary.map(item => item.violation_name);
                    this.viol_summary.series = this.violation_summary.map(item => item.total_cases);

                    // monthly violations
                    const sortedData = this.monthly_violations.sort((a, b) => a.month_number - b.month_number);
                    this.month_viol.chartOptions.xaxis.categories = sortedData.map(item => item.month);
                    this.month_viol.series[0].data = sortedData.map(item => item.total_violations);

                    // violations per academic year
                    this.viol_per_academic_year.chartOptions.xaxis.categories = this.violations_per_academic_year.map(item => item.academic_year);
                    this.viol_per_academic_year.series[0].data = this.violations_per_academic_year.map(item => item.total_violations);
                },
            });
        },

        resetGraph() {
                this.viol_summary.chartOptions.labels = []
                this.viol_summary.series = []

                // monthly violations
                this.month_viol.chartOptions.xaxis.categories = []
                this.month_viol.series = [{ name: 'Violations', data: [] }]

                // violations per academic year
                this.viol_per_academic_year.chartOptions.xaxis.categories = []
                this.viol_per_academic_year.series = [{ name: 'Violations', data: [] }]
        },


        printReport() {
            const printWindow = window.open('', '', 'width=1200,height=900');
            const style = `
                <style>
                    @page { size: landscape; margin: 0.5in; }
                    body {
                        font-family: Arial, sans-serif;
                        padding: 20px;
                        margin: 0;
                        color: #111827;
                    }
                    h3 {
                        text-align: center;
                        margin: 10px 0 20px 0;
                        font-size: 22px;
                    }
                    .title-main {
                        text-align: center;
                        font-weight: bold;
                        font-size: 20px;
                        margin-bottom: 0px;
                    }
                    .title-sub {
                        text-align: center;
                        font-style: italic;
                        font-size: 16px;
                        margin-bottom: 10px;
                    }
                    .charts-container {
                        display: flex;
                        flex-direction: column;
                        gap: 20px;
                    }
                    .row {
                        display: flex;
                        gap: 10px;
                        justify-content: space-between;
                        flex-wrap: wrap; /* Allow wrapping */
                    }
                    .chart-box {
                        flex: 1;
                        background-color: #f9fafb;
                        border: 1px solid #d1d5db;
                        border-radius: 8px;
                        padding: 10px;
                        text-align: center;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        height: auto;
                        min-height: 300px;
                    }
                    .chart-box h4 {
                        margin-bottom: 10px;
                        font-size: 16px;
                        font-weight: bold;
                    }
                    .chart-container {
                        flex-grow: 1;
                        width: 100%;
                        height: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }
                    .apexcharts-canvas {
                        width: 100% !important;
                        height: 100% !important;
                    }
                </style>
            `;

            const title = `
                <div class="title-main">Kalinga State University</div>
                <div class="title-sub">Bulanao, Tabuk City, Kalinga</div>
                <h3>Violation Analytics</h3>
            `;

            const content = `
                <div class="charts-container">
                    <div class="row">
                                            <div class="chart-box">
                            <h4>Monthly Violations</h4>
                            <div class="chart-container" id="monthlyViolationsChart"></div>
                        </div>
                        <div class="chart-box">
                            <h4>Violation Summary</h4>
                            <div class="chart-container" id="violationSummaryChart"></div>
                        </div>

                        <div class="chart-box">
                            <h4>Violations per Academic Year</h4>
                            <div class="chart-container" id="violationsPerYearChart"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="chart-box">
                            <h4>Violation Status</h4>
                            <div class="chart-container" id="violationStatusChart"></div>
                        </div>
                        <div class="chart-box">
                            <h4>Top Violations</h4>
                            <div class="chart-container" id="topViolationsChart"></div>
                        </div>
                    </div>
                </div>
            `;

            const html = `${style}${title}${content}`;
            printWindow.document.write(html);
            printWindow.document.close();

            // Wait for the charts to be rendered before opening the print window
            printWindow.onload = () => {
                setTimeout(() => {
                    // Clone the chart elements
                    printWindow.document.getElementById('violationSummaryChart').appendChild(this.$refs.violationSummary.$el.cloneNode(true));
                    printWindow.document.getElementById('monthlyViolationsChart').appendChild(this.$refs.monthlyViolations.$el.cloneNode(true));
                    printWindow.document.getElementById('violationsPerYearChart').appendChild(this.$refs.violationsPerYear.$el.cloneNode(true));
                    printWindow.document.getElementById('violationStatusChart').appendChild(this.$refs.violationStatus.$el.cloneNode(true));
                    printWindow.document.getElementById('topViolationsChart').appendChild(this.$refs.topViolations.$el.cloneNode(true));

                    // Force reflow after chart rendering
                    setTimeout(() => {
                        printWindow.focus();
                        printWindow.print();
                    }, 1000);
                }, 500); // Delay to ensure charts are loaded
            };
        }
}



};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
        </template>

        <div class="py-1">
            <div class="w-full sm:px-6 lg:px-8 mb-3">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 flex items-center justify-between">
            <span class="text-2xl">
                Welcome back, {{ $page.props.auth.user.name }}!
            </span>

            <div class="flex justify-end">
    <div class="flex items-center space-x-4 w-auto">
        <!-- Year div with 1/4 width -->
        <div class="w-48">
            <select v-model="form.current_year" id="countries" @change="filterData" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option disabled selected>Select Academic Year</option>
                <option v-for="(item, index) in years" :key="index" :value="item.year">{{ item.year }}</option>
            </select>
        </div>

        <!-- Print button -->
        <div>
            <button @click="printReport" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center space-x-2">
                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    </div>
</div>

        </div>
    </div>
</div>


            <div class="mx-auto max-w-12xl sm:px-6 lg:px-8" ref="printGraphs">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-lg font-semibold mb-4">Monthly Violations</h2>
                        <div class="bg-gray-200 h-auto rounded-lg">
                            <apexchart
                                ref="monthlyViolations"
                                type="bar"
                                height="350"
                                :options="month_viol.chartOptions"
                                :series="month_viol.series"
                            />
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-lg font-semibold mb-4">Violation Summary</h2>
                        <div class="bg-gray-200 h-auto rounded-lg">
                            <apexchart
                                ref="violationSummary"
                                type="donut"
                                height="350"
                                :options="viol_summary.chartOptions"
                                :series="viol_summary.series"
                            />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 mt-4">
                    <div class="col-span-12 bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-lg font-semibold mb-4">Violation/Academic Year</h2>
                        <div class="bg-gray-200 h-auto rounded-lg">
                            <apexchart
                                ref="violationsPerYear"
                                type="bar"
                                height="450"
                                :options="viol_per_academic_year.chartOptions"
                                :series="viol_per_academic_year.series"
                            />
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-lg font-semibold mb-4">Violation Status</h2>
                        <div class="bg-gray-200 h-auto rounded-lg">
                            <apexchart
                                ref="violationStatus"
                                type="bar"
                                height="450"
                                :options="viol_status.chartOptions"
                                :series="viol_status.series"
                            />
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-lg font-semibold mb-4">Top Violations</h2>
                        <div class="bg-gray-200 h-auto rounded-lg">
                            <apexchart
                            ref="topViolations"
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
<style>
    @page {
        size: landscape;
        margin: 0.5in;
    }

    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        margin: 0;
        color: #111827;
    }

    h3 {
        text-align: center;
        margin: 10px 0 20px 0;
        font-size: 22px;
    }

    .title-main {
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 0px;
    }

    .title-sub {
        text-align: center;
        font-style: italic;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .charts-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .row {
        display: flex;
        gap: 10px;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .chart-box {
        flex: 1;
        background-color: #f9fafb;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 10px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: auto;
        min-height: 300px;
    }

    .chart-box h4 {
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: bold;
    }

    .chart-container {
        flex-grow: 1;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .apexcharts-canvas {
        width: 100% !important;
        height: 100% !important;
    }

    /* Printing Specific Styles */
    @media print {
        body {
            margin: 0;
            padding: 0;
        }

        .charts-container {
            display: block; /* Prevent wrapping for print */
        }

        /* Apply scale for printing */
        .print-content {
            transform: scale(0.4);
            transform-origin: 0 0; /* Ensure scaling starts from the top-left corner */
            width: 250%; /* To compensate for scaling */
            height: 250%; /* To compensate for scaling */
        }

        /* Ensure page is not clipped */
        .row {
            margin-bottom: 10px;
        }

        .chart-box {
            min-height: 250px; /* Ensure charts don't get too small */
        }

        h3, .title-main, .title-sub {
            font-size: 16px; /* Adjust font size for print */
        }
    }
</style>
