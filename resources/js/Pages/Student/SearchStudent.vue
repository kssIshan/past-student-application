<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { reactive } from 'vue';
import axios from 'axios';

let id = ref("")
let studentList = reactive([])
const firstName = ref(null)
const lastName = ref(null)
let commentsLoading = ref(false)
// defineProps({
//     student: {
//         type: Object
//     }

// });
// const routeParams = computed(() => {
//     return id.value !== null ? { studentId: id.value } : null;
// });
const getStudents = async (firstName, lastName) => {
    try {
        commentsLoading.value = true
        const response = await axios.get(route('student.showbyName', { firstName: firstName, lastName: lastName }))
        console.log(response);
        studentList = response.data.students
        console.log(studentList);
        studentList.forEach(student => {
            console.log(student.first_name);
        });

        commentsLoading.value = false
    } catch (error) {
        console.log(error, "1");
    }

    //console.log(props.post.id, response, postCommentList);
}
</script>
<template>
    <AuthenticatedLayout>
        <div>search</div>

        <input type="numeric" id="id" v-model="id" />
        {{ id }}
        <label for="id">Student ID</label>
        <div>
            <Link :href="route('student.show', { regNo: id })" method="get" as="button">Search Student by Reg no
            </Link>

            <!-- <Link :href="`http://localhost:8000/student/1/show`" method="get" as="button">Search Student
            </Link> -->
        </div>
        <div>
            <input type="text" id="firstName" v-model="firstName" />
            <input type="text" id="lastName" v-model="lastName" />
            <button type="button" @click="getStudents(firstName, lastName)">Search by first and last name</button>
            <!-- {{ studentList }} -->
            <h1>Student Information</h1>
            <div v-if="studentList.length" v-for="student in studentList" :key="student.id">
                <!-- <div v-for="student in studentList" :key="student.id"> -->
                <h2>{{ student.first_name }} {{ student.last_name }}</h2>
                <p>Registration Number: {{ student.reg_no }}</p>
                <p>Email: {{ student.email }}</p>
                <p>Date of Birth: {{ student.dob }}</p>
                <Link :href="route('student.show', { regNo: student.reg_no })" method="get" as="button">Search
                </Link>
            </div>

            <div v-else>
                No students found.
            </div>
            <p v-if="commentsLoading">Loading </p>
        </div>
        <!-- {{ student }} -->
    </AuthenticatedLayout>
</template>