<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    exam: {
        type: Object
    },
    student: {
        type: Object
    },
    subjects: {
        type: Array
    }


});
</script>

<template>
    <Head title="Show Exam Details" />
    <AuthenticatedLayout>
        <div class="relative invisible sm:visible sm:mt-4 ml-4">


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
                                class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Education</a>
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
                                Exam Result</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="ml-3 my-2 px-3  pb-3">
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
                <h1 class="text-rc-eastern-blue text-lg sm:text-3xl pt-3 pb-3 pl-4">Exam Result</h1>
            </div>
            <div class=" shadow-inner">
                <!-- <div class="ml-3 my-2 px-3  pb-3">
                    <h2 class="text-base font-semibold leading-7 text-gray-900 text-2xl lg:text-3xl pb-5">Exam Details</h2>
                </div> -->
                <div class="lg:flex sm:flex ">
                    <div class="lg:flex-1 sm:flex-1">
                        <div class="lg:flex sm:flex ">
                            <div class="px-6 py-4 lg:flex-1 sm:flex-1">Full Name </div>
                            <div class="px-6 py-4 lg:flex-1 sm:flex-1">
                                <h1>: {{ student.first_name }} {{ student.last_name }} </h1>
                            </div>
                        </div>
                    </div>
                    <div class="lg:flex-1  sm:flex-1 ">
                        <div
                            class="sm:col-span-3 invisible sm:visible lg:visible z-0 sm:z-0 sm:absolute  lg:w-[43%] sm:w-[50%]">
                            <div class="lg:flex-1 sm:flex-1">
                                <div class="lg:flex sm:flex ">
                                    <div class="px-6 py-4 lg:flex-1 sm:flex-1">Index Number </div>
                                    <div class="px-6 py-4 lg:flex-1 sm:flex-1">
                                        <h1>: {{ exam.index_no }} </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:flex sm:flex ">
                    <div class="lg:flex-1 sm:flex-1">
                        <div class="lg:flex sm:flex ">
                            <div class="px-6 py-4 lg:flex-1 sm:flex-1">Exam Type </div>
                            <div class="px-6 py-4 lg:flex-1 sm:flex-1">
                                <h1>: {{ exam.type }} </h1>
                            </div>
                        </div>
                    </div>
                    <div class="lg:flex-1  sm:flex-1 ">
                        <div
                            class="sm:col-span-3 invisible sm:visible lg:visible z-0 sm:z-0 sm:absolute  lg:w-[43%] sm:w-[50%]">
                            <div class="lg:flex-1 sm:flex-1">
                                <div class="lg:flex sm:flex ">
                                    <div class="px-6 py-4 lg:flex-1 sm:flex-1">Exam Year </div>
                                    <div class="px-6 py-4 lg:flex-1 sm:flex-1">
                                        <h1> : {{ exam.exam_year }} </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:flex sm:flex ">
                    <div class="lg:flex-1 sm:flex-1">
                        <div class="lg:flex sm:flex ">
                            <div class="px-6 py-4 lg:flex-1 sm:flex-1">Attempt </div>
                            <div class="px-6 py-4 lg:flex-1 sm:flex-1">
                                <h1>: {{ exam.attempt }} </h1>
                            </div>
                        </div>
                    </div>
                    <div class="lg:flex-1  sm:flex-1 ">
                        <div
                            class="sm:col-span-3 invisible sm:visible lg:visible z-0 sm:z-0 sm:absolute  lg:w-[43%] sm:w-[50%]">
                            <div class="lg:flex-1 sm:flex-1">
                                <div class=" lg:flex sm:flex ">
                                    <div class="px-6 py-4 lg:flex-1 sm:flex-1">Island Rank </div>
                                    <div class=" px-6 py-4 lg:flex-1 sm:flex-1">
                                        <h1>: {{ exam.island_rank }} </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:flex sm:flex ">
                    <div class="lg:flex-1 sm:flex-1">
                        <div class="lg:flex sm:flex ">
                            <div class="px-6 py-4 lgflex-1 sm:flex-1">District Rank </div>
                            <div class="px-6 py-4 lg flex-1 sm:flex-1">
                                <h1>: {{ exam.district_rank }} </h1>
                            </div>
                        </div>
                    </div>
                    <div class="lg:flex-1  sm:flex-1 ">
                        <div
                            class="sm:col-span-3 invisible sm:visible lg:visible z-0 sm:z-0 sm:absolute  lg:w-[43%] sm:w-[50%]">
                            <div class="lg:flex-1 sm:flex-1">
                                <div class="lg:flex sm:flex ">
                                    <div class="px-6 py-4 lg:flex-1 sm:flex-1">Z Score </div>
                                    <div class="px-6 py-4 lg:flex-1 sm:flex-1">
                                        <h1> : {{ exam.z_score }} </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:flex sm:flex ">
                    <div class="lg:flex-1 sm:flex-1">
                        <div class="lg:flex sm:flex ">
                            <div class=" px-6 py-4 lg:flex-1 sm:flex-1">Cut Off Marks</div>
                            <div class="px-6 py-4 lg:flex-1 sm:flex-1">
                                <h1>: {{ exam.cut_of_marks }} </h1>
                            </div>
                        </div>
                    </div>
                    <div class="lg:flex-1  sm:flex-1 ">
                        <div
                            class="sm:col-span-3 invisible sm:visible lg:visible z-0 sm:z-0 sm:absolute  lg:w-[43%] sm:w-[50%]">
                            <div class="lg:flex-1 sm:flex-1">
                                <div class="lg:flex sm:flex ">
                                    <div class="px-6 py-4 lg:flex-1 sm:flex-1">Subject Stream </div>
                                    <div class="px-6 py-4 lg:flex-1 sm:flex-1">
                                        <h1>: {{ exam.subject_stream }} </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div>{{ exam.results }}</div>
    <div>{{ subjects }}</div> -->

        <div class="flex justify-center items-center px-20 overflow-x-auto shadow-md sm:rounded-lg">
            <!-- {{ subject }} -->
            <table class="w-1/2  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Subject</th>
                        <th scope="col" class="px-6 py-3">Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="subject in subjects"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ subject.name }}</td>
                        <td class="px-6 py-4">
                            <template v-for="result in exam.results">
                                <template v-if="subject.id == result.subject_id">
                                    {{ result.grade }}
                                </template>

                            </template>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Subject :
            {{ subject.name }}

            <template v-for="result in exam.results">
                <template v-if="subject.id == result.subject_id">
                    {{ result.grade }}
                </template>

            </template> -->



        </div>
    </AuthenticatedLayout>
</template>