<template>
    <AuthenticatedLayout>
        <Head title="Create Violation" />

        <div class="py-1">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-lg sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0 ">
                        <h3 class="text-2xl font-bold ">Create Violation</h3>

                    </div>

                    <div class="px-6 pb-6 overflow-x-auto bg-white shadow-md rounded-lg mt-0">
                        <div v-if="is_created" id="alert-border-1" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 " role="alert">
                            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <div class="ms-3 text-sm font-medium">
                                Violation Created Successfully.
                            </div>
                            <button @click="is_created = false" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                                <span class="sr-only">Dismiss</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>

                        <div v-if="is_updated" id="alert-border-1" class="flex items-center p-4 mb-4 text-yellow-800 border-t-4 border-yellow-300 bg-yellow-50 " role="alert">
                            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <div class="ms-3 text-sm font-medium">
                                Violation Updated Successfully.
                            </div>
                            <button @click="is_updated = false" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                                <span class="sr-only">Dismiss</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>

                        <div v-if="is_deleted" id="alert-border-1" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 " role="alert">
                            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <div class="ms-3 text-sm font-medium">
                                Violation Deleted Successfully.
                            </div>
                            <button @click="is_deleted = false" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                                <span class="sr-only">Dismiss</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-4 overflow-hidden mt-4">
                    <!-- First Column (3/4) -->
                    <div class="md:col-span-1 col-span-4 p-4 bg-white shadow-lg sm:rounded-lg">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Transaction #</label>
                            <input v-model="form.transaction_number" disabled readonly type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                        </div>

                        <div>
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student</label>
                            <select v-model="form.student_id" @change="getStudentInfo" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(item, index) in students" :key="index" :value="item.id">{{item.id_number}} - {{ item.full_name }}</option>
                            </select>
                        </div>

                        <div class="text-gray-900 flex mt-7">
                            <button @click="save" v-if="form.is_editing === false" data-modal-hide="default-modal" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Save</button>
                            <button @click="update" v-if="form.is_editing" data-modal-hide="default-modal" type="button" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Update</button>
                            <button @click="closeForm" data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Cancel</button>
                        </div>
                    </div>

                    <!-- Second Column (1/4) -->
                    <div class="md:col-span-3 col-span-4 grid md:grid-rows-2 gap-2">
                        <div class="md:p-5 grid grid-cols-1 md:grid-cols-2 gap-4 mb-0 p-4 bg-white shadow-lg sm:rounded-lg">
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
                        <div class="p-4 bg-white shadow-lg sm:rounded-lg">Violation Committed</div>
                        <div class=" p-4 bg-white shadow-lg sm:rounded-lg">Resolution</div>
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
    props: ['students', 'violations', 'offense_levels', 'penalty_actions', 'statuses', 'transaction_number'],
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
