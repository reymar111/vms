
<template>
    <AuthenticatedLayout>
        <Head title="Reports / Monthly Violations" />

        <div class="py-1">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0 ">
                        <h3 class="text-2xl font-bold ">Reports - Monthly Violations</h3>
                    </div>


                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">#</th>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">Month</th>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">Year</th>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">Total Violations</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b" v-for="(item, index) in data" :key="index">
                                <td class="px-4 py-2">{{ index + 1 }}</td>
                                <td class="px-4 py-2">{{ item.month }}</td>
                                <td class="px-4 py-2">{{ item.year }}</td>
                                <td class="px-4 py-2">{{ item.total_violations }}</td>
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
        }
    }
}
</script>
