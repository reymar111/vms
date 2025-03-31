<template>
    <AuthenticatedLayout>
        <Head title="Create Violation" />

        <div class="py-1">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-gray-100 shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex flex-col mt-0 md:flex-row md:justify-between md:items-center space-y-1 md:space-y-0 ">
                        <h3 class="text-2xl font-bold ">Create Violation</h3>
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
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Academic Year</label>
                            <select v-model="form.academic_year_id" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(item, index) in academic_years" :key="index" :value="item.id">{{item.semester != null ? item.semester.name+' - '+item.year : ''}}</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student</label>
                            <select v-model="form.student_id" @change="getStudentInfo" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(item, index) in students" :key="index" :value="item.id">{{item.id_number}} - {{ item.full_name }}</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Violation</label>
                            <select v-model="form.violation_id" @change="getViolationInfo" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(item, index) in violations" :key="index" :value="item.id">{{item.name}}</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Offense Level</label>
                            <select v-model="form.offense_level_id" @change="getOffenseLevelInfo" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(item, index) in offense_levels" :key="index" :value="item.id">{{item.name}}</option>
                            </select>
                        </div>

<!--
                        <div class="mt-3">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penalty Imposed</label>
                            <select v-model="form.penalty_action_id" @change="getSelestedPenaltyAction" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(item, index) in penalty_actions" :key="index" :value="item.id">{{item.name}}</option>
                            </select>
                        </div> -->

                        <div class="mt-3">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                            <textarea id="message" v-model="form.remarks" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your remarks here..."></textarea>

                        </div>



                        <div class="text-gray-900 flex mt-7 w-full gap-2">
                            <button @click="save" data-modal-hide="default-modal"
                                type="button"
                                class="flex-1 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300
                                    font-medium rounded-lg text-sm px-5 py-4 text-center">
                                Save
                            </button>

                            <Link :href="route('transaction_violation.index')" data-modal-hide="default-modal"
                                type="button"
                                class="flex-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300
                                    font-medium rounded-lg text-sm px-5 py-4 text-center">
                                Cancel
                            </Link>
                        </div>

                    </div>

                    <!-- Second Column (1/4) -->
                    <div class="md:col-span-3 col-span-4 grid md:grid-rows-0 gap-2">
                        <div class="md:p-5 grid grid-cols-1 md:grid-cols-2 gap-4 mb-0 p-4 bg-white shadow-xl sm:rounded-lg">
                            <div class="col-span-1 md:col-span-2">Status: </div>

                        </div>

                        <div class="md:p-5 grid grid-cols-1 md:grid-cols-2 md:grid-rows-0 gap-4 mb-0 p-4 bg-white shadow-xl sm:rounded-lg">
                            <div class="col-span-1 md:col-span-2">Student info</div>
                            <div>
                                ID Number
                                <input type="text" v-model="selected_student.id_number" disabled readony class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="ID Number" required />
                            </div>
                            <div>
                                Student Name
                                <input type="text" v-model="selected_student.full_name" disabled readony class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Name" required />
                            </div>
                            <div>
                                Email Address
                                <input type="text" v-model="selected_student.email_address" disabled readony class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Email Address" required />

                            </div>
                            <div>
                                Contact Number
                                <input type="text" v-model="selected_student.contact_number" disabled readony class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Contact Number" required />
                            </div>
                            <div>
                                Year Level
                                <input type="text" v-model="selected_student.year_level.name" disabled readony class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Year Level" required />
                            </div>
                            <div>
                                Section
                                <input type="text" v-model="selected_student.section.name" disabled readony class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Section" required />
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
    props: ['students', 'violations', 'offense_levels', 'penalty_actions', 'statuses', 'transaction_number', 'academic_years'],
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
                academic_year_id: '',
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
        this.form.transaction_number = this.transaction_number
    },
    methods: {
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
            this.form.academic_year_id = ''
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
