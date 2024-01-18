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

const toggleSaveUnion = async () => {
    showUnion.value = !showUnion.value;
}

const toggleSaveProject = async () => {
    showProject.value = !showProject.value;

}
const props = defineProps({
    student: {
        type: Object
    },
    unions: {
        type: Array
    },
    projects: {
        type: Array
    }
})

const form = useForm({

    union_id: "",
    position: "",
    duration: "",
    join_date: "",
    leave_date: "",
    unionProjects: [{ project_id: null }],

})
const form1 = useForm({
    studentId: props.student.id,
    name: "",
    start_date: "",
    status: "",

})
const form2 = useForm({
    student_id: props.student.id,
    union_id: "",
    name: "",
    status: "",
    duration: "",
    description: "",
    start_date: "",
    end_date: ""

})
const postUnion = async () => {

    try {
        unionsLoading.value = true
        const response = await axios.post(route('union.store'), form1);
        console.log(response, route('union.store'));

        EditCommentId = null
        unionsLoading.value = false


    } catch (e) {
        //console.log(e, "6");
        console.log(e.response.status, 'status');
        if (e.response.status === 422) {
            //error = e.response.data.errors
            console.log(e.response.data.errors, "putError msg");
        }
    }
}

const postProject = async () => {
    //console.log(unionId, 'by postProject');
    try {
        projectLoading.value = true
        const response = await axios.post(route('project.store'), form2);
        console.log(response, route('project.store'));


        projectLoading.value = false


    } catch (e) {
        console.log(e, "6");
        // console.log(e.response.status, 'status');
        // if (e.response.status === 422) {
        //     //error = e.response.data.errors
        //     console.log(e.response.data.errors, "putError msg");
        // }
    }
}
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
        <form @submit.prevent="form.post(route('unionProject.store', { student: student }))">
            <div>
                <h1>Student Union Details</h1>
                <div>
                    <InputLabel for="unionName" value="Union Name" />
                    <!-- <input type="text" id="unionName" v-model="form.name" /> -->
                    <!-- <select v-model="form.union_id">
                        <option :value="1">Sport Club</option>
                        <option :value="2">Dance Club</option>
                    </select> -->
                    <select v-model="form.union_id" @change="onUnionChange(form.union_id)">
                        <!-- <div>{{ form.union_id }}</div> -->
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
            <div v-if="showUnion">
                <div>

                    <div>Add Union</div>
                    <InputLabel for="name" value="Name" />
                    <input type="text" id="name" v-model="form1.name" />
                    <InputError class="mt-2" :message="form1.errors.name" />

                    <InputLabel for="start_date" value="start Date" />
                    <input type="date" id="start_date" v-model="form1.start_date" />
                    <InputError class="mt-2" :message="form1.errors.start_date" />

                    <InputLabel for="status" value="Status" />
                    <input type="text" id="status" v-model="form1.status" />
                    <InputError class="mt-2" :message="form1.errors.status" />
                    <button type="button" @click="postUnion()">Send</button>
                </div>
            </div>

            <div @click="toggleSaveUnion()">
                <span v-if="showUnion">Done Save</span>
                <!-- <span v-if="!showText">Show text</span> -->
                <span v-else> <button type="button">Add Union</button></span>

            </div>
            <h1>Student Project Details</h1>
            <div v-for="(project, index) in form.unionProjects" :key="index">
                <InputLabel for="projectName" value="project Name" />
                <!-- <input type="text" id="projectName" v-model="form.name" /> -->
                <!-- <select v-model="project.project_id">
                    <option :value="1">Yearly Project</option>
                    <option :value="2">Monthly Project</option>
                </select> -->
                <p v-if="unionsLoading">Loading </p>
                <select v-model="project.project_id">
                    <option v-for=" project in projects" :value="project.id">
                        {{ project.name }}
                    </option>
                </select>
                <InputError class="mt-2" :message="form.errors.project_id" />
                <button type="button" v-if="index > 0" @click="removeResult(index)">Remove</button>
                <button type="button" v-if="index < 9" @click="addResult">Add</button>

            </div>
            <div v-if="showProject">

                <div>Add Project</div>
                <div>Select union</div>
                <select v-model="form2.union_id">
                    <!-- <div>{{ form.union_id }}</div> -->
                    <option v-for=" union in unions" :value="union.id">
                        {{ union.name }}
                    </option>
                </select>
                <InputLabel for="name" value="Name" />
                <input type="text" id="name" v-model="form2.name" />
                <InputError class="mt-2" :message="form2.errors.name" />

                <InputLabel for="status" value="Status" />
                <input type="text" id="status" v-model="form2.status" />
                <InputError class="mt-2" :message="form2.errors.status" />

                <InputLabel for="duration" value="Duration" />
                <input type="text" id="duration" v-model="form2.duration" />
                <InputError class="mt-2" :message="form2.errors.duration" />

                <InputLabel for="description" value="Description" />
                <input type="text" id="description" v-model="form2.description" />
                <InputError class="mt-2" :message="form2.errors.description" />

                <InputLabel for="start_date" value="Start date" />
                <input type="date" id="start_date" v-model="form2.start_date" />
                <InputError class="mt-2" :message="form2.errors.start_date" />

                <InputLabel for="end_date" value="End date" />
                <input type="date" id="end_date" v-model="form2.end_date" />
                <InputError class="mt-2" :message="form2.errors.end_date" />
                <button type="button" @click="postProject()">Send</button>
                <p v-if="projectLoading">Loading </p>
            </div>
            <div @click="toggleSaveProject()">
                <span v-if="showProject">Done Save</span>
                <!-- <span v-if="!showText">Show text</span> -->
                <span v-else> <button type="button">Add Project</button></span>

            </div>
            <div class="flex items-center gap-4">
                <!-- <button @click="storeExamDetails(student.id)">Save</button> -->
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
            </div>


        </form>
    </AuthenticatedLayout>
</template>