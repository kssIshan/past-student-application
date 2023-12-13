<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

let id = ref(0)
// defineProps({
//     student: {
//         type: Object
//     }

// });
// const routeParams = computed(() => {
//     return id.value !== null ? { studentId: id.value } : null;
// });
</script>
<template>
    <AuthenticatedLayout>
        <div>search</div>

        <input type="numeric" id="id" v-model="id" />
        {{ id }}
        <label for="id">Student ID</label>
        <div>
            <Link :href="route('student.show', { studentId: id })" method="get" as="button">Search Student
            </Link>

            <!-- <Link :href="`http://localhost:8000/student/1/show`" method="get" as="button">Search Student
            </Link> -->
        </div>
        <!-- {{ student }} -->
    </AuthenticatedLayout>
</template>