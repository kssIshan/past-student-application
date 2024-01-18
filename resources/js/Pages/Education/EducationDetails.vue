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
        <div>
            <!-- {{ student }} -->
            <Link :href="route('exam.create', { student: student.id })" method="get" as="button">Add Exam</Link>
            <!-- <Link>Add Exam</Link> -->
            <div v-for="exam in exams" :key="exam.id">
                <!-- <div>{{ exam.id }}</div> -->
                <!-- <div>{{ exam.student_id }}</div> -->
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
            <!-- {{ exams }} -->
        </div>
    </AuthenticatedLayout>

    <Head title="Basic Information" />
</template>