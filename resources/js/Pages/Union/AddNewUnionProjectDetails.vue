<script setup>
import { ref } from 'vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { reactive } from 'vue';

let selectedProject = reactive({});
let index = ref("");
const props = defineProps({
    union: {
        type: Object
    },
    studentId: {
        type: Number
    }

})

const form = useForm({
    union_id: props.union.id,
    project_id: '',


})
async function onUnionChange(projectId) {
    //alert(projectId);
    if (projectId !== null) {
        console.log(projectId, 'by onUnionChange');
        getProject(projectId);


    }
    else {
        console.log("error");
    }
}
async function getProject(projectId) {
    console.log(projectId, 'by getProject');
    //selectedProject = {}
    selectedProject = props.union.projects.find(({ id }) => id == projectId);
    console.log(result);
    //alert(result);
    //return ProjectId.value;
}
</script>

<template>
    <Head title="Add Union" />
    <AuthenticatedLayout>
        <div>Add New Union Project Details</div>
        <div>Union Name:{{ union.name }}</div>
        <div>{{ studentId }}</div>

        <form @submit.prevent="form.post(route('unionProject.attachProject', { studentId: studentId, unionId: union.id }))">
            <!-- <form action="#"> -->
            <select v-model="form.project_id" @change="onUnionChange(form.project_id)">
                <option v-for=" project in union.projects" :value="project.id">
                    {{ project.name }}
                    {{ project.id }}
                </option>
            </select>
            <button type="submit">save</button>
        </form>

        <!-- <button type="button" @click="ProjectId = getProject()">click</button> -->
        <!-- <div>{{ union.projects[ProjectId] }}</div> -->
        <div>{{ selectedProject }}</div>
        <!-- <div>{{ union.projects[index] }}</div> -->
        <!-- <div>{{ union.projects[0].pivot }}</div> -->
        <!-- <div>Selected Project ID: {{ form.project_id }}</div>
        <div>{{ ProjectId }}</div> -->
        <!-- <div>{{ union }}</div> -->
    </AuthenticatedLayout>
</template>