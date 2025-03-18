<template>
    <AuthenticatedLayout>
        <Head title="Edit Violation" />

        <div class="py-1">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-gray-100 shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex flex-col mt-0 md:flex-row md:justify-between md:items-center space-y-1 md:space-y-0 ">
                        <h3 class="text-2xl font-bold ">Edit Violation: {{ violation.transaction_number }}</h3>
                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-4 overflow-hidden mt-4">
                    <!-- First Column (3/4) -->
                    <div class="md:col-span-1 col-span-4 p-4 bg-white shadow-xl sm:rounded-lg">
                        <div class="mt-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Transaction #</label>
                            <input v-model="form.transaction_number" disabled readonly type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                        </div>

                        <div class="mt-3">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student</label>
                            <select v-model="form.student_id"  disabled readonly @change="getStudentInfo" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(item, index) in students" :key="index" :value="item.id">{{item.id_number}} - {{ item.full_name }}</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Violation</label>
                            <select v-model="form.violation_id"  disabled readonly @change="getViolationInfo" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(item, index) in violations" :key="index" :value="item.id">{{item.name}}</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Offense Level</label>
                            <select v-model="form.offense_level_id"  disabled readonly @change="getOffenseLevelInfo" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(item, index) in offense_levels" :key="index" :value="item.id">{{item.name}}</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                            <textarea id="message" v-model="form.remarks"  disabled readonly rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your remarks here..."></textarea>

                        </div>

                        <div class="text-gray-900 flex mt-7 w-full gap-2">

                            <Link :href="route('transaction_violation.edit', violation.id)" data-modal-hide="default-modal"
                                type="button"
                                class="flex-1 text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300
                                    font-medium rounded-lg text-sm px-5 py-4 text-center">
                                Edit
                            </Link>

                            <Link :href="route('transaction_violation.index')" data-modal-hide="default-modal"
                                type="button"
                                class="flex-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300
                                    font-medium rounded-lg text-sm px-5 py-4 text-center">
                                Back
                            </Link>
                        </div>

                    </div>

                    <!-- Second Column (1/4) -->
                    <div class="md:col-span-3 col-span-4 grid md:grid-rows-0 gap-2">
                        <div class="md:p-5 grid grid-cols-1 md:grid-cols-2 gap-4 mb-0 p-4 bg-white shadow-xl sm:rounded-lg">
                            <div class="col-span-1 md:col-span-2">Status: <b>{{ violation.status != null ? violation.status.name : '' }}</b></div>
                            <div class="col-span-1 md:col-span-2">Penalty Imposed: <b>{{ violation.penalty_action != null ? violation.penalty_action.name : '' }}</b></div>
                            <div class="col-span-1 md:col-span-2">Resolution: <b>{{ violation.resolution }}</b></div>

                        </div>

                        <div class="md:p-5 grid grid-cols-1 md:grid-cols-2 md:grid-rows-0 gap-4 mb-0 p-4 bg-white shadow-xl sm:rounded-lg">
                            <div class="col-span-1 md:col-span-2">Student info</div>
                            <div class="relative z-0">
                                <input type="text" v-model="selected_student.id_number" id="id_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " disabled />
                                <label for="id_number" class="absolute text-sm text-gray-400 dark:text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">ID Number</label>
                            </div>

                            <div class="relative z-0">
                                <input type="text" v-model="selected_student.full_name" id="student_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " disabled />
                                <label for="student_name" class="absolute text-sm text-gray-400 dark:text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Student Name</label>
                            </div>
                            <div class="relative z-0">
                                <input type="text" v-model="selected_student.email_address" id="email_address" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " disabled />
                                <label for="email_address" class="absolute text-sm text-gray-400 dark:text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Email Address</label>
                            </div>
                            <div class="relative z-0">
                                <input type="text" v-model="selected_student.contact_number" id="contact_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " disabled />
                                <label for="contact_number" class="absolute text-sm text-gray-400 dark:text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Contact Number</label>
                            </div>
                            <div class="relative z-0">
                                <input type="text" v-model="selected_student.year_level.name" id="year_level" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " disabled />
                                <label for="year_level" class="absolute text-sm text-gray-400 dark:text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Year Level</label>
                            </div>
                            <div class="relative z-0">
                                <input type="text" v-model="selected_student.section.name" id="section" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " disabled />
                                <label for="section" class="absolute text-sm text-gray-400 dark:text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Section</label>
                            </div>
                        </div>
                        <div class="md:p-5 grid grid-cols-1 md:grid-cols-2 gap-4 mb-0 p-4 bg-white shadow-xl sm:rounded-lg">
                            <div class="col-span-1 md:col-span-2">Violation Committed</div>
                            <div>
                                Violation
                                <input type="text" v-model="selected_violation.name" disabled readony class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required />
                            </div>
                            <div>
                                Description
                                <input type="text" :value="selected_violation.description" disabled readony class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required />
                            </div>
                            <div class="mt-0">
                                Violation Category
                                <input type="text" :value="selected_violation.category.name" disabled readony class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required />
                            </div>
                            <div class="mt-0">
                                Offense Level
                                <input type="text" :value="selected_offense_level.name" disabled readony class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required />
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

