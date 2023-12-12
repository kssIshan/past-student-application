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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div>
                            <Link :href="route('student.index')" method="get" as="button">Search Student
                            </Link>
                        </div>
                        <!-- <div>
                            <Link :href="route('student.create')" method="get" as="button">Add New Student
                            </Link>
                        </div> -->

                        <div>Add new Student</div>
                        <div>Basic Information</div>
                        <div>Students Unions</div>
                        <div>Activities</div>
                        <div>Education</div>
                        <div>Sports and Achievements</div>
                        <div>Setting</div>

                        <!-- <div>
                            <Link :href="route('dashboard')" method="get" as="button">Student Union</Link>
                        </div>
                        <div>
                            <Link :href="route('dashboard')" method="get" as="button">Sport & Achievements</Link>
                        </div>
                        <div>
                            <Link :href="route('dashboard')" method="get" as="button">Education</Link>
                        </div>
                        <div>
                            <Link :href="route('dashboard')" method="get" as="button">Activity</Link>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
