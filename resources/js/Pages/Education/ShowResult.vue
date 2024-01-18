<script setup>
const props = defineProps({
    exam: {
        type: Object
    },
    student: {
        type: Object
    },
    subjects: {
        type: Array
    }


});
</script>

<template>
    <div>{{ student.first_name }} </div>
    <div>Index No:{{ exam.index_no }}</div>
    <div>Type:{{ exam.type }}</div>
    <div>Exam Year:{{ exam.exam_year }}</div>
    <div>Attempt:{{ exam.attempt }}</div>
    <div>Island Rank:{{ exam.island_rank }}</div>
    <div>District Rank:{{ exam.district_rank }}</div>
    <div>Z Score:{{ exam.z_score }}</div>
    <div>Cut Off Marks:{{ exam.cut_of_marks }}</div>
    <div>Subject Stream:{{ exam.subject_stream }}</div>
    <!-- <div>{{ exam.results }}</div>
    <div>{{ subjects }}</div> -->

    <div v-for="subject in subjects">
        <!-- {{ subject }} -->
        Subject Name:
        {{ subject.name }}

        <template v-for="result in exam.results">
            <template v-if="subject.id == result.subject_id">
                {{ result.grade }}
            </template>

        </template>



    </div>
</template>