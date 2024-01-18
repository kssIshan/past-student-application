<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';
import { reactive } from 'vue';

let unionsLoading = ref(false);
let projectLoading = ref(false);
const showUnion = ref(false);
const showProject = ref(false);
//let unionId = ref("");
//let error = reactive([]);
let projects = reactive([]);

const props = defineProps({
    studentUnion: {
        type: Object
    },
    student: {
        type: Object
    },
    unions: {
        type: Array
    },
    union: {
        type: Object
    },
    projectsArray: {
        type: Array
    }
})

const form = useForm({

    union_id: props.studentUnion.union_id,
    position: props.studentUnion.position,
    duration: props.studentUnion.duration,
    join_date: props.studentUnion.join_date,
    leave_date: props.studentUnion.leave_date,
    unionProjects: [{ project_id: null }],

})




async function getProject(unionId) {
    try {
        unionsLoading.value = true;

        const response = await axios.get(route('project.index', { unionId: unionId }));
        //console.log(response);
        projects = response.data.projects;  // Use .value to update the ref
        console.log(projects, '->projects');
        unionsLoading.value = false;
    } catch (e) {
        console.log(e, "project error");
    }


}
async function removeProject(projectId) {
    try {
        const response = await axios.delete(route('unionProject.destroy', { studentId: props.student.id, unionId: props.union.id, projectId: projectId }));

    } catch (e) {
        console.log(e, "remove project error");
    }
    console.log(projectId);
}
async function onUnionChange(unionId) {
    if (unionId) {
        getProject(unionId);
        console.log(unionId, 'by onUnionChange');
    }
    // if (showProject === true) {
    //     postProject(unionId);
    // }

    else {
        // Handle the case when no union is selected (if needed)
        projects = [];
    }
}


const removeResult = (index) => {
    form.unionProjects.splice(index, 1);
}

const addResult = () => {
    form.unionProjects.push({ project_id: "" });
}
</script>

<template>
    <Head title="Add Union" />
    <AuthenticatedLayout>

        <!-- <form action="#"> -->
        <!-- <div>{{ unions }}</div>
        <div>{{ projects }}</div> -->
        <form @submit.prevent="form.put(route('unionProject.update', { studentId: student.id, unionId: union.id }))">
            <!-- <form action="#"> -->
            <div>
                <h1>Student Union Details</h1>
                <div>
                    <InputLabel for="unionName" value="Union Name" />

                    <!-- <input type="text" id="unionName" v-model="form.name" /> -->
                    <!-- <select v-model="form.union_id">
                        <option :value="1">Sport Club</option>
                        <option :value="2">Dance Club</option>
                    </select> -->
                    <select value="" v-model="form.union_id" @change="onUnionChange(form.union_id)">
                        <!-- <div>{{ form.union_id }}</div> -->
                        <!-- <option disabled value="" selected>{{ props.union.name }}</option> -->
                        <!-- <option value="" selected>{{ props.union.name }}</option> -->
                        <option v-for=" union in unions" :value="union.id">
                            {{ union.name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.union_id" />
                </div>
                <div>
                    <InputLabel for="position" value="Position" />
                    <input type="text" id="position" v-model="form.position" />
                    <InputError class="mt-2" :message="form.errors.position" />
                </div>
                <div>
                    <InputLabel for="duration" value="Duration" />
                    <input type="text" id="duration" v-model="form.duration" />
                    <InputError class="mt-2" :message="form.errors.duration" />
                </div>
                <div>
                    <InputLabel for="join_date" value="Join Date" />
                    <input type="date" id="join_date" v-model="form.join_date" />
                    <InputError class="mt-2" :message="form.errors.join_date" />
                </div>
                <div>
                    <InputLabel for="leave_date" value="Leave Date" />
                    <input type="date" id="leave_date" v-model="form.leave_date" />
                    <InputError class="mt-2" :message="form.errors.leave_date" />
                </div>
            </div>



            <h1>Student Project Details</h1>

            <InputLabel for="projectName" value="project Name" />
            <div v-for="(p, index) in projectsArray" :key="index">

                <div>Project Name:<input type="button" v-model="p.name"></div>
                <div>Status:<input type="button" v-model="p.status"></div>
                <div>Duration:<input type="button" v-model="p.duration"></div>
                <div>Description:<input type="button" v-model="p.description"></div>
                <div>Start date:<input type="button" v-model="p.start_date"></div>
                <div>End date:<input type="button" v-model="p.end_date"></div>
                <button type="button" @click="removeProject(p.id)">Remove</button>

            </div>
            <!-- <div projects as p> -->
            <div v-for="(project, index) in form.unionProjects" :key="index">
                <InputLabel for="projectName" value="project Name" />
                <!-- <input type="text" id="projectName" v-model="form.name" /> -->
                <!-- <select v-model="project.project_id">
                    <option :value="1">Yearly Project</option>
                    <option :value="2">Monthly Project</option>
                </select> -->

                <p v-if="unionsLoading">Loading </p>
                <select v-model="project.project_id">
                    <!-- <option disabled value="" selected>{{ p.name }}</option> -->
                    <option v-for=" project in projects" :value="project.id">
                        {{ project.name }}
                    </option>
                </select>
                <InputError class="mt-2" :message="form.errors.project_id" />
                <button type="button" v-if="index > 0" @click="removeResult(index)">Remove</button>
                <button type="button" v-if="index < 9" @click="addResult">Add</button>

            </div>
            <!-- </div> -->

            <div class="flex items-center gap-4">
                <!-- <button @click="storeExamDetails(student.id)">Save</button> -->
                <PrimaryButton :disabled="form.processing">update</PrimaryButton>
            </div>


        </form>
    </AuthenticatedLayout>
</template>