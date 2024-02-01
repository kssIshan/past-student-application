<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
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
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Basic Information</h2>
        </template>
        <div>

            <div class="grid grid-cols-2 gap-5 sm:mb-10 py-10">

                <div class=" grid justify-center mt-10">
                    <div class="invisible  absolute sm:flex sm:visible sm:pt-0 sm:ml-6">
                        <p class=" text-left right-0 text-gray-500 text-md font-medium">{{ student.first_name }} {{
                            student.last_name }} <br>
                            {{ student.reg_no }}
                        </p>
                    </div>

                </div>

                <div class="grid justify-end sm:ml-0  sm:mr-3  mt-10">
                    <button type="button"
                        class="text-white bg-rc-java hover:bg-rc-java-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-lg rounded-lg text-sm px-6 py-2 text-center inline-flex items-center dark:bg-rc-java dark:hover:bg-rc-java dark:focus:ring-rc-java">
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
                </div>

            </div>
            <div>
                <div class="ml-2 my-2 pl-3 shadow-lg pb-3">
                    <div class="pl-3 sm:px-3">
                        <h3 class="text-base font-semibold leading-7 text-gray-900 lg:text-3xl">Basic Details</h3>

                    </div>
                    <div class="mt-3 ml-4">

                        <div class="flex pl-4 py-2 sm:grid sm:grid-cols-3 lg:grid lg:grid-cols-6  grid grid-cols-2 lg:py-3">
                            <dt class="sm:text-sm text-xs font-medium leading-6 lg:text-md text-gray-900">Full Name</dt>
                            <dd
                                class="mt-1 sm:text-sm text-xs lg:text-md leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0">
                                : {{ student.first_name }} {{ student.last_name }}</dd>
                            <dt
                                class=" font-medium leading-6 lg:text-md text-gray-900 lg:px-3 invisible sm:invisible lg:visible lg:relative absolute">
                                Date of birth</dt>
                            <dd
                                class="mt-1 sm:text-sm lg:text-md text-xs leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0 lg:relative absolute invisible sm:invisible lg:visible">
                                :{{ student.dob }}</dd>
                        </div>
                        <div
                            class="flex pl-4 py-2 sm:grid sm:grid-cols-3 lg:grid lg:grid-cols-6  grid grid-cols-2 lg:py-5 ">
                            <dt class="sm:text-sm text-xs font-medium lg:text-md leading-6 text-gray-900">Registration
                                Number</dt>
                            <dd
                                class="mt-1 sm:text-sm text-xs lg:text-md leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0">
                                :{{ student.reg_no }}</dd>
                            <dt
                                class=" font-medium leading-6 text-gray-900 lg:text-md lg:px-3 invisible sm:invisible lg:visible lg:relative absolute  ">
                                Enrollment Date </dt>
                            <dd
                                class="mt-1 sm:text-sm text-xs leading-6 lg:text-md text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0 invisible sm:invisible lg:visible lg:relative absolute">
                                :{{ student.date_of_admission }}</dd>
                        </div>


                        <div class="flex pl-4 py-2 sm:grid sm:grid-cols-3 lg:grid lg:grid-cols-6  grid grid-cols-2 lg:py-5">
                            <dt class="sm:text-sm text-xs font-medium leading-6 lg:text-lg text-gray-900">NIC Number</dt>
                            <dd
                                class="mt-1 sm:text-sm text-xs leading-6 lg:text-md text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0">
                                :{{ student.nic }}</dd>
                            <dt
                                class="lg:text-lg font-medium leading-6 text-gray-900 lg:px-3 invisible sm:invisible lg:visible lg:relative absolute ">
                                Passout Date</dt>
                            <dd
                                class="mt-1 sm:text-sm text-xs leading-6 lg:text-md text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0 lg:relative absolute invisible sm:invisible lg:visible">
                                :{{ student.date_of_leave }}</dd>
                        </div>




                    </div>
                </div>
            </div>
            <div class="mt-10">
                <div class="ml-2 my-2 pl-3 shadow-lg pb-3 mt-3">
                    <div class="pl-3 sm:px-3 lg:py-5">
                        <h3 class="text-base font-semibold leading-7 text-gray-900 lg:text-3xl ">Contact Details</h3>

                    </div>
                    <div class="mt-3 ml-4">

                        <div
                            class="flex pl-4 py-2 sm:grid sm:grid-cols-3 lg:grid lg:grid-cols-6  grid grid-cols-2 lg:py-5 ">
                            <dt class="sm:text-sm text-xs font-medium leading-6 text-gray-900 lg:text-lg">Address</dt>
                            <dd
                                class="mt-1 sm:text-sm text-xs leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0 lg:text-md">
                                : {{ student.address }}</dd>
                            <dt
                                class=" font-medium lg:text-lg leading-6 text-gray-900 lg:px-3 invisible sm:invisible lg:visible lg:relative absolute">
                                Email Address</dt>
                            <dd
                                class="mt-1 sm:text-sm text-xs leading-6 text-gray-700 lg:text-md sm:col-span-2 lg:col-span-2 sm:mt-0 lg:relative absolute invisible sm:invisible lg:visible">
                                :{{ student.email }}</dd>
                        </div>
                        <div class="flex pl-4 py-2 sm:grid sm:grid-cols-3 lg:grid lg:grid-cols-6  grid grid-cols-2 lg:py-5">
                            <dt class="sm:text-sm text-xs font-medium lg:text-lg leading-6 text-gray-900">Mobile Numbe 01
                            </dt>
                            <dd
                                class="mt-1 sm:text-sm text-xs leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0 lg:text-md">
                                :{{ student.mobile_no }}</dd>
                            <dt
                                class=" font-medium lg:text-lg leading-6 text-gray-900 lg:px-3 invisible sm:invisible lg:visible lg:relative absolute  ">
                                Land No</dt>
                            <dd
                                class="mt-1 sm:text-sm text-xs lg:text-md leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0 invisible sm:invisible lg:visible lg:relative absolute">
                                :{{ student.land_no }}</dd>
                        </div>


                        <div
                            class="flex pl-4 py-2 sm:grid sm:grid-cols-3 lg:grid lg:grid-cols-6  grid grid-cols-2 lg:py-5 ">
                            <dt class="sm:text-sm text-xs font-medium lg:text-lg leading-6 text-gray-900">Mobile Number 02
                            </dt>
                            <dd
                                class="mt-1 sm:text-sm lg:text-md text-xs leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0">
                                :{{ student.mobile_no2 }}</dd>

                        </div>


                    </div>
                </div>
                <div>
                    <Link :href="route('student.destroy', { studentId: student.id })" method="delete" as="button">Delete
                    </Link>

                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
