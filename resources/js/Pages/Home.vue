<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Home</h2>
        </template>

        <div>Home</div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


                <div class="flex items-center justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-4">
                    <div class="bg-blue-200 p-4  mr-4 w-64 h-24">
                        <Link :href="route('student.searchStudent')" method="get" as="button">
                        Search Student
                        </Link>
                    </div>
                    <div class="bg-green-200 p-4  mr-4 w-60 h-24">
                        <Link :href="route('student.viewAddStudentForm')" method="get" as="button">
                        Add New Student
                        </Link>
                    </div>
                    <div class="bg-yellow-200 p-4  mr-4 w-64 h-24">
                        Basic Information
                    </div>
                </div>


                <div class="flex flex-wrap bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">

                    <!-- Column 1 -->

                    <div class="flex flex-wrap bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">

                        <!-- Cell 1 -->
                        <div class="w-full sm:w-1/2 lg:w-1/2 p-6">
                            <div>
                                Students Unions
                            </div>
                        </div>

                        <!-- Cell 2 -->
                        <div class="w-full sm:w-1/2 lg:w-1/2 p-6">
                            <div>
                                Activities
                            </div>
                        </div>

                        <!-- Cell 3 -->
                        <div class="w-full sm:w-1/2 lg:w-1/2 p-6">
                            <div>
                                Education
                            </div>
                        </div>

                        <!-- Cell 4 -->
                        <div class="w-full sm:w-1/2 lg:w-1/2 p-6">
                            <div>
                                Setting
                            </div>
                        </div>

                    </div>


                    <!-- Column 2 -->
                    <div class="w-full sm:w-1/2 lg:w-1/3 p-6">
                        <div>
                            Sports and Achievements
                        </div>
                    </div>

                </div>

            </div>
        </div>


    </AuthenticatedLayout>
</template>
