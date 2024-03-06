<script setup>
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { ref } from 'vue'

const props = defineProps({
    student: {
        type: Object
    }
})
const showingNavigationDropdown = ref(false);
const searchStudent = ref("searchStudent")
</script>


<template>
    <!-- Navigation Links -->
    <!-- <div>{{ props.student.reg_no }}</div> -->
    <div
        class="flex-shrink-0 items-center justify-between hidden space-x-8 sm:-my-px  sm:flex bg-rc-bondi-blue bg-opacity-65">
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Home
        </NavLink>
        <NavLink :href="route('student.search1', { regNo: props.student.reg_no, searchId: searchStudent })"
            :active="route().current('student.search1', { regNo: props.student.reg_no, searchId: searchStudent })">
            Basic Information
        </NavLink>
        <NavLink :href="route('union.searchUnion', { regNo: props.student.reg_no, searchUnionId: searchStudent })"
            :active="route().current('union.searchUnion', { regNo: props.student.reg_no, searchUnionId: searchStudent })">
            Student Union
        </NavLink>
        <NavLink :href="route('sport.index', { regNo: props.student.reg_no, searchSportId: searchStudent })"
            :active="route().current('sport.index', { regNo: props.student.reg_no, searchSportId: searchStudent })">
            Sport & Achievements
        </NavLink>
        <NavLink :href="route('exam.index1', { regNo: props.student.reg_no, searchEducationId: searchStudent })"
            :active="route().current('exam.index1', { regNo: props.student.reg_no, searchEducationId: searchStudent })">
            Education
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Association
        </NavLink>


    </div>
    <!-- <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                Home
            </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('student.search1', { regNo: props.student.reg_no })"
                :active="route().current('student.search1', { regNo: props.student.reg_no })">
                Basic Information
            </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('union.index1', { studentId: props.student.id })"
                :active="route().current('union.index1', { studentId: props.student.id })">
                Student Union
            </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('sport.index', { studentId: props.student.id })"
                :active="route().current('sport.index', { studentId: props.student.id })">
                Sport & Achievements
            </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('exam.index1', { student: props.student.id })"
                :active="route().current('exam.index1', { student: props.student.id })">
                Education
            </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                Activity
            </ResponsiveNavLink>
        </div>
    </div> -->
</template>