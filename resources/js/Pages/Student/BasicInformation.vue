<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import StudentViewComponent from '@/Pages/Student/StudentViewComponent.vue'
import NavForPages from '@/Layouts/NavForPages.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    student: {
        type: Object
    },

});
</script>

<template class=" w-screen">

    <Head title="Basic Information" />

    <AuthenticatedLayout>
        <NavForPages :student="student"></NavForPages>

        <StudentViewComponent :student="student">
            <button type="button"
                class="text-white bg-rc-java hover:bg-rc-bondi-blue2 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm  rounded-lg  px-6 py-2 text-center inline-flex items-center  dark:focus:ring-rc-java">
                <Link :href="route('student.edit', { studentId: student.id })" method="get" as="button">Edit Student
                </Link>
                <div class="pl-4">
                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_627_288)">
                            <path
                                d="M1.87534 10.8113L1.0309 14.4557C1.00177 14.589 1.00277 14.727 1.03382 14.8598C1.06488 14.9926 1.1252 15.1168 1.21039 15.2232C1.29558 15.3297 1.40349 15.4158 1.52622 15.4753C1.64895 15.5347 1.78342 15.566 1.91979 15.5668C1.98333 15.5733 2.04736 15.5733 2.1109 15.5668L5.77756 14.7224L12.8176 7.70906L8.88867 3.78906L1.87534 10.8113Z"
                                fill="white" />
                            <path
                                d="M15.0321 4.19766L12.4099 1.57543C12.2375 1.40391 12.0042 1.30762 11.761 1.30762C11.5178 1.30762 11.2845 1.40391 11.1121 1.57543L9.6543 3.03321L13.5787 6.95766L15.0365 5.49988C15.1218 5.41413 15.1894 5.31241 15.2354 5.20053C15.2813 5.08864 15.3047 4.9688 15.3043 4.84785C15.3039 4.72689 15.2797 4.60721 15.2329 4.49564C15.1862 4.38407 15.118 4.28281 15.0321 4.19766Z"
                                fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_627_288">
                                <rect width="16" height="16" fill="white" transform="translate(0 0.5)" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>

            </button>
        </StudentViewComponent>

    </AuthenticatedLayout>
</template>
