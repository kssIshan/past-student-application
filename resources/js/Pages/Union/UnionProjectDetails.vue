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

const searchStudent = ref("searchStudent")

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
/*const form2 = useForm({
    student_id: props.student.id,
    union_id: "",
    name: "",
    status: "",
    duration: "",
    description: "",
    start_date: "",
    end_date: ""

})*/
const form = useForm({

    union_id: props.union.id,

    unionProjects: [{ project_id: "" }],

})
let projectLoading = ref(false);

const showProject = ref(false);
const toggleSaveProject = async () => {
    showProject.value = !showProject.value;

}

const getProject = async () => {

    // const response = await fetch(`https:example.com/results?page=${page}`);
    // laravelExam.value = await response.json();
    // const response = await axios.get(route('exam.index2', { student: props.student.id }));
    // laravelExam.value = response;
    //exams = response.data.exams;

    try {

        //const studentId = props.student.id;
        const response = await axios.get(
            // Use the route helper function to generate the URL
            route('unionProject.index2', { studentId: props.student.id, unionId: props.union.id }));
        console.log(response, "response");
        projects.value = response.data;
        //console.log(projects, "projects");

    } catch (error) {
        console.error('Error fetching results:', error);
    }

}
//getProject();
const postProject = async () => {
    //console.log(unionId, 'by postProject');
    try {
        //projectLoading.value = true
        const response = await axios.post(route('unionProject.attachProject',
            { studentId: props.student.id, unionId: props.union.id }), form);
        console.log(response);


        // projectLoading.value = false
        toggleSaveProject();

        window.location.href = route('unionProject.index', { studentId: props.student.id, unionId: props.union.id });

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

    <Head title="Student_union_project" />
    <AuthenticatedLayout>



        <div class="relative invisible sm:visible sm:mt-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <Link :href="route('dashboard')" :active="route().current('dashboard')"
                            class="relative inline-flex items-center py-2 text-xs font-semibold text-rc-gunsmoke  ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        Home
                        </Link>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>

                            <Link
                                :href="route('union.searchUnion', { regNo: props.student.reg_no, searchUnionId: searchStudent })"
                                class="relative inline-flex items-center py-2 text-xs font-medium text-rc-gunsmoke  ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                            Union Details </Link>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                Union Project Details</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

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
                <div class=" justify-end  rounded-lg  sm:ml-0    mt-10">
                    <div>
                        <div>
                            <div class="lg:flex" v-if="showProject">
                                <div class="lg:flex-1">
                                    <div
                                        class="sm:col-span-1 invisible sm:invisible lg:visible z-0 sm:z-0  lg:w-[80%] sm:w-[50%]">
                                        <div>
                                            <div>
                                                <div class="sm:col-span-3">
                                                    <label for="first-name"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Project
                                                        Name*
                                                    </label>
                                                    <!-- <form
                                                    @submit.prevent="form.post(route('unionProject.attachProject', { studentId: student.id, unionId: union.id }))"> -->
                                                    <form>
                                                        <div class="lg:flex-column mt-2">
                                                            <div v-for="(project, index) in form.unionProjects"
                                                                :key="index">
                                                                <p v-if="projectLoading">Loading </p>
                                                                <div class="lg:flex-1 ">
                                                                    <select
                                                                        class="block w-[97%] sm:w-[90%] lg:w-[58%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                                        v-model="project.project_id">
                                                                        <option
                                                                            v-for=" project in projectArray.projects"
                                                                            :value="project.id" :key="project.id">
                                                                            {{ project.name }}
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                <div class="lg:flex-1 ">
                                                                    <InputError class="mt-2"
                                                                        :message="form.errors.project_id" />
                                                                    <button
                                                                        class="text-white m-2 bg-rc-java hover:bg-rc-java-300 focus:ring-4 b ring-1 ring-inset focus:outline-none focus:ring-rcjava ring-rc-java font-medium text-lg rounded-lg text-sm px-6 py-2 text-center inline-flex items-center dark:bg-rc-java dark:hover:bg-rc-java dark:focus:ring-rc-java"
                                                                        type="button" v-if="index > 0"
                                                                        @click="removeResult(index)">Remove</button>

                                                                    <!-- <button type="button" v-if="index < 9" @click="addResult">Add</button> -->
                                                                </div>
                                                            </div>
                                                            <div><button @click="postProject" type="button"
                                                                    class="text-white m-2 bg-rc-java hover:bg-rc-java-300 focus:ring-4 b ring-1 ring-inset focus:outline-none focus:ring-rcjava ring-rc-java font-medium text-lg rounded-lg text-sm px-6 py-2 text-center inline-flex items-center dark:bg-rc-java dark:hover:bg-rc-java dark:focus:ring-rc-java">
                                                                    save</button>
                                                            </div>
                                                            <div class=" flex  justify-center sm:ml-0  sm:mr-3  ">
                                                                <button type="button" @click="addResult"
                                                                    class="text-white m-2 bg-rc-java  hover:bg-rc-bondi-blue2 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:rc-bondi-blue2 focus:ring-4 b ring-1 ring-inset focus:outline-none focus:ring-rcjava ring-rc-java font-medium text-lg rounded-lg text-sm px-6 py-2 text-center inline-flex items-center dark:bg-rc-java dark:hover:bg-rc-java dark:focus:ring-rc-java">
                                                                    Add Another Project
                                                                    <div class="pl-4">
                                                                        <svg width="25" height="24" viewBox="0 0 25 24"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M13 5C8.85775 5 5.5 8.35775 5.5 12.5C5.5 16.6423 8.85775 20 13 20C17.1423 20 20.5 16.6423 20.5 12.5C20.5 8.35775 17.1423 5 13 5ZM16.75 13.25H13.75V16.25H12.25V13.25H9.25V11.75H12.25V8.75H13.75V11.75H16.75V13.25Z"
                                                                                fill="white" />
                                                                        </svg>
                                                                    </div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end" @click="toggleSaveProject()">
                                <span v-if="showProject"><button
                                        class="text-sm font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                                        type="button" @click="postProject()">Done Save</button></span>
                                <!-- <span v-if="!showText">Show text</span> -->
                                <span v-else> <button
                                        class="text-sm font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                                        type="button">Add Project</button></span>
                            </div>
                        </div>
                    </div>
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
                                    <p class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><svg
                                            width="15" height="18" viewBox="0 0 15 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
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
            </div>




        </div>
    </AuthenticatedLayout>
</template>