<script setup>
import { Link } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavForPages from '@/Layouts/NavForPages.vue';
const props = defineProps({
    union: {
        type: Object
    },
    projects: {
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
        <!-- <NavForPages :student="student"></NavForPages> -->
        <div>Union Project Details</div>
        <div>

            <Link :href="route('union.create', { unionId: union.id, studentId: student.id })" method="get" as="button">Add
            UnionProject
            </Link>
            <!-- <div>Add UnionProject</div> -->

        </div>

        <!-- <div>{{ union }}</div>
        <div>{{ projects }}</div> -->
        <div>{{ union.name }}</div>
        <div v-for="project in projects">
            <div>prject name:{{ project.name }}</div>
            <div>Duration:{{ project.duration }}</div>
            <div>Start date:{{ project.start_date }}</div>
            <div>End Date:{{ project.end_date }}</div>
            <div>Description:{{ project.description }}</div>
            <!-- No need of Edit project from here becase it is attach -->
            <div>Edit</div>
            <!-- Delete value from student_union_project->UnionProjectController -->
            <Link :href="route('unionProject.destroy', { studentId: student.id, unionId: union.id, projectId: project.id })"
                method="delete" as="button">
            Delete</Link>
        </div>


    </AuthenticatedLayout>
</template>