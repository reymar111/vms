
<template>
    <AuthenticatedLayout>
        <Head title="Reports / Violation Status" />

        <div class="py-1">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0 ">
                        <h3 class="text-2xl font-bold ">Reports - Violation Status</h3>

                        <button @click="printReport" class="px-4 py-2 mb-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center space-x-2">
                            <svg class="w-6 h-6 text-white-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd"/>
                        </svg>
                        </button>
                    </div>


                    <table class="min-w-full border border-gray-200" ref="printTable">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">#</th>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">Status</th>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">Total Cases</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b" v-for="(item, index) in data" :key="index">
                                <td class="px-4 py-2">{{ index + 1 }}</td>
                                <td class="px-4 py-2">{{ item.status }}</td>
                                <td class="px-4 py-2">{{ item.total_cases }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { useForm, Link, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    props: ['data'],
    components: {
        AuthenticatedLayout,
        Link,
        Head

    },
    data() {
        return {
            start_date: null,
            end_date: null,
        }
    },
    mounted() {

    },
    computed: {

    },
    methods: {
        filterData() {
            this.$inertia.post('/reports/vehicle_utilization', {
                start_date: this.start_date,
                end_date: this.end_date
            });
        },

        printReport() {
            const table = this.$refs.printTable;
            const printWindow = window.open('', '', 'width=1000,height=800');

            const style = `
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        padding: 20px;
                    }
                    h3 {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    .title-main {
                        text-align: center;
                        font-weight: bold;
                        margin-bottom: 1px;
                    }
                    .title-sub {
                        text-align: center;
                        font-style: italic;
                        margin-bottom: 25px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        border: 1px solid #ccc;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f3f4f6;
                    }
                </style>
            `;

            const title = `
                <div class="title-main">Kalinga State University</div>
                <div class="title-sub">Bulanao, Tabuk City, Kalinga</div>
                <h3>Violation Status Report</h3>
            `;

            const html = `${style}${title}${table.outerHTML}`;

            printWindow.document.write(html);
            printWindow.document.close();

            // Wait for the content to be fully loaded before printing
            printWindow.onload = function () {
                printWindow.focus();
                printWindow.print();
                // printWindow.close();
            };
        }
    }
}
</script>
