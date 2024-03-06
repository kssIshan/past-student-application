<script setup>
import { Link } from '@inertiajs/vue3';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import UnionProjectDetailsComponent from '@/Pages/Union/UnionProjectDetailsComponent.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavForPages from '@/Layouts/NavForPages.vue';

//const projects = ref([]);


const searchStudentUnion = ref("searchStudentUnion")

const props = defineProps({
    union: {
        type: Object
    },
    projects: {
        type: Array//Array of projects. I tried use paginationa here
    },
    projectArray: {
        type: Object//union object with array of project related to the union
    },
    student: {
        type: Object
    }
})


</script>


<template>

    <Head title="Student_union_project" />
    <AuthenticatedLayout>





        <!-- <UnionProjectDetailsComponent :union="union" :projects="projects" :projectArray="projectArray"
            :student="student">

        </UnionProjectDetailsComponent> -->

        <div class="p-10">
            <!-- <div>{{ projects }}</div> -->
            <div class="grid grid-cols-2 gap-5 sm:mb-10 px-8">
                <div>
                    <p class="  p-4 font-medium text-md text-gray-500  font-large">{{ student.first_name }} {{
                        student.last_name
                    }}
                        <br> {{
                            student.reg_no }}
                    </p>
                </div>

            </div>




            <div class="px-8">
                <div class="border-2 border-gray-900/10 rounded-lg ml-2 my-2 p-4 shadow-inner hover:shadow-lg  pb-3">

                    <table class="w-full  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Union Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Project Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Duation
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Start Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    End Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <!-- <th scope="col" class="px-6 py-3">
                                    Action
                                </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="project in projects" :key="project.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    {{ union.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ project.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ project.duration }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ project.start_date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ project.end_date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ project.description }}
                                </td>
                                <!-- <td class="flex items-center px-6 py-4">
                                    <Link
                                        :href="route('unionProject.destroy', { studentId: student.id, unionId: union.id, projectId: project.id })"
                                        method="delete" as="button">
                                    <p class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><svg
                                            width="15" height="18" viewBox="0 0 15 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.5 1H11L10 0H5L4 1H0.5V3H14.5M1.5 16C1.5 16.5304 1.71071 17.0391 2.08579 17.4142C2.46086 17.7893 2.96957 18 3.5 18H11.5C12.0304 18 12.5391 17.7893 12.9142 17.4142C13.2893 17.0391 13.5 16.5304 13.5 16V4H1.5V16Z"
                                                fill="#FF6868" />
                                        </svg>
                                    </p>
                                    </Link>
                                </td> -->
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>




        </div>
        <div class="p-4 flex justify-end">
            <Link :href="route('union.searchUnion', { regNo: props.student.reg_no, searchUnionId: searchStudentUnion })"
                class="rounded-md bg-rc-java sm:px-10 sm:py-2 py-1 px-5 text-sm font-semibold text-white  hover:bg-rc-bondi-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:rc-bondi-blue2">
            back
            </Link>
        </div>
    </AuthenticatedLayout>
</template>