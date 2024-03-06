<script setup>
//import { Head, Link } from '@inertiajs/vue3';
import { Head, Link } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavForPages from '@/Layouts/NavForPages.vue';
import { ref } from 'vue';
import { TailwindPagination } from 'laravel-vue-pagination';
import RenderlessPagination from 'laravel-vue-pagination/src/RenderlessPagination.vue';


const props = defineProps({
    student: {
        type: Object
    }

});
const searchShowResultId = ref("searchStudent")
// const { data, $inertia } = usePage();
// const fetchExams = (url) => {
//     const data = $inertia.visit(url);
//     console.log(data, "data");
// };
// async function getexams(studentId) {
//     try {
//         unionsLoading.value = true;

//         const response = await axios.get(route('exam.index', { student: studentId }));
//         //console.log(response);
//         exams = response.data.exams;  // Use .value to update the ref
//         console.log(exams, '->exams');
//         unionsLoading.value = false;
//     } catch (e) {
//         console.log(e, "project error");
//     }
// }

const laravelExam = ref({});

//let laravelStudent = ref("");
const laravelStudent = ref({});

const getResults = async (page = 1) => {

    // const response = await fetch(`https:example.com/results?page=${page}`);
    // laravelExam.value = await response.json();
    // const response = await axios.get(route('exam.index2', { student: props.student.id }));
    // laravelExam.value = response;
    //exams = response.data.exams;

    try {

        const studentId = props.student.id; // Assuming props is accessible in this scope
        const response = await axios.get(
            // Use the route helper function to generate the URL
            route('exam.index2', { student: studentId }),
            {
                params: { page: page }
            }
        );
        console.log(response, "response");
        laravelExam.value = response.data.exams;
        console.log(laravelExam, "laravelExam");
        laravelStudent.value = response.data.student;
        console.log(laravelExam, "laravelStudent");
        // console.log(laravelExam.value, "laravelExam.value");
    } catch (error) {
        console.error('Error fetching results:', error);
    }

}

getResults();

</script>

<template>
    <AuthenticatedLayout>
        <NavForPages :student="student"></NavForPages>
        <div class="p-10">

            <!-- {{ student }}
        <div>{{ laravelStudent.id }}</div>
        <div>{{ laravelExam.data }}</div> -->

            <!-- <p class=" font-medium pl-14 text-md text-gray-500 text-xs font-large">
                {{ student.first_name }} {{ student.last_name }} <br> {{
                    student.reg_no }}
            </p> -->
            <div class="grid grid-cols-2 gap-5 sm:mb-10 px-8">
                <div class=" grid justify-center m-4">
                    <div
                        class="p-4 rounded-lg shadow-sm hover:shadow-lg invisible  absolute sm:flex sm:visible sm:pt-0 sm:ml-6">
                        <p class="  pl-4 font-medium text-md text-gray-500  font-large">{{ laravelStudent.first_name }}
                            {{
            laravelStudent.last_name
        }}
                            <br> {{
                laravelStudent.reg_no }}
                        </p>
                    </div>
                </div>
                <div>
                    <div class="grid justify-end sm:ml-0    mt-10">

                        <button type="button"
                            class="text-white mr-16 bg-rc-bondi-blue hover:bg-rc-bondi-blue2  font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 focus:outline-non">

                            <Link :href="route('exam.create', { studentId: student.id })" method="get" as="button">Add
                            New
                            Exam Result</Link>

                        </button>
                    </div>
                </div>
            </div>



            <div class="px-8">
                <div class="border-2 border-gray-900/10 rounded-lg ml-2 my-2 p-4 shadow-inner hover:shadow-lg  pb-3">

                    <div class="relative  overflow-x-auto shadow-md sm:rounded-lg">
                        <table
                            class="w-full  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                <tr v-for="exam in laravelExam.data" :key="exam.id"
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

                                        <Link
                                            :href="route('exam.showresult', { studentId: laravelStudent.id, examId: exam.id, searchShowResultId: searchShowResultId })"
                                            method="get" as="button">
                                        <p class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            Result </p>
                                        </Link>

                                        <Link
                                            :href="route('exam.edit', { studentId: laravelStudent.id, examId: exam.id })"
                                            method="get" as="button">
                                        <a href="#"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><svg
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
                                        <Link
                                            :href="route('exam.destroy', { studentId: laravelStudent.id, examId: exam.id })"
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
                    <div class="flex justify-center items-center h-full">
                        <div class="relative   p-10 overflow-x-auto shadow-md sm:rounded-lg">
                            <TailwindPagination :data="laravelExam" @pagination-change-page="getResults" />
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>

    <Head title="Basic Information" />
</template>