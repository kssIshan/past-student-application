<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import StudentViewComponent from '@/Pages/Student/StudentViewComponent.vue'
// import NavForPages from '@/Layouts/NavForPages.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
    student: {
        type: Object
    },

});
</script>

<template>

    <Head title="Basic Information Search" />

    <AuthenticatedLayout>

        <StudentViewComponent :student="student">

        </StudentViewComponent>
        <div class="p-4 flex justify-end">
            <Link :href="route('dashboard')" :active="route().current('dashboard')"
                class="rounded-md bg-rc-java sm:px-10 sm:py-2 py-1 px-5 text-sm font-semibold text-white  hover:bg-rc-bondi-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:rc-bondi-blue2">
            back
            </Link>
        </div>


    </AuthenticatedLayout>

</template>