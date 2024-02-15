<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavForPages from '@/Layouts/NavForPages.vue';

const props = defineProps({
    sports: {
        type: Array
    },
    // achievements: {
    //     type: Array
    // },
    student: {
        type: Object
    }
})
</script>

<template>
    <Head title="Add Union" />
    <AuthenticatedLayout>
        <NavForPages :student="student"> </NavForPages>
        <div class="ml-3 my-2 px-3  pb-3">
            <div>
                <h1 class="text-rc-eastern-blue text-lg sm:text-3xl pt-3 pb-3 pl-4">Sport Information</h1>
            </div>
        </div>

        <div class=" shadow-inner">
            <div class="lg:flex">
                <!-- <p class=" font-medium pl-14 text-md text-gray-500 text-xs font-large">
                {{ student.first_name }} {{ student.last_name }} <br> {{
                    student.reg_no }}
            </p> -->
                <div class="lg:flex-1 grid grid-cols-2 gap-5 sm:mb-10 py-5">
                    <p class="  pl-14 font-medium text-md text-gray-500  font-large">{{ student.first_name }} {{
                        student.last_name
                    }}
                        <br> {{
                            student.reg_no }}
                    </p>
                </div>
                <div class="lg:flex-1">
                    <button type=" button"
                        class="float-right text-white mr-16 bg-rc-bondi-blue hover:bg-rc-bondi-blue2  font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 focus:outline-non">

                        <!-- <Link :href="route('sport.create', { student: student.id })" method="get" as="button">Add New
                    Exam Result</Link> -->
                        <div>Add New Sport</div>
                    </button>
                </div>

            </div>

        </div>
        <div class="flex justify-center items-center px-20 overflow-x-auto shadow-md sm:rounded-lg">






        </div>

    </AuthenticatedLayout>
</template>