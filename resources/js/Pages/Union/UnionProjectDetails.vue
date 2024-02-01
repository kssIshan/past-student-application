<script setup>
import { Link } from '@inertiajs/vue3';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavForPages from '@/Layouts/NavForPages.vue';
const props = defineProps({
    union: {
        type: Object
    },
    projects: {
        type: Array
    },
    projectsArray: {
        type: Array
    },
    student: {
        type: Object
    }
})
const form2 = useForm({
    student_id: props.student.id,
    union_id: "",
    name: "",
    status: "",
    duration: "",
    description: "",
    start_date: "",
    end_date: ""

})
const form = useForm({

    union_id: props.union.id,

    unionProjects: [{ project_id: null }],

})
let projectLoading = ref(false);

const showProject = ref(false);
const toggleSaveProject = async () => {
    showProject.value = !showProject.value;

}
const postProject = async () => {
    //console.log(unionId, 'by postProject');
    try {
        projectLoading.value = true
        const response = await axios.post(route('project.store'), form2);
        console.log(response, route('project.store'));


        projectLoading.value = false


    } catch (e) {
        console.log(e, "6");
        // console.log(e.response.status, 'status');
        // if (e.response.status === 422) {
        //     //error = e.response.data.errors
        //     console.log(e.response.data.errors, "putError msg");
        // }
    }
}
const removeResult = (index) => {
    form.unionProjects.splice(index, 1);
}
const addResult = () => {
    form.unionProjects.push({ project_id: "" });
}
</script>


