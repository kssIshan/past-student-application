<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
//import axios from 'axios';

const searchEducationId = ref("searchStudent")

const props = defineProps({
    student: {
        type: Object
    },
    subjects: {
        type: Array
    }
})

const removeResult = (index) => {
    form.results.splice(index, 1);
}
const addResult = () => {
    form.results.push({ subject_id: "", grade: "" });
}

const options = ref([
    { text: 'Math', value: 1 },
    { text: 'Science', value: 2 },
    { text: 'English', value: 3 }
])
const form = useForm({
    index_no: "",
    type: "",
    exam_year: "",
    //shedule_date: new Date().toISOString().split('T')[0],
    attempt: "",
    island_rank: "",
    district_rank: "",
    z_score: "",
    cut_of_marks: "",
    subject_stream: "",
    is_pass: false,
    results: [{ subject_id: "", grade: "" }]

});

</script>

<template>

    <Head title="Add Exam" />
    <AuthenticatedLayout>
        <div class="relative invisible sm:visible sm:mt-4 ml-4">


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
                                :href="route('exam.index1', { regNo: props.student.reg_no, searchEducationId: searchEducationId })"
                                class="relative inline-flex items-center py-2 text-xs font-semibold text-rc-gunsmoke  ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                            Education </Link>
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
                                Exam</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class=" my-2 px-3  pb-3">
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
                <h1 class="text-rc-eastern-blue text-lg sm:text-3xl pt-3 pb-3 pl-4"> Add a New Exam</h1>
            </div>
            <form @submit.prevent="form.post(route('exam.store', { studentId: student.id }))">

                <div class=" border-2 border-gray-900/10 m-8 pl-3 shadow-lg pb-3 ">
                    <div class="ml-3 my-2 px-3  pb-3">
                        <h2 class="p-4 font-semibold leading-7 text-gray-900 text-base pb-5">Exam Details</h2>

                    </div>

                    <div class="lg:flex sm:flex ">
                        <div class="lg:flex-1 sm:flex-1">
                            <div class="sm:col-span-3">
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:my-5">Exam
                                    Type</label>
                                <div class="mt-2">


                                    <select
                                        class="block w-[85%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        v-model="form.type">
                                        <option>Scholarship</option>
                                        <option>O/L</option>
                                        <option>A/L</option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.type" />

                                </div>
                            </div>
                        </div>
                        <div class="lg:flex-1  sm:flex-1 ">
                            <div
                                class="sm:col-span-3 invisible sm:visible lg:visible z-0 sm:z-0 sm:absolute  lg:w-[43%] sm:w-[50%]">
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:my-5">Index
                                    Number</label>
                                <div class="mt-2">
                                    <input type="text" name="first-name" v-model="form.index_no" id="first-name"
                                        autocomplete="given-name"
                                        class="block w-[85%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <InputError class="mt-2" :message="form.errors.index_no" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:flex sm:flex">
                        <div class="lg:flex-1 sm:flex-1">
                            <div class="sm:col-span-3">
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6 sm:my-5 text-gray-900">Exam
                                    Year</label>
                                <div class="mt-2">
                                    <input type="text" name="first-name" v-model="form.exam_year" id="first-name"
                                        autocomplete="given-name"
                                        class="block sm:w-[80%] w-[95%] lg:w-[88%] rounded-md border-0 py-1.5 text-gray-900 sm:my-5 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <InputError class="mt-2" :message="form.errors.exam_year" />
                                </div>
                            </div>
                        </div>
                        <div class="lg:flex-1  sm:flex-1 ">
                            <div
                                class="sm:col-span-3 invisible sm:visible lg:visible z-0 sm:z-0 sm:w-[50%] absolute lg:w-[43%]">
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6 sm:my-5 text-gray-900 sm:my-5">Attempt</label>
                                <div class="mt-2">
                                    <input type="text" name="first-name" v-model="form.attempt" id="first-name"
                                        autocomplete="given-name"
                                        class="block w-[85%] rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <InputError class="mt-2" :message="form.errors.attempt" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="sm:col-span-3 w-screen visible sm:invisible lg:invisible sm:absolute lg:absolute">
                <label for="first-name" class="block text-sm font-medium leading-6  text-gray-900">Attempt</label>
                <div class="mt-2">
                    <input type="text" name="first-name" v-model="form.attempt" id="first-name" autocomplete="given-name"
                        class="block w-[85%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="student@gmail.com">
                    <InputError class="mt-2" :message="form.errors.attempt" />
                </div>
            </div> -->
                    <div class="lg:flex sm:flex">
                        <div class="lg:flex-1 sm:flex-1">
                            <div class="sm:col-span-3">
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:my-5">Island
                                    Rank
                                </label>
                                <div class="mt-2">
                                    <input type="text" name="first-name" v-model="form.island_rank" id="first-name"
                                        autocomplete="given-name"
                                        class="block sm:w-[80%] w-[95%] sm:my-5 lg:w-[88%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <InputError class="mt-2" :message="form.errors.island_rank" />
                                </div>
                            </div>
                        </div>
                        <div class="lg:flex-1  sm:flex-1 ">
                            <div
                                class="sm:col-span-3 invisible sm:visible lg:visible z-0 sm:z-0 sm:w-[50%] absolute lg:w-[43%]">
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:my-5">District
                                    Rank</label>
                                <div class="mt-2">
                                    <input type="text" name="first-name" v-model="form.district_rank" id="first-name"
                                        autocomplete="given-name"
                                        class="block w-[85%] rounded-md border-0 sm:my-5 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <InputError class="mt-2" :message="form.errors.district_rank" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="sm:col-span-3 w-screen visible sm:invisible lg:invisible sm:absolute lg:absolute">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">District
                    Rank</label>
                <div class="mt-2">
                    <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                        class="block w-[85%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="student@gmail.com">
                </div>
            </div> -->
                    <div class="lg:flex sm:flex">
                        <div class="lg:flex-1 sm:flex-1">
                            <div class="sm:col-span-3">
                                <label for="first-name"
                                    class="block text-sm font-medium sm:my-5 leading-6 text-gray-900">Z-Score
                                </label>
                                <div class="mt-2">
                                    <input type="text" name="first-name" v-model="form.z_score" id="first-name"
                                        autocomplete="given-name"
                                        class="block sm:w-[80%] w-[95%] lg:w-[88%] sm:my-5 rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <InputError class="mt-2" :message="form.errors.z_score" />
                                </div>
                            </div>
                        </div>
                        <div class="lg:flex-1  sm:flex-1 ">
                            <div
                                class="sm:col-span-3 invisible sm:visible lg:visible z-0 sm:z-0 sm:w-[50%] absolute lg:w-[43%]">
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6 sm:my-5 text-gray-900">Cut
                                    Off
                                    Marks</label>
                                <div class="mt-2">
                                    <input type="text" name="first-name" v-model="form.cut_of_marks" id="first-name"
                                        autocomplete="given-name"
                                        class="block w-[85%] rounded-md border-0 py-1.5 sm:my-5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <InputError class="mt-2" :message="form.errors.cut_of_marks" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:flex sm:flex">
                        <div class="lg:flex-1 sm:flex-1">
                            <div class="sm:col-span-3">
                                <label for="first-name"
                                    class="block text-sm font-medium sm:my-5 leading-6 text-gray-900">Subject Stream
                                </label>
                                <div class="mt-2">
                                    <input type="text" name="first-name" v-model="form.subject_stream" id="first-name"
                                        autocomplete="given-name"
                                        class="block sm:w-[80%] w-[95%] lg:w-[88%] sm:my-5 rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        placeholder="ex:Biology,Math,Commerce,Art...">
                                    <InputError class="mt-2" :message="form.errors.subject_stream" />
                                </div>
                            </div>
                        </div>
                        <div class="lg:flex-1  sm:flex-1 ">
                            <div
                                class="sm:col-span-3 invisible sm:visible lg:visible z-0 sm:z-0 sm:w-[50%] absolute lg:w-[43%]">
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6 sm:my-5 text-gray-900">Pass
                                    or
                                    Fail</label>
                                <div class="mt-2">
                                    <input type="checkbox" name="first-name" v-model="form.is_pass" id="first-name"
                                        autocomplete="given-name"
                                        class="block  rounded-md border-0 py-1.5 sm:my-5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <InputError class="mt-2" :message="form.errors.is_pass" />
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- <div class="flex items-center gap-4">
                        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                    </div> -->


                </div>
                <div class=" border-2 border-gray-900/10 m-8 pl-3 shadow-lg pb-3">

                    <div class=" ml-3 my-2 px-3 pb-3">
                        <h2 class="text-base font-semibold leading-7 text-gray-900  pb-5">Exam Results
                        </h2>

                    </div>
                    <div class=" grid grid-cols-2 flex-column justify-between sm:justify-around">

                        <div v-for="(result, index) in form.results" :key="index" class="flex items-center gap-4">
                            <div>
                                <div>Count</div>
                                <div><input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                        class="w-10 rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        placeholder="01"></div>
                            </div>
                            <div>
                                <!-- <InputLabel :for="'subject' + index" :value="'Subject ' + (index + 1)" /> -->
                                <label>
                                    Subject</label>
                                <div>

                                    <select
                                        class="w-50 rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        v-model="result.subject_id">
                                        <option v-for=" subject in subjects" :value="subject.id">
                                            {{ subject.name }}
                                            {{ subject.code }}
                                        </option>
                                    </select>

                                </div>


                            </div>
                            <div>
                                <div>
                                    <label> Grade</label>
                                </div>

                                <select
                                    class="w-50 rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    v-model="result.grade">
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                    <option>S</option>
                                    <option>F</option>
                                </select>
                            </div>
                            <button
                                class="text-white mt-6 bg-rc-java hover:bg-rc-java-300 focus:ring-4 b ring-1 ring-inset focus:outline-none focus:ring-rcjava ring-rc-java font-medium text-lg rounded-lg text-sm px-6 py-2 text-center inline-flex items-center dark:bg-rc-java dark:hover:bg-rc-java dark:focus:ring-rc-java"
                                type="button" v-if="index > 0" @click="removeResult(index)">Remove</button>
                            <button
                                class="text-sm mt-6 font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                                type="button" v-if="index < 9" @click="addResult">Add</button>
                        </div>
                        <div class="mt-2">
                        </div>
                    </div>
                </div>
                <div class="mt-6 sm:mt-12 lg:mt-12 flex items-center gap-x-6 justify-end lg:mr-16 mr-5 sm:mr-20">
                    <button type="button"
                        class="text-sm font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded">
                        <Link
                            :href="route('exam.index1', { regNo: props.student.reg_no, searchEducationId: searchEducationId })">
                        Cancel
                        </Link>
                    </button> <button type="submit"
                        class="rounded-md bg-rc-java sm:px-10 sm:py-2 py-1 px-5 text-sm font-semibold text-white  hover:bg-rc-bondi-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:rc-bondi-blue2">Submit</button>
                </div>
            </form>

        </div>






    </AuthenticatedLayout>
</template>