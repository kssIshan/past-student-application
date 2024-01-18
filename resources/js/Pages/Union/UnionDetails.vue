<script setup>
import { Link } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavForPages from '@/Layouts/NavForPages.vue';

const props = defineProps({
    unions: {
        type: Array
    },
    student: {
        type: Object
    }
})
</script>


<template>
    <Head title="Add Union" />
    <AuthenticatedLayout>
        <NavForPages :student="student"></NavForPages>
        <div>Union View</div>
        <div>

            <Link :href="route('unionProject.create', { studentId: student.id })" method="get" as="button">Add New Union
            </Link>

        </div>
        <div v-for="union in unions" :key="union.id">
            <div>{{ union.name }}</div>
            <div>{{ union.pivot.join_date }}</div>
            <div>{{ union.pivot.leave_date }}</div>
            <div>{{ union.pivot.position }}</div>

            <!-- <Link :href="route('exam.destroy', { examId: exam.id, studentId: student.id })" method="delete" as="button">
            Delete</Link> -->
            <div>
                <Link :href="route('unionProject.index', { studentId: student.id, unionId: union.id })" method="get"
                    as="button">
                Project</Link>
            </div>
            <!-- Edit of the union and its all project->UnionProjectController -->
            <!-- <div>Edit</div> -->
            <div>
                <Link :href="route('unionProject.edit', { studentId: student.id, unionId: union.id })" method="get"
                    as="button">
                Edit</Link>
            </div>
            <!-- Delete value from student_union->UnionController -->
            <div>
                <Link :href="route('union.destroy', { studentId: student.id, unionId: union.id })" method="delete"
                as="button">
            Delete</Link>
        </div>
    </div>

</AuthenticatedLayout></template>