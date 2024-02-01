<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';
import { reactive } from 'vue';

let unionsLoading = ref(false);
let projectLoading = ref(false);
const showUnion = ref(false);
const showProject = ref(false);
//let unionId = ref("");
//let error = reactive([]);
let projects = reactive([]);

const toggleSaveUnion = async () => {
    showUnion.value = !showUnion.value;
}

const toggleSaveProject = async () => {
    showProject.value = !showProject.value;

}
const props = defineProps({
    student: {
        type: Object
    },
    unions: {
        type: Array
    },
    projects: {
        type: Array
    }
})

const form = useForm({

    union_id: "",
    position: "",
    duration: "",
    join_date: "",
    leave_date: "",
    unionProjects: [{ project_id: null }],

})
const form1 = useForm({
    studentId: props.student.id,
    name: "",
    start_date: "",
    status: "",

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
const postUnion = async () => {

    try {
        unionsLoading.value = true
        const response = await axios.post(route('union.store'), form1);
        console.log(response, route('union.store'));
        form1 = {};
        EditCommentId = null
        unionsLoading.value = false


    } catch (e) {
        //console.log(e, "6");
        //console.log(e.response.status, 'status');
        if (e.response.status === 422) {
            //error = e.response.data.errors
            console.log(e.response.data.errors, "putError msg");
        }
    }
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
async function getProject(unionId) {
    try {
        unionsLoading.value = true;

        const response = await axios.get(route('project.index', { unionId: unionId }));
        //console.log(response);
        projects = response.data.projects;  // Use .value to update the ref
        console.log(projects, '->projects');
        unionsLoading.value = false;
    } catch (e) {
        console.log(e, "project error");
    }


}
async function onUnionChange(unionId) {
    if (unionId) {
        getProject(unionId);
        console.log(unionId, 'by onUnionChange');
    }
    // if (showProject === true) {
    //     postProject(unionId);
    // }

    else {
        // Handle the case when no union is selected (if needed)
        projects = [];
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
        <div class="ml-8">
            <div class="relative invisible sm:visible sm:mt-4">


                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="#"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:hover:text-white">

                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="#"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:hover:text-white">Education</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Add New
                                    Union </span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="visible sm:invisible w-screen">
                <a href="#"
                    class="flex  hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg width="9" height="13" viewBox="0 0 9 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.90484 1.09601C7.97414 1.034 8.02856 0.961044 8.065 0.881321C8.10144 0.801598 8.11918 0.716666 8.11721 0.631375C8.11524 0.546083 8.0936 0.462101 8.05352 0.384225C8.01345 0.306349 7.95572 0.236103 7.88364 0.177499C7.81156 0.118894 7.72653 0.0730789 7.63342 0.0426682C7.5403 0.0122575 7.44092 -0.00215295 7.34095 0.000259836C7.24098 0.00267262 7.14238 0.0218613 7.05077 0.0567302C6.95916 0.0915992 6.87634 0.141466 6.80705 0.203482L0.278033 6.04975C0.143201 6.17036 0.0671441 6.33004 0.0654735 6.49602C0.0638028 6.662 0.136645 6.82168 0.269049 6.94229L6.68036 12.7892C6.74795 12.8526 6.82973 12.9038 6.92096 12.9398C7.01219 12.9758 7.11105 12.9959 7.21179 12.9989C7.31254 13.002 7.41317 12.9879 7.50783 12.9576C7.60249 12.9272 7.6893 12.8811 7.76321 12.822C7.83713 12.763 7.89667 12.692 7.93839 12.6134C7.98011 12.5347 8.00317 12.4499 8.00623 12.3639C8.00929 12.2779 7.99229 12.1923 7.95623 12.1122C7.92016 12.0321 7.86573 11.9591 7.79612 11.8973L1.87358 6.49602L7.90484 1.09601Z"
                            fill="#545454" />
                    </svg>
                </a>
            </div>
            <div>
                <h1 class="text-rc-eastern-blue text-lg sm:text-3xl pt-3 pb-3"> Add New Union </h1>
            </div>
            <div>
                <form @submit.prevent="form.post(route('unionProject.store', { student: student }))">
                    <div class="shadow  pt-5 pl-4 pr-3 pb-10 mb-2 mt-2">
                        <div class="lg:flex  lg:mt-10">
                            <div class="lg:flex-1 lg:pt-1 sm:flex-1 sm:pt-1 p-2">
                                <h2 class="pb-3"><b>Student Union Details</b></h2>
                            </div>
                            <div class="lg:flex-1  lg:pt-1 sm:flex-1 sm:pt-1 ">
                                <div class="lg:flex" v-if="showUnion">
                                    <div class="lg:flex-1">
                                        <div
                                            class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0  lg:w-[50%] sm:w-[50%]">

                                            <div>
                                                <h2><b>Add Union</b></h2>

                                            </div>
                                            <InputLabel for="name" value="Name" />
                                            <input
                                                class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                type="text" id="name" v-model="form1.name" />
                                            <InputError class="mt-2" :message="form1.errors.name" />

                                            <InputLabel for="start_date" value="start Date" />
                                            <input
                                                class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                type="date" id="start_date" v-model="form1.start_date" />
                                            <InputError class="mt-2" :message="form1.errors.start_date" />

                                            <InputLabel for="status" value="Status" />
                                            <input
                                                class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                type="text" id="status" v-model="form1.status" />
                                            <InputError class="mt-2" :message="form1.errors.status" />
                                            <div
                                                class="mt-6 sm:mt-12 lg:mt-12 flex items-center gap-x-6 justify-end lg:mr-16 mr-5 sm:mr-20">
                                                <button
                                                    class="rounded-md bg-rc-java sm:px-10 sm:py-2 py-1 px-5 text-sm font-semibold text-white   hover:bg-rc-bondi-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                                    type="button" @click="postUnion()">Send</button>
                                                <p v-if="projectLoading">Loading </p>
                                            </div>
                                            <!-- <button
                                        class="rounded-md bg-rc-java sm:px-10 sm:py-2 py-1 px-5 text-sm font-semibold text-white  hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        type="button" @click="postUnion()">Send</button> -->
                                        </div>

                                    </div>

                                </div>
                                <div class="  p-10 " @click="toggleSaveUnion()">
                                    <span v-if="showUnion"><button
                                            class=" text-sm float-right font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                                            type="button">Done Save</button></span>
                                    <!-- <span v-if="!showText">Show text</span> -->
                                    <span v-else> <button
                                            class="text-sm float-right font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                                            type="button">Add Union</button></span>

                                </div>
                            </div>
                        </div>
                        <div class="lg:flex  lg:mt-10 ">
                            <div class="lg:flex-1">
                                <div class="sm:col-span-3">
                                    <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Union
                                        Name*
                                    </label>
                                    <div class="mt-2">
                                        <select
                                            class="block w-[97%] sm:w-[90%] lg:w-[88%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                            v-model="form.union_id" @change="onUnionChange(form.union_id)">

                                            <option v-for=" union in unions" :value="union.id">
                                                {{ union.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="lg:flex-1 lg:pt-1 sm:flex-1 sm:pt-1 p-2">
                                <div
                                    class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0 sm:absolute absolute lg:w-[50%] sm:w-[50%]">
                                    <div>
                                        <div class="antialiased sans-serif">
                                            <div>
                                                <div class="container py-2">
                                                    <div>

                                                        <label for="datepicker"
                                                            class="block text-sm font-medium leading-6 text-gray-900">Join
                                                            Date</label>
                                                        <div class="relative">

                                                            <input type="date" v-model="form.join_date"
                                                                class="block w-[95%] sm:w-[87%] lg:w-[80%] rounded-md border-0 py-1.5 text-gray-500 ring-1 placeholder:text-xs ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-3 w-screen visible sm:visible lg:invisible  lg:absolute">
                            <div>
                                <div class="antialiased sans-serif">
                                    <div>
                                        <div class="container py-2">
                                            <div>
                                                <label for="datepicker"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Join
                                                    Date</label>
                                                <div class="relative">
                                                    <input type="date" readonly x-model="datepickerValue"
                                                        class="block w-[78%] sm:w-[82%] rounded-md border-0 py-1.5 text-gray-500 ring-1 placeholder:text-xs ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                        <div class="sm:col-span-3 w-screen visible sm:visible lg:invisible lg:absolute">
                            <label for="first-name"
                                class="block text-sm font-medium leading-6 text-gray-900 sm:my-5">Duration*</label>
                            <div class="mt-2">
                                <input type="text" v-model="form.duration" name="first-name" id="first-name"
                                    autocomplete="given-name"
                                    class="block w-[78%] sm:w-[82%] rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                    placeholder="">
                            </div>
                        </div>

                        <div class="lg:flex">
                            <div class="lg:flex-1">
                                <div
                                    class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0 sm:absolute absolute lg:w-[50%] sm:w-[50%]">
                                    <label for="first-name"
                                        class="block text-sm font-medium leading-6 text-gray-900">Duration</label>
                                    <div class="mt-2">
                                        <input type="text" v-model="form.duration" name="first-name" id="first-name"
                                            autocomplete="given-name"
                                            class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                            </div>
                            <div class="lg:flex-1">
                                <div>


                                    <div class="antialiased sans-serif">
                                        <div>
                                            <div class="container py-2">
                                                <div>

                                                    <label for="datepicker"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Leave
                                                        Date</label>
                                                    <div class="relative">
                                                        <!-- <input type="hidden" name="date" x-ref="date"> -->
                                                        <input type="date" v-model="form.leave_date"
                                                            class="block w-[96%] sm:w-[88%] lg:w-[83%] rounded-md border-0 py-1.5 text-gray-500 ring-1 placeholder:text-xs ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="lg:flex">
                            <div class="lg:flex-1">

                                <div
                                    class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0  lg:w-[50%] sm:w-[50%]">
                                    <label class="block text-sm font-medium leading-6 text-gray-900">Position</label>
                                    <div class="mt-2">
                                        <input type="text" v-model="form.position" id="first-name" autocomplete="given-name"
                                            class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="lg:flex">
                        <div class="sm:col-span-3 w-screen visible sm:visible lg:invisible lg:absolute">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Position</label>
                            <div class="mt-2">
                                <input type="text" v-model="form.position" id="first-name" autocomplete="given-name"
                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>


                    <div class="shadow pt-5 pl-4 pr-3 pb-10 mb-2 mt-2">
                        <div class="lg:flex">
                            <div class="lg:flex-1">
                                <h2 class="pb-3"><b> Union Project Details</b></h2>
                            </div>

                            <div class="lg:flex-1 ">
                                <div>
                                    <div class="lg:flex" v-if="showProject">
                                        <div class="lg:flex-1">
                                            <div
                                                class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0  lg:w-[50%] sm:w-[50%]">
                                                <div><b>Add Project</b></div>
                                                <div>Select union</div>
                                                <select
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    v-model="form2.union_id">
                                                    <!-- <div>{{ form.union_id }}</div> -->
                                                    <option v-for=" union in unions" :value="union.id">
                                                        {{ union.name }}
                                                    </option>
                                                </select>
                                                <InputLabel for="name" value="Name" />
                                                <input
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="text" id="name" v-model="form2.name" />
                                                <InputError class="mt-2" :message="form2.errors.name" />

                                                <InputLabel for="status" value="Status" />
                                                <input
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="text" id="status" v-model="form2.status" />
                                                <InputError class="mt-2" :message="form2.errors.status" />

                                                <InputLabel for="duration" value="Duration" />
                                                <input
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="text" id="duration" v-model="form2.duration" />
                                                <InputError class="mt-2" :message="form2.errors.duration" />

                                                <InputLabel for="description" value="Description" />
                                                <input
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="text" id="description" v-model="form2.description" />
                                                <InputError class="mt-2" :message="form2.errors.description" />

                                                <InputLabel for="start_date" value="Start date" />
                                                <input
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="date" id="start_date" v-model="form2.start_date" />
                                                <InputError class="mt-2" :message="form2.errors.start_date" />

                                                <InputLabel for="end_date" value="End date" />
                                                <input
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="date" id="end_date" v-model="form2.end_date" />
                                                <InputError class="mt-2" :message="form2.errors.end_date" />
                                                <div
                                                    class="mt-6 sm:mt-12 lg:mt-12 flex items-center gap-x-6 justify-end lg:mr-16 mr-5 sm:mr-20">
                                                    <button
                                                        class="rounded-md bg-rc-java sm:px-10 sm:py-2 py-1 px-5 text-sm font-semibold text-white   hover:bg-rc-bondi-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                                        type="button" @click="postProject()">Send</button>
                                                    <p v-if="projectLoading">Loading </p>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="p-10 " @click="toggleSaveProject()">
                                    <span v-if="showProject"><button
                                            class="text-sm float-right font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                                            type="button">Done Save</button></span>
                                    <!-- <span v-if="!showText">Show text</span> -->
                                    <span v-else> <button
                                            class="text-sm float-right font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                                            type="button">Add Project</button></span>

                                </div>
                            </div>
                        </div>


                        <div class="lg:flex  lg:mt-10 ">
                            <div class="lg:flex-1">
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
                                                    <option v-for=" project in projects" :value="project.id">
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

                            <!-- <div class="lg:flex-1 lg:pt-1 sm:flex-1 sm:pt-1 ">
                            <label for="first-name"
                                class="block text-sm font-medium leading-6 text-gray-900 sm:my-5">Duration*</label>
                            <div class="mt-2">
                                <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                    class="block w-[95%] sm:w-[88%] lg:w-[83%] rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                    placeholder="">
                            </div>
                        </div> -->
                        </div>
                        <!-- <div>
                            <div>
                                <div>
                                    <div class="lg:flex" v-if="showProject">
                                        <div class="lg:flex-1">
                                            <div
                                                class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0  lg:w-[50%] sm:w-[50%]">
                                                <div><b>Add Project</b></div>
                                                <div>Select union</div>
                                                <select
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    v-model="form2.union_id">
                                                    <option v-for=" union in unions" :value="union.id">
                                                        {{ union.name }}
                                                    </option>
                                                </select>
                                                <InputLabel for="name" value="Name" />
                                                <input
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="text" id="name" v-model="form2.name" />
                                                <InputError class="mt-2" :message="form2.errors.name" />

                                                <InputLabel for="status" value="Status" />
                                                <input
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="text" id="status" v-model="form2.status" />
                                                <InputError class="mt-2" :message="form2.errors.status" />

                                                <InputLabel for="duration" value="Duration" />
                                                <input
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="text" id="duration" v-model="form2.duration" />
                                                <InputError class="mt-2" :message="form2.errors.duration" />

                                                <InputLabel for="description" value="Description" />
                                                <input
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="text" id="description" v-model="form2.description" />
                                                <InputError class="mt-2" :message="form2.errors.description" />

                                                <InputLabel for="start_date" value="Start date" />
                                                <input
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="date" id="start_date" v-model="form2.start_date" />
                                                <InputError class="mt-2" :message="form2.errors.start_date" />

                                                <InputLabel for="end_date" value="End date" />
                                                <input
                                                    class="block w-[85%] lg:w-[83%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="date" id="end_date" v-model="form2.end_date" />
                                                <InputError class="mt-2" :message="form2.errors.end_date" />
                                                <div
                                                    class="mt-6 sm:mt-12 lg:mt-12 flex items-center gap-x-6 justify-end lg:mr-16 mr-5 sm:mr-20">
                                                    <button
                                                        class="rounded-md bg-rc-java sm:px-10 sm:py-2 py-1 px-5 text-sm font-semibold text-white   hover:bg-rc-bondi-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                                        type="button" @click="postProject()">Send</button>
                                                    <p v-if="projectLoading">Loading </p>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="p-10" @click="toggleSaveProject()">
                                    <span v-if="showProject"><button
                                            class="text-sm font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                                            type="button">Done Save</button></span>
                                    <span v-else> <button
                                            class="text-sm font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                                            type="button">Add Project</button></span>

                                </div>
                            </div>

                        </div> -->
                        <!-- <div class="sm:col-span-3 w-screen visible sm:visible lg:invisible  lg:absolute">
                        <div>
                            <div class="antialiased sans-serif">
                                <div>
                                    <div class="container py-2">
                                        <div>
                                            <label for="datepicker"
                                                class="block text-sm font-medium leading-6 text-gray-900">Start
                                                Date</label>
                                            <div class="relative">
                                                <input type="date"
                                                    class="block w-[78%] sm:w-[81%] rounded-md border-0 py-1.5 text-gray-500 ring-1 placeholder:text-xs ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:flex">
                        <div class="lg:flex-1">
                            <div
                                class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0 sm:absolute absolute lg:w-[50%] sm:w-[50%]">
                                <div>
                                    <div class="antialiased sans-serif">
                                        <div>
                                            <div class="container py-2">
                                                <div>

                                                    <label class="block text-sm font-medium leading-6 text-gray-900">Start
                                                        Date</label>
                                                    <div class="relative">
                                                        <input type="date"
                                                            class="block w-[85%] sm:w-[87%] lg:w-[83%] rounded-md border-0 py-1.5 text-gray-500 ring-1 placeholder:text-xs ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="lg:flex-1">
                            <div>
                                <div class="antialiased sans-serif">
                                    <div>
                                        <div class="container py-2">
                                            <div>

                                                <label for="datepicker"
                                                    class="block text-sm font-medium leading-6 text-gray-900">End
                                                    Date</label>
                                                <div class="relative">
                                                    <input type="text"
                                                        class="block w-[95%] sm:w-[88%] lg:w-[83%] rounded-md border-0 py-1.5 text-gray-500 ring-1 placeholder:text-xs ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="first-name"
                            class="block text-sm font-medium leading-6 text-gray-900 sm:my-5">Description</label>
                        <div class="mt-2">
                            <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                class="block w-[95%] lg:w-[43%] sm:w-[88%] rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                placeholder="">
                        </div>
                    </div> -->
                        <div class="mt-6 sm:mt-12 lg:mt-12 flex items-center gap-x-6 justify-end lg:mr-16 mr-5 sm:mr-20">
                            <button type="button"
                                class="text-sm font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded">Cancel</button>
                            <button type="submit"
                                class="rounded-md bg-rc-java sm:px-10 sm:py-2 py-1 px-5 text-sm font-semibold text-white  hover:bg-rc-bondi-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:rc-bondi-blue2">Submit</button>
                        </div>
                    </div>
                </form>


            </div>


        </div>

        <!-- <form action="#"> -->
        <!-- <div>{{ unions }}</div>
        <div>{{ projects }}</div> -->

    </AuthenticatedLayout>
</template>