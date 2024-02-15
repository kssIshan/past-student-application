<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavForPages from '@/Layouts/NavForPages.vue';

const props = defineProps({
    sports: {
        type: Array
    },
    achievement: {
        type: Object
    },
    student: {
        type: Object
    }
})

const form = useForm({
    //student_id: props.student.id,
    sport_id: props.achievement.sport_id,
    achievement_name: props.achievement.achievement_name,
    achievement_date: props.achievement.achievement_date,
    achievement_type: props.achievement.achievement_type,
    achievement_level: props.achievement.achievement_level,
    achievement_status: props.achievement.achievement_status,
    age_gap: props.achievement.age_gap,
    description: props.achievement.description,
    sport_name: props.achievement.sport.sport_name
})
</script>

<template>
    <Head title="Add Union" />
    <AuthenticatedLayout>
        <!-- <NavForPages :student="student"> </NavForPages> -->
        <!-- {{ props.achievement.sport.sport_name }}
        {{ sports }} -->
        <!-- <div>{{ sports }}</div> -->
        <div class=" w-screen">
            <div class="ml-8">
                <div class="relative invisible sm:visible sm:mt-4">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="#"
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">

                                    Home
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <a href="#"
                                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Education</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Edit
                                        Ahievement</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <h1 class="text-rc-eastern-blue text-lg sm:text-3xl pt-3 pb-3"> Edit Achievement</h1>
                </div>
                <form
                    @submit.prevent="form.put(route('achievement.update', { studentId: student.id, achievementId: achievement.id }))">
                    <div>
                        <div class="sm:col-span-3">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Achievement
                                Name*
                            </label>
                            <div>
                                <input v-model="form.achievement_name" type="text" name="first-name" id="first-name"
                                    autocomplete="given-name"
                                    class="block w-[95%] sm:w-[85%] lg:w-[93%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                    placeholder="">
                                <InputError class="mt-2" :message="form.errors.achievement_name" />
                            </div>
                            <div class="lg:flex  lg:mt-10 ">
                                <div class="lg:flex-1">
                                    <div class="sm:col-span-3">
                                        <label class="block text-sm font-medium leading-6 text-gray-900">Achievement
                                            Date</label>
                                        <div class="container py-2">
                                            <div class="relative">
                                                <input v-model="form.achievement_date"
                                                    class="block lg:w-[85%] w-[95%] sm:w-[87%] rounded-md border-0 py-1.5 text-gray-500 ring-1 placeholder:text-xs ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                    type="date">
                                                <InputError class="mt-2" :message="form.errors.achievement_date" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:flex-1 lg:pt-1 sm:flex-1 sm:pt-1 ">
                                    <div
                                        class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0 sm:absolute absolute lg:w-[50%] sm:w-[50%]">
                                        <label for="first-name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Status
                                        </label>
                                        <div class="mt-2">
                                            <input v-model="form.achievement_status" type="text" name="first-name"
                                                id="first-name" autocomplete="given-name"
                                                class="block w-[85%]  rounded-md border-0 py-1.5 text-gray-900 ring-1  ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                            <InputError class="mt-2" :message="form.errors.achievement_status" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-3 w-screen visible sm:visible lg:invisible  lg:absolute">
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6  text-gray-900">Status</label>
                                <div class="mt-2">
                                    <input v-model="form.achievement_status" type="text" name="first-name" id="first-name"
                                        autocomplete="given-name"
                                        class="block w-[81%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                        placeholder="">
                                    <InputError class="mt-2" :message="form.errors.achievement_status" />
                                </div>
                            </div>

                            <div class="lg:flex">
                                <div class="lg:flex-1">
                                    <div>
                                        <label class="block text-sm font-medium leading-6 text-gray-900">Achievement
                                            Type</label>
                                        <div class="mt-2">
                                            <select
                                                class="block lg:w-[85%] sm:w-[85%] w-[95%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                v-model="form.achievement_type">
                                                <option value="Sports">Sports</option>
                                                <option value="Education">Education</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <InputError class="mt-2" :message="form.errors.achievement_type" />
                                    </div>

                                </div>
                                <div class="lg:flex-1 lg:pt-1 sm:flex-1 sm:pt-1">

                                    <div
                                        class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0 sm:absolute absolute lg:w-[50%] sm:w-[50%]">
                                        <label for="first-name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Sport</label>
                                        <div class="mt-2">


                                            <select
                                                class="block lg:w-[85%] sm:w-[88%] w-[95%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                v-model="form.sport_id">
                                                <!-- v-model="form.achievement.sport.sport_name" -->
                                                <option v-for=" sport in sports" :value="sport.id">
                                                    {{ sport.sport_name }}

                                                </option>
                                            </select>

                                        </div>
                                        <InputError class="mt-2" :message="form.errors.sport_id" />
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-3 w-screen visible sm:visible lg:invisible lg:absolute">
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:my-5">Sport</label>
                                <div class="mt-2">
                                    <select
                                        class="block w-[81%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                        <!-- v-model="form.sport_name" -->
                                        <option v-for=" sport in sports" :value="sport.id">
                                            {{ sport.sport_name }}
                                        </option>
                                    </select>
                                </div>
                                <InputError class="mt-2" :message="form.errors.sport_id" />
                            </div>
                            <div class="lg:flex">
                                <div class="lg:flex-1">
                                    <div>
                                        <label for="first-name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Achievement
                                            Level</label>
                                        <div class="mt-2">
                                            <input v-model="form.achievement_level" type="text" name="first-name"
                                                id="first-name" autocomplete="given-name"
                                                class="block w-[85%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                            <InputError class="mt-2" :message="form.errors.achievement_level" />
                                        </div>
                                    </div>

                                </div>
                                <div class="lg:flex-1">
                                    <div
                                        class=" sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0 sm:absolute absolute lg:w-[50%] sm:w-[50%]">
                                        <label for="first-name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Age
                                            Gap</label>
                                        <div class="mt-2">
                                            <input v-model="form.age_gap" type="text" name="first-name" id="first-name"
                                                autocomplete="given-name"
                                                class="block lg:w-[85%] sm:w-[88%] w-[95%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                            <InputError class="mt-2" :message="form.errors.age_gap" />
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="sm:col-span-3 w-screen visible sm:visible lg:invisible lg:absolute">
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6 text-gray-900 sm:my-5">Age
                                    Gap</label>
                                <div class="mt-2">
                                    <input v-model="form.age_gap" type="text" name="first-name" id="first-name"
                                        autocomplete="given-name"
                                        class="block lg:w-[85%] sm:w-[81%] w-[95%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                    <InputError class="mt-2" :message="form.errors.age_gap" />
                                </div>
                            </div>
                            <div>
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                <div class="mt-2">
                                    <input v-model="form.description" type="text" name="first-name" id="first-name"
                                        autocomplete="given-name"
                                        class="block lg:w-[42.5%] w-[42.5%] sm:w-[85%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6">
                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>
                            </div>





                            <div>
                                <div class="mt-6 flex items-center gap-x-6 justify-end lg:mr-20 sm:m-5 ">
                                    <button type="button"
                                        class="text-sm font-semibold leading-6 text-gray-900 shadow-inner">Cancel</button>
                                    <button type="submit"
                                        class="rounded-md bg-indigo-600 pl-3 py-2 pr-4 text-sm font-semibold text-white  hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>


            </div>
        </div>
    </AuthenticatedLayout>
</template>