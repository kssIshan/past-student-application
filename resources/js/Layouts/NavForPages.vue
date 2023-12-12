<script setup>
import NavLink from '@/Components/NavLink.vue';
</script>

<template>
    <!-- Navigation Links -->
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Home
        </NavLink>
        <NavLink :href="route('student.index')" :active="route().current('student.index')">
            Basic Information
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('student.index')">
            Student Union
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('student.index')">
            Sport & Achievements
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('student.index')">
            Education
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('student.index')">
            Activity
        </NavLink>
    </div>
</template>