<template>
    <Head title="Add Union" />
    <AuthenticatedLayout>


        <div class="relative invisible sm:visible sm:mt-4">


            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">

                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="#"
                                class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Student
                                Unions</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                Union Project Details</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div>{{ projectsArray }}</div>
        <div class="grid grid-cols-2 gap-5 sm:mb-10 py-10">
            <p class="  pl-14 font-medium text-md text-gray-500  font-large">{{ student.first_name }} {{ student.last_name
            }}
                <br> {{
                    student.reg_no }}
            </p>
        </div>

        <div class=" grid  justify-end sm:ml-0  sm:mr-3  mt-10 mr-2 ">
            <!-- <button type="button"
                class="text-white mr-16 bg-rc-bondi-blue hover:bg-rc-bondi-blue2  font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 focus:outline-non">
                <Link :href="route('unionProject.create', { studentId: student.id })" method="get" as="button">Add New
                Union
                </Link>
            </button> -->

        </div>
        <div>
            <div>
                <div>
                    <div class="lg:flex" v-if="showProject">
                        <div class="lg:flex-1">
                            <div class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0  lg:w-[50%] sm:w-[50%]">
                                <div>
                                    <div>
                                        <div class="sm:col-span-3">
                                            <label for="first-name"
                                                class="block text-sm font-medium leading-6 text-gray-900">Project
                                                Name*
                                            </label>
                                            <div class="lg:flex-column mt-2">
                                                <div v-for="(project, index) in form.unionProjects" :key="index">
                                                    <p v-if="unionsLoading">Loading </p>
                                                    <div class="lg:flex-1 ">
                                                        <select
                                                            class="block w-[97%] sm:w-[90%] lg:w-[58%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                            v-model="project.project_id">
                                                            <option v-for=" project in projectsArray" :value="project.id">
                                                                {{ project.name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="lg:flex-1 ">
                                                        <InputError class="mt-2" :message="form.errors.project_id" />
                                                        <button
                                                            class="text-white bg-rc-java hover:bg-rc-java-300 focus:ring-4 b ring-1 ring-inset focus:outline-none focus:ring-rcjava ring-rc-java font-medium text-lg rounded-lg text-sm px-6 py-2 text-center inline-flex items-center dark:bg-rc-java dark:hover:bg-rc-java dark:focus:ring-rc-java"
                                                            type="button" v-if="index > 0"
                                                            @click="removeResult(index)">Remove</button>
                                                        <!-- <button type="button" v-if="index < 9" @click="addResult">Add</button> -->


                                                    </div>
                                                </div>
                                                <div class=" flex  justify-center sm:ml-0  sm:mr-3  mt-10">
                                                    <button type="button" @click="addResult"
                                                        class="text-white bg-rc-java  hover:bg-rc-bondi-blue2 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:rc-bondi-blue2 focus:ring-4 b ring-1 ring-inset focus:outline-none focus:ring-rcjava ring-rc-java font-medium text-lg rounded-lg text-sm px-6 py-2 text-center inline-flex items-center dark:bg-rc-java dark:hover:bg-rc-java dark:focus:ring-rc-java">
                                                        Add Another Project
                                                        <div class="pl-4">
                                                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M13 5C8.85775 5 5.5 8.35775 5.5 12.5C5.5 16.6423 8.85775 20 13 20C17.1423 20 20.5 16.6423 20.5 12.5C20.5 8.35775 17.1423 5 13 5ZM16.75 13.25H13.75V16.25H12.25V13.25H9.25V11.75H12.25V8.75H13.75V11.75H16.75V13.25Z"
                                                                    fill="white" />
                                                            </svg>

                                                        </div>

                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-10" @click="toggleSaveProject()">
                        <span v-if="showProject"><button
                                class="text-sm font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                                type="button">Done Save</button></span>
                        <!-- <span v-if="!showText">Show text</span> -->
                        <span v-else> <button
                                class="text-sm font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                                type="button">Add Project</button></span>

                    </div>
                </div>

            </div>

        </div>

        <div class="relative px-20 overflow-x-auto shadow-md sm:rounded-lg">
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

                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
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

                        <td class="flex items-center px-6 py-4">



                            <Link
                                :href="route('unionProject.destroy', { studentId: student.id, unionId: union.id, projectId: project.id })"
                                method="delete" as="button">
                            <p class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><svg width="15"
                                    height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.5 1H11L10 0H5L4 1H0.5V3H14.5M1.5 16C1.5 16.5304 1.71071 17.0391 2.08579 17.4142C2.46086 17.7893 2.96957 18 3.5 18H11.5C12.0304 18 12.5391 17.7893 12.9142 17.4142C13.2893 17.0391 13.5 16.5304 13.5 16V4H1.5V16Z"
                                        fill="#FF6868" />
                                </svg>
                            </p>
                            </Link>


                        </td>
                    </tr>



                </tbody>
            </table>

        </div>
        <div>
            <div class="flex justify-center">
                <nav aria-label="Page navigation example">
                    <ul class="inline-flex -space-x-px text-sm  mt-10">
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-600 bg-white  rounded-s-lg hover:bg-rc-java hover:text-rc-lily-white dark:bg-rc-java dark:border-rc-java dark:text-rc-java dark:hover:bg-rc-java dark:hover:text-white">Previous</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-rc-java hover:text-rc-lily-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-rc-java dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-rc-java hover:text-rc-lily-white mr-1 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-rc-java dark:hover:text-white z-10">2</a>
                        </li>

                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border-gray-300 rounded-e-lg hover:bg-rc-java hover:text-rc-lily-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-rc-java dark:hover:text-white">Next</a>
                        </li>
                    </ul>
                </nav>


            </div>
        </div>

        <!-- <NavForPages :student="student"></NavForPages> -->



        <!-- <div>{{ union.name }}</div>
        <div v-for="project in projects">
            <div>prject name:{{ project.name }}</div>
            <div>Duration:{{ project.duration }}</div>
            <div>Start date:{{ project.start_date }}</div>
            <div>End Date:{{ project.end_date }}</div>
            <div>Description:{{ project.description }}</div> -->
        <!-- No need of Edit project from here becase it is attach -->
        <!-- <div>Edit</div> -->
        <!-- Delete value from student_union_project->UnionProjectController -->
        <!-- <Link :href="route('unionProject.destroy', { studentId: student.id, unionId: union.id, projectId: project.id })"
                method="delete" as="button">
            Delete</Link>
        </div> -->


    </AuthenticatedLayout>
</template>