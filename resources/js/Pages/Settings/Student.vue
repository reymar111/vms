<template>
    <AuthenticatedLayout>

        <Head title="Students" />
        <div class="py-1">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-lg sm:rounded-lg"
                >
                <div class="p-6 text-gray-900 flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0 ">
                    <h3 class="text-2xl font-bold ">Students</h3>

                </div>

                <div class="px-6 pb-6 overflow-x-auto bg-white shadow-md rounded-lg mt-0">
                    <div v-if="is_created" id="alert-border-1" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 " role="alert">
                        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <div class="ms-3 text-sm font-medium">
                            Student Created Successfully.
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
                            Student Updated Successfully.
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
                            Student Deleted Successfully.
                        </div>
                        <button @click="is_deleted = false" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                            <span class="sr-only">Dismiss</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>

                    <div class="mb-2 text-gray-900 flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0 ">
                            <button @click="openForm" class="px-4 py-2 mb-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center space-x-2">
                                <svg class="w-6 h-6 text-white-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                                </svg>
                                    <span>New Item</span>
                            </button>

                            <!-- header -->
                            <div class="flex items-center space-x-2 w-full md:w-auto">
                                <input
                                    type="text"
                                    placeholder="Search..."
                                    v-model="search"
                                    class="px-4 py-2 border rounded-lg w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-blue-500"
                                />
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center space-x-2">
                                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    <span>Search</span>
                                </button>
                            </div>

                            <!-- body -->
                        </div>


                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">#</th>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">ID Number</th>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">Name</th>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">Address</th>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">Course</th>
                                <th class="px-4 py-2 text-left text-gray-700 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b" v-for="(item, index) in filteredStudents" :key="index">
                                <td class="px-4 py-2">{{ index + 1 }}</td>
                                <td class="px-4 py-2">{{ item.id_number }}</td>
                                <td class="px-4 py-2">{{ item.full_name }}</td>
                                <td class="px-4 py-2">{{ item.address }}</td>
                                <td class="px-4 py-2">{{ item.program != null ? item.program.code : '' }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <button @click="editItem(item)" type="button" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center me-2">
                                    <svg class="w-6 h-6 text-white-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                    </svg>
                                        Edit
                                    </button>
                                    <button  @click="OpenDeleteForm(item)" type="button" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center me-2">
                                        <svg class="w-6 h-6 text-white-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                        </svg>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <!-- More rows here -->
                        </tbody>
                    </table>
                </div>

                </div>
            </div>


        </div>

        <!-- Main modal -->
        <div  v-if="form.active" id="default-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm ">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            {{ form.is_editing ? 'Edit' : 'Create' }} Student
                        </h3>
                        <button @click="closeForm" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <!-- <div class="p-4 md:p-5 space-y-4"> -->
                    <div class="p-1 md:p-5 grid grid-cols-1 md:grid-cols-2 gap-4 mb-0">

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">First Name</label>
                            <input v-model="form.first_name" type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Middle Name</label>
                            <input v-model="form.middle_name" type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Last Name</label>
                            <input v-model="form.last_name" type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Ext Name</label>
                            <input v-model="form.ext_name" type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email Address</label>
                            <input v-model="form.email_address" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Contact #</label>
                            <input v-model="form.contact_number" type="number" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">ID #</label>
                            <input v-model="form.id_number" type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                        </div>
                        <div>
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course</label>
                            <select v-model="form.program_id" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(item, index) in programs" :key="index" :value="item.id">{{ item.code }} - {{ item.description }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year Level</label>
                            <select v-model="form.year_level_id" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(item, index) in year_levels" :key="index" :value="item.id">{{ item.name}}</option>
                            </select>
                        </div>

                        <div>
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section</label>
                            <select v-model="form.section_id" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(item, index) in sections" :key="index" :value="item.id">{{ item.name }}</option>
                            </select>
                        </div>


                    </div>
                    <div class="p-4 md:p-5 space-y-4 mt-0">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Address</label>
                            <input v-model="form.address" type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                        </div>


                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                        <button @click="save" v-if="form.is_editing === false" data-modal-hide="default-modal" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Save</button>
                        <button @click="update" v-if="form.is_editing" data-modal-hide="default-modal" type="button" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Update</button>
                        <button @click="closeForm" data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main modal -->
        <div  v-if="delete_form.active" id="default-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm ">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            Delete this student?
                        </h3>
                        <button @click="closeForm" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <div>
                            {{ delete_form.name }}
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                        <button @click="deleteItem" data-modal-hide="default-modal" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Yes, Delete</button>
                        <button @click="CloseDeleteForm" data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Cancel</button>
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
    props: ['students', 'programs', 'sections', 'year_levels'],
    components: {
        AuthenticatedLayout,
        Link,
        Head
    },
    data() {
        return {
            form: useForm({
                id: '',
                id_number: '',
                first_name: '',
                middle_name: '',
                last_name: '',
                ext_name: '',
                address: '',
                contact_number: '',
                email_address: '',
                program_id: '',
                section_id: '',
                year_level_id: '',
                active: false,
                is_editing: false,
            }),

            delete_form: useForm({
                id: '',
                name: '',
                active: false,
            }),

            loading_button: false,
            disabled_button: false,
            is_created: false,
            is_updated: false,
            is_deleted: false,

            search: '',

        }
    },
    mounted() {

    },
    computed: {
        filteredStudents() {
            if (!this.search) return this.students;

            return this.students.filter(student => {
                return Object.values(student).some(value =>
                    String(value).toLowerCase().includes(this.search.toLowerCase())
                );
            });
        }
    },
    methods: {
        openForm() {
            this.form.active = true
            this.form.is_editing = false
        },

        closeForm() {
            this.form.id = ''
            this.form.id_number = ''
            this.form.first_name = ''
            this.form.middle_name = ''
            this.form.last_name = ''
            this.form.ext_name = ''
            this.form.address = ''
            this.form.contact_number = ''
            this.form.email_address = ''
            this.form.program_id = ''
            this.form.year_level_id = ''
            this.form.section_id = ''
            this.form.active = false
            this.form.is_editing = false
        },

        editItem(item) {
            this.form.id = item.id
            this.form.id_number = item.id_number
            this.form.first_name = item.first_name
            this.form.middle_name = item.middle_name
            this.form.last_name = item.last_name
            this.form.ext_name = item.ext_name
            this.form.address = item.address
            this.form.contact_number = item.contact_number
            this.form.email_address = item.email_address
            this.form.program_id = item.program_id
            this.form.year_level_id = item.year_level_id
            this.form.section_id = item.section_id
            this.form.active = true
            this.form.is_editing = true
        },

        OpenDeleteForm(item) {
            this.delete_form.id = item.id
            this.delete_form.name = item.full_name
            this.delete_form.active = true
        },

        CloseDeleteForm() {
            this.delete_form.id = ''
            this.delete_form.name = ''
            this.delete_form.active = false
        },

        save() {
            this.form.post('/student/store', {
                onSuccess: () => {
                    this.closeForm()
                    this.is_created = true
                },
                onError: () => {

                }
            })
        },

        update() {
            this.form.patch('/student/update/'+this.form.id, {
                onSuccess: () => {
                    this.closeForm()
                    this.is_updated = true
                },
                onError: () => {

                }
            })
        },

        deleteItem() {
            this.form.delete('/student/destroy/'+this.delete_form.id, {
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