<script>
import { useForm, Link, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    props: ['violation', 'students', 'violations', 'offense_levels', 'penalty_actions', 'statuses', 'transaction_number'],
    components: {
        AuthenticatedLayout,
        Link,
        Head
    },
    data() {
        return {
            form: useForm({
                id: '',
                transaction_number: '',
                student_id: '',
                violation_id: '',
                offense_level_id: '',
                penalty_action_id: '',
                status_id: '',
                remarks: '',
                active: false,
                is_editing: false,
            }),

            selected_student: {
                id_number : null,
                first_name : null,
                middle_name : null,
                last_name : null,
                ext_name : null,
                full_name: null,
                address : null,
                contact_number : null,
                email_address : null,
                program_id : null,
                year_level_id : null,
                section_id : null,
                program: {
                    id: null,
                    code: null,
                    description: null,
                    college: {
                        id: null,
                        code: null,
                        description: null,
                    },
                },
                section: {
                    id: null,
                    name: null,
                },
                year_level: {
                    id: null,
                    name: null,
                },
            },

            selected_violation: {
                id: null,
                code: null,
                description: null,
                name: null,
                category: {
                    id: null,
                    name: null,
                },

            },

            selected_offense_level: {
                id: null,
                name: null,
            },

            selected_penalty_action: {
                id: null,
                name: null,
            },

            loading_button: false,
            disabled_button: false,
            is_created: false,
            is_updated: false,
            is_deleted: false,

            search: '',


        }
    },
    mounted() {
        this.mountData()
    },
    methods: {
        mountData() {
            this.form.id = this.violation.id
            this.form.transaction_number = this.violation.transaction_number
            this.form.student_id = this.violation.student_id
            this.form.violation_id = this.violation.violation_id
            this.form.offense_level_id = this.violation.offense_level_id
            this.form.penalty_action_id = this.violation.penalty_action_id
            this.form.status_id = this.violation.status_id
            this.form.remarks = this.violation.remarks

            this.getStudentInfo()
            this.getViolationInfo()
            this.getOffenseLevelInfo()
            this.getSelestedPenaltyAction()
        },

        getStudentInfo() {
            this.selected_student = this.students.find(student => student.id === this.form.student_id);
        },

        getViolationInfo() {
            this.selected_violation = this.violations.find(violation => violation.id === this.form.violation_id);
        },

        getOffenseLevelInfo() {
            this.selected_offense_level = this.offense_levels.find(level => level.id === this.form.offense_level_id);
        },

        getSelestedPenaltyAction() {
            this.selected_penalty_action = this.penalty_actions.find(action => action.id === this.form.penalty_action_id);
        },

        openForm() {
            this.form.active = true
            this.form.is_editing = false
        },

        closeForm() {
            this.form.id = ''
            this.form.transaction_number = ''
            this.form.student_id = ''
            this.form.violation_id = ''
            this.form.offense_level_id = ''
            this.form.penalty_action_id = ''
            this.form.status_id = ''
            this.form.remarks = ''

            this.form.active = false
            this.form.is_editing = false
        },

        save() {
            this.form.post('/transaction_violation/store', {
                onSuccess: () => {
                    this.closeForm()
                    this.is_created = true
                },
                onError: () => {

                }
            })
        },

        update() {
            this.form.patch('/transaction_violation/update/'+this.form.id, {
                onSuccess: () => {
                    this.closeForm()
                    this.is_updated = true
                },
                onError: () => {

                }
            })
        },

        deleteItem() {
            this.form.delete('/transaction_violation/destroy/'+this.delete_form.id, {
                onSuccess: () => {
                    this.CloseDeleteForm()
                    this.is_deleted = true
                },
                onError: () => {

                }
            })
        }
    }
}
</script>
