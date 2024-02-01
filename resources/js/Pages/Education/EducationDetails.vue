<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavForPages from '@/Layouts/NavForPages.vue';

const props = defineProps({
    student: {
        type: Object
    },
    exams: {
        type: Array
    },

});
</script>
<template>
    <AuthenticatedLayout>
        <NavForPages :student="student"></NavForPages>

        <div class="p-4">
            <!-- <p class=" font-medium pl-14 text-md text-gray-500 text-xs font-large">
                {{ student.first_name }} {{ student.last_name }} <br> {{
                    student.reg_no }}
            </p> -->
            <div class="grid grid-cols-2 gap-5 sm:mb-10 py-10">
                <p class="  pl-14 font-medium text-md text-gray-500  font-large">{{ student.first_name }} {{
                    student.last_name
                }}
                    <br> {{
                        student.reg_no }}
                </p>
            </div>
        </div>
        <div>
            <div class=" grid  justify-end sm:ml-0  sm:mr-3  mt-10 mr-2 ">

                <button type="button"
                    class="text-white mr-16 bg-rc-bondi-blue hover:bg-rc-bondi-blue2  font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 focus:outline-non">

                    <Link :href="route('exam.create', { student: student.id })" method="get" as="button">Add New
                    Exam Result</Link>

                </button>
            </div>
        </div>

        <div class="relative px-20 overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="px-6 py-3">
                            Exam Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Exam Year
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Attempt
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Island Rank
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stream
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pass Or Fail
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="exam in exams" :key="exam.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">


                        <td class="px-6 py-4">
                            {{ exam.type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ exam.exam_year }}
                        </td>
                        <td class="px-6 py-4">
                            {{ exam.attempt }}
                        </td>
                        <td class="px-6 py-4">
                            {{ exam.island_rank }}
                        </td>
                        <td class="px-6 py-4">
                            {{ exam.subject_stream }}
                        </td>
                        <td class="px-6 py-4">
                            <!-- {{ exam.is_pass }} -->
                            <template v-if="exam.is_pass === 1">Pass</template>
                            <template v-else>Fail</template>
                        </td>

                        <td class="flex items-center px-6 py-4">

                            <Link :href="route('exam.showresult', { studentId: student.id, examId: exam.id })" method="get"
                                as="button">
                            <p class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                Result </p>
                            </Link>

                            <Link :href="route('exam.edit', { studentId: student.id, examId: exam.id })" method="get"
                                as="button">
                            <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><svg
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_626_412)">
                                        <path
                                            d="M20.71 7.04006C21.1 6.65006 21.1 6.00006 20.71 5.63006L18.37 3.29006C18 2.90006 17.35 2.90006 16.96 3.29006L15.12 5.12006L18.87 8.87006M3 17.2501V21.0001H6.75L17.81 9.93006L14.06 6.18006L3 17.2501Z"
                                            fill="#92DD32" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_626_412">
                                            <rect width="24" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a></Link>
                            <Link :href="route('exam.destroy', { studentId: student.id, examId: exam.id })" method="delete"
                                as="button">
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
        <!-- <div>
           
            <Link :href="route('exam.create', { student: student.id })" method="get" as="button">Add Exam</Link>
           
            <div v-for="exam in exams" :key="exam.id">
            
                <div>Index No:{{ exam.index_no }}</div>
                <div>Exam Type:{{ exam.type }}</div>
                <div>Exam Year:{{ exam.exam_year }}</div>
                <div>Attempt:{{ exam.attempt }}</div>
                <div>Island rank:{{ exam.island_rank }}</div>
                <div>District Rank:{{ exam.district_rank }}</div>
                <div>Cut Off Marks:{{ exam.cut_of_marks }}</div>
                <div>Z Score:{{ exam.z_score }}</div>
                <div>Suject Stream:{{ exam.subject_stream }}</div>
                <div>Pass Or Fail:{{ exam.is_pass }}</div>
                <div>
                    <Link :href="route('exam.edit', { studentId: student.id, examId: exam.id })" method="get" as="button">
                    Edit
                    </Link>
                </div>
                <div>
                    <Link :href="route('exam.destroy', { studentId: student.id, examId: exam.id })" method="delete"
                        as="button">Delete</Link>
                </div>
                <div>
                    <Link :href="route('exam.showresult', { studentId: student.id, examId: exam.id })" method="get"
                        as="button">Result</Link>
                </div>
            </div>
          
        </div> -->
    </AuthenticatedLayout>

    <Head title="Basic Information" />
</template>