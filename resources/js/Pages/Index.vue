<script setup>

import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="flex justify-center item-center ">
            <div class=" grid grid-cols-8 grid-row-3 gap-4">
                <div class=" bg-rc-purple-heart col-span-3">Search Student</div>
                <div class=" bg-rc-purple-heart col-span-2 ">Add a New student</div>
                <div class=" bg-rc-purple-heart col-span-3">Basic Information</div>
                <div class="col-span-3  bg-rc-purple-heart">Student Unions</div>
                <div class="col-span-2 bg-rc-purple-heart">Activities</div>
                <div class="row-span-2 col-span-3 bg-rc-purple-heart">Sport And Achievements</div>
                <div class="col-span-3  bg-rc-purple-heart">Setting</div>
                <div class="col-span-2  bg-rc-purple-heart">Education</div>
                <div class="bg-rc-dark-green"></div>
            </div>

        </div>


    </AuthenticatedLayout>
</template>