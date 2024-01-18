<script setup>
import NavLink from '@/Components/NavLink.vue';

defineProps({
    studentId: {
        type: Number
    }
})
</script>


<template>
    <!-- Navigation Links -->
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Home
        </NavLink>
        <NavLink :href="route('student.show', { studentId: studentId })"
            :active="route().current('student.show', { studentId: studentId })">
            Basic Information
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Student Union
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Sport & Achievements
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Education
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Activity
        </NavLink>
    </div>
</template>