<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavForPages from '@/Layouts/NavForPages.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    student: {
        type: Object
    },

});
</script>

<template>

    <div class="sm:mt-4 sm:p-10 ">

        <div class="grid grid-cols-2 gap-5 px-8 sm:mb-10">
            <div class=" grid justify-center m-4">
                <div
                    class="p-4 rounded-lg shadow-sm hover:shadow-lg invisible  absolute sm:flex sm:visible sm:pt-0 sm:ml-6">
                    <p class=" text-left right-0 text-gray-500 text-md font-medium">{{ student.first_name }} {{
                        student.last_name }} <br>
                        {{ student.reg_no }}
                    </p>
                </div>

            </div>
            <div class="grid justify-end sm:ml-0    mt-10">
                <slot />
            </div>
        </div>
        <div class="px-8">
            <div class="border-2 border-gray-900/10 rounded-lg ml-2 my-2 pl-3  shadow-inner hover:shadow-lg  pb-3">
                <div class="p-4 sm:px-2 lg:py-5">
                    <h3 class="text-base font-semibold leading-7 text-gray-900 lg:text-3xl">Basic Details</h3>

                </div>
                <div class="mt-3 ml-4">

                    <div class=" pl-4 py-2 sm:grid sm:grid-cols-3 lg:grid lg:grid-cols-8  grid grid-cols-2 lg:py-3">
                        <dt class="sm:text-sm text-xs font-semibold leading-6 lg:text-md text-gray-900">Full Name</dt>
                        <dt>:</dt>
                        <dd
                            class="mt-1 sm:text-sm text-xs lg:text-md leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0">
                            {{ student.first_name }} {{ student.last_name }}</dd>

                        <dt
                            class="sm:text-sm text-xs font-semibold leading-6 lg:text-md text-gray-900 lg:px-3 invisible sm:invisible lg:visible lg:relative absolute">
                            Date of birth</dt>
                        <dt>:</dt>
                        <dd
                            class="mt-1 sm:text-sm lg:text-md text-xs leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0 lg:relative absolute invisible sm:invisible lg:visible">
                            {{ student.dob }}</dd>
                    </div>
                    <div class=" pl-4 py-2 sm:grid sm:grid-cols-3 lg:grid lg:grid-cols-8  grid grid-cols-2 lg:py-5 ">
                        <dt class="sm:text-sm text-xs font-semibold lg:text-md leading-6 text-gray-900">Registration
                            Number</dt>
                        <dt>:</dt>
                        <dd
                            class="mt-1 sm:text-sm text-xs lg:text-md leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0">
                            {{ student.reg_no }}</dd>
                        <dt
                            class=" sm:text-sm text-xs font-semibold leading-6 lg:text-md text-gray-900 lg:px-3 invisible sm:invisible lg:visible lg:relative absolute  ">
                            Enrollment Date </dt>
                        <dt>:</dt>
                        <dd
                            class="mt-1 sm:text-sm text-xs leading-6 lg:text-md text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0 invisible sm:invisible lg:visible lg:relative absolute">
                            {{ student.date_of_admission }}</dd>
                    </div>


                    <div class=" pl-4 py-2 sm:grid sm:grid-cols-3 lg:grid lg:grid-cols-8  grid grid-cols-2 lg:py-5">
                        <dt class="sm:text-sm text-xs font-semibold leading-6 lg:text-md text-gray-900">NIC Number</dt>
                        <dt>:</dt>
                        <dd
                            class="mt-1 sm:text-sm text-xs leading-6 lg:text-md text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0">
                            {{ student.nic }}</dd>
                        <dt
                            class="sm:text-sm text-xs font-semibold leading-6 lg:text-md text-gray-900 lg:px-3 invisible sm:invisible lg:visible lg:relative absolute ">
                            Passout Date</dt>
                        <dt>:</dt>
                        <dd
                            class="mt-1 sm:text-sm text-xs leading-6 lg:text-md text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0 lg:relative absolute invisible sm:invisible lg:visible">
                            {{ student.date_of_leave }}</dd>
                    </div>




                </div>
            </div>
        </div>
        <div class="px-8 mt-10">
            <div class="border-2 border-gray-900/10 rounded-lg ml-2 my-2 pl-3 shadow-inner hover:shadow-lg pb-3 mt-3">
                <div class="p-4 sm:px-2 lg:py-5">
                    <h3 class="text-base font-semibold leading-7 text-gray-900 lg:text-3xl ">Contact Details</h3>

                </div>
                <div class="mt-3 ml-4">

                    <div class=" pl-4 py-2 sm:grid sm:grid-cols-3 lg:grid lg:grid-cols-8  grid grid-cols-2 lg:py-5 ">
                        <dt class="sm:text-sm text-xs font-semibold leading-6 lg:text-md text-gray-900 ">
                            Address</dt>
                        <dt>:</dt>
                        <dd
                            class="mt-1 sm:text-sm text-xs leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0 lg:text-md">
                            {{ student.address }}</dd>
                        <dt
                            class=" sm:text-sm text-xs font-semibold leading-6 lg:text-md text-gray-900 lg:px-3 invisible sm:invisible lg:visible lg:relative absolute">
                            Email Address</dt>
                        <dt>:</dt>
                        <dd
                            class="mt-1 sm:text-sm text-xs leading-6 text-gray-700 lg:text-md sm:col-span-2 lg:col-span-2 sm:mt-0 lg:relative absolute invisible sm:invisible lg:visible">
                            {{ student.email }}</dd>
                    </div>
                    <div class=" pl-4 py-2 sm:grid sm:grid-cols-3 lg:grid lg:grid-cols-8  grid grid-cols-2 lg:py-5">
                        <dt class="sm:text-sm text-xs font-semibold leading-6 lg:text-md text-gray-900">Mobile Numbe 01
                        </dt>
                        <dt>:</dt>
                        <dd
                            class="mt-1 sm:text-sm text-xs leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0 lg:text-md">
                            {{ student.mobile_no }}</dd>
                        <dt
                            class=" sm:text-sm text-xs font-semibold leading-6 lg:text-md text-gray-900 lg:px-3 invisible sm:invisible lg:visible lg:relative absolute  ">
                            Land No</dt>
                        <dt>:</dt>
                        <dd
                            class="mt-1 sm:text-sm text-xs lg:text-md leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0 invisible sm:invisible lg:visible lg:relative absolute">
                            {{ student.land_no }}</dd>
                    </div>


                    <div class=" pl-4 py-2 sm:grid sm:grid-cols-3 lg:grid lg:grid-cols-8  grid grid-cols-2 lg:py-5 ">
                        <dt class="sm:text-sm text-xs font-semibold leading-6 lg:text-md text-gray-900">Mobile Number 02
                        </dt>
                        <dt>:</dt>
                        <dd
                            class="mt-1 sm:text-sm lg:text-md text-xs leading-6 text-gray-700 sm:col-span-2 lg:col-span-2 sm:mt-0">
                            {{ student.mobile_no2 }}</dd>

                    </div>


                </div>
            </div>
            <!-- <div>
        <Link :href="route('student.destroy', { studentId: student.id })" method="delete" as="button">Delete
        </Link>

    </div> -->
        </div>
    </div>

</template>