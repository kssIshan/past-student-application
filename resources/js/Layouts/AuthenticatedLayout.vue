<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div>
            <div>
                <div>
                    <div>
                        <!-- Logo -->
                        <div class="flex shadow md:shadow-lg  pb-3 justify-between h-20 pt-3">
                            <div class=" pt-0 pb-2 mx-8">
                                <Link :href="route('dashboard')">
                                <ApplicationLogo class="sm:w-16 sm:h-16 w-20 h-16" />
                                </Link>
                            </div>
                            <div class="invisible sm:visible">
                                <h1
                                    class="flex pt-3 text-rc-eastern-blue text-center sm:text-4xl text-lg font-sans tracking-normal font-bold">
                                    Old Boys Record System</h1>
                            </div>
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <!-- Settings Dropdown -->
                                <div class="ms-3 relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                    <!-- {{ $page.props.auth.user.name }} -->
                                                    <!-- <img src="../../Images/Vector.png" alt=""> -->
                                                    <div class="sm:mr-10 mr-5 mt-3">
                                                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M18 3.6C15.4814 3.59954 13.0067 4.25968 10.8229 5.51453C8.63913 6.76938 6.82267 8.57505 5.55484 10.7513C4.28701 12.9276 3.61215 15.3983 3.59762 17.9169C3.58308 20.4355 4.22938 22.9138 5.47201 25.1046C6.31191 24.013 7.39159 23.1292 8.62757 22.5215C9.86354 21.9139 11.2227 21.5985 12.6 21.6H23.4C24.7773 21.5985 26.1365 21.9139 27.3724 22.5215C28.6084 23.1292 29.6881 24.013 30.528 25.1046C31.7706 22.9138 32.4169 20.4355 32.4024 17.9169C32.3879 15.3983 31.713 12.9276 30.4452 10.7513C29.1773 8.57505 27.3609 6.76938 25.1771 5.51453C22.9933 4.25968 20.5186 3.59954 18 3.6ZM32.2974 28.9368C34.704 25.7993 36.0058 21.9542 36 18C36 8.05859 27.9414 0 18 0C8.05861 0 2.02558e-05 8.05859 2.02558e-05 18C-0.00592232 21.9542 1.29585 25.7994 3.70262 28.9368L3.69362 28.9692L4.33262 29.7126C6.02081 31.6863 8.1169 33.2705 10.4764 34.3559C12.8359 35.4414 15.4028 36.0023 18 36C21.6492 36.0067 25.2133 34.8982 28.215 32.823C29.4947 31.9388 30.655 30.8934 31.6674 29.7126L32.3064 28.9692L32.2974 28.9368ZM18 7.19999C16.5678 7.19999 15.1943 7.76892 14.1816 8.78162C13.1689 9.79431 12.6 11.1678 12.6 12.6C12.6 14.0322 13.1689 15.4057 14.1816 16.4184C15.1943 17.4311 16.5678 18 18 18C19.4322 18 20.8057 17.4311 21.8184 16.4184C22.8311 15.4057 23.4 14.0322 23.4 12.6C23.4 11.1678 22.8311 9.79431 21.8184 8.78162C20.8057 7.76892 19.4322 7.19999 18 7.19999Z"
                                                                fill="#CCCCCC" />
                                                        </svg>

                                                    </div>

                                                    <!-- <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg> -->
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div>
            <!-- <div class="min-h-screen bg-gray-100"> -->
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- <div class="flex justify-between h-16"> -->
                    <!-- <div class="flex"> -->

                    <!-- Navigation Links -->
                    <!-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    dashboard
                                </NavLink>
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
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
                            </div> -->
                    <!-- </div> -->



                    <!-- Hamburger -->
                    <!-- <div class="-me-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{
                                    hidden: showingNavigationDropdown,
                                    'inline-flex': !showingNavigationDropdown,
                                }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex': showingNavigationDropdown,
                                }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div> -->
                    <!-- </div> -->
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
                    <!-- <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Hom
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Basic Information
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Student Union
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Sport & Achievements
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Education
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('home')">
                            Activity
                        </ResponsiveNavLink>
                    </div> -->

                    <!-- Responsive Settings Options -->
                    <!-- <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div> -->
                </div>
            </nav>

            <!-- Page Heading -->
            <!-- <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header> -->

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
