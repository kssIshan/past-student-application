<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavForPages from '@/Layouts/NavForPages.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    student: {
        type: Object
    },
    // students: {
    //     type: Array
    // },

});
</script>

<template>
    <Head title="Basic Information" />

    <AuthenticatedLayout>
        <NavForPages :student-id="student.id"></NavForPages>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Basic Information</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Basic information</div>
                    <!-- {{ student }} -->
                    <div>{{ student.id }}</div>
                    <div>{{ student.first_name }}</div>
                    <div>{{ student.last_name }}</div>
                    <div>{{ student.dob }}</div>
                    <div>{{ student.date_of_admission }}</div>
                    <div>{{ student.date_of_leave }}</div>
                    <div>{{ student.address }}</div>
                    <div>{{ student.email }}</div>
                    <div>{{ student.mobile_no }}</div>
                    <div>{{ student.land_no }}</div>

                    <div>
                        <Link :href="route('student.edit', { studentId: student.id })" method="get" as="button">Edit</Link>

                    </div>
                    <div>
                        <Link :href="route('student.destroy', { studentId: student.id })" method="delete" as="button">Delete
                        </Link>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
