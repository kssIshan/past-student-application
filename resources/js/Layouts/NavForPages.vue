<script setup>
import NavLink from '@/Components/NavLink.vue';

const props = defineProps({
    student: {
        type: Object
    }
})
</script>


<template>
    <!-- Navigation Links -->
    <!-- <div>{{ props.student.reg_no }}</div> -->
    <div
        class="flex-shrink-0 items-center justify-between hidden space-x-8 sm:-my-px  sm:flex bg-rc-bondi-blue bg-opacity-65">
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Home
        </NavLink>
        <NavLink :href="route('student.show', { regNo: props.student.reg_no })"
            :active="route().current('student.show', { regNo: props.student.reg_no })">
            Basic Information
        </NavLink>
        <NavLink :href="route('union.index', { studentId: props.student.id })"
            :active="route().current('union.index', { studentId: props.student.id })">
            Student Union
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Sport & Achievements
        </NavLink>
        <NavLink :href="route('exam.index', { student: props.student.id })"
            :active="route().current('exam.index', { student: props.student.id })">
            Education
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Activity
        </NavLink>
    </div>
</template>