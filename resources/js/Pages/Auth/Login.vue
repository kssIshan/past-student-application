<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};


</script>

<template>
    <!-- <GuestLayout></GuestLayout> -->

    <Head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>
    <div class="absolute inset-y-0 right-0 w-[20%] sm:w-[30%] bg-rc-lily-white sm:visible h-screen z-0">

        <div class=" w-[60%] h-[60%] visible  pr-3">
            <img src="../../../Images/limg.png" alt="Login" class="z-10">

        </div>
    </div>

    <div class="mx-auto">
        <div class="flex bg-cover mx-20 mt-10 mb-5 sm:pl-10 pt-4 justify-center">

            <!-- <img src="logo.png" alt="Logo" class="sm:w-[20%] sm:h-[10%] w-[40%] h-[20%] z-10"> -->
            <ApplicationLogo></ApplicationLogo>
        </div>
        <div class="flex sm:text-left z-10 sm:ml-20 pl-2 sm:justify-center">
            <h1 class="z-10 text-rc-eastern-blue text-xl sm:text-3xl text-center sm:text-center">Welcome,
                <b class="z-10 font-semibold">
                    <br>The Old Boys Information
                    System
                </b>
            </h1>
        </div>
        <div class="flex sm:h-[8%] sm:pl-[40%] sm:justify-center font-sans pl-2 justify-between">
            <div>
                <h1 class="text-3xl font-bold pt-10  pl-3 "> Log In</h1>
            </div>

            <div class=" w-[60%] h-[60%] visible sm:invisible pr-3">
                <img src="limg.png" alt="Login">

            </div>
        </div>
        <div class="mx-auto px-3 sm:w-[40%] sm:pl-20">
            <div class=" sm:mt-1 lg:pl-1 sm:w-full sm:max-w-sm">
                <form class=" pt-10 space-y-4" @submit.prevent="submit">

                    <div>
                        <InputLabel for="email" value="Email" />


                        <div class="mt-2">
                            <TextInput id="email" type="email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                v-model="form.email" required autofocus autocomplete="email" />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <InputLabel for="password" value="Password" />


                            <div class="text-sm">
                                <Link v-if="canResetPassword" :href="route('password.request')"
                                    class="text-rc-nobel hover:text-rc-nobel">
                                Forgot password?
                                </Link>
                            </div>

                        </div>
                    </div>
                    <div class="mt-2">
                        <TextInput id="password" type="password"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            v-model="form.password" required autocomplete="current-password" />
                        <InputError class="mt-2" :message="form.errors.password" />

                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <label for="comments" class="font-medium text-rc-nobel">Remember
                                me</label>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">


                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log in
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>
