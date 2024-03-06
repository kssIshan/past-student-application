<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { ref } from 'vue'

const searchStudent = ref("searchStudent")
const props = defineProps({
    student: {
        type: Object
    }
});

const form = useForm({
    reg_no: props.student.reg_no,
    nic: props.student.nic,
    //full_name: props.student.full_name,
    first_name: props.student.first_name,
    last_name: props.student.last_name,
    dob: props.student.dob,
    //shedule_date: new Date().toISOString().split('T')[0],
    date_of_admission: props.student.date_of_admission,
    date_of_leave: props.student.date_of_leave,
    address: props.student.address,
    email: props.student.email,
    mobile_no: props.student.mobile_no,
    mobile_no2: props.student.mobile_no2,
    land_no: props.student.land_no,

});

</script>

<template>
    <AuthenticatedLayout>
        <!-- {{ student }} -->
        <div>

            <div class=" pt-4">
                <div class="pl-2">
                    <Link :href="route('dashboard')" :active="route().current('dashboard')"
                        class="relative inline-flex items-center py-2 text-xs font-semibold text-rc-gunsmoke  ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                    Home
                    </Link>
                    <a href="#"
                        class="relative inline-flex items-center rounded-r-md pl-1  pt-2 py-2 text-gray-400  ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Next</span>
                        <svg width="4" height="8" viewBox="0 0 6 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.185671 11.492C0.134878 11.5482 0.0952219 11.6139 0.0689657 11.6855C0.0427095 11.757 0.0303675 11.833 0.0326452 11.909C0.034923 11.985 0.0517759 12.0596 0.0822408 12.1285C0.112706 12.1974 0.156186 12.2593 0.210201 12.3107C0.264215 12.362 0.327704 12.4017 0.397045 12.4276C0.466385 12.4535 0.540218 12.4651 0.614327 12.4617C0.688437 12.4582 0.761373 12.4398 0.82897 12.4076C0.896566 12.3753 0.957501 12.3298 1.00829 12.2736L5.7938 6.97658C5.89262 6.8673 5.94749 6.72394 5.94714 6.57593C5.94679 6.42793 5.89124 6.2865 5.7919 6.18067L0.981561 1.05045C0.930837 0.994821 0.869702 0.95025 0.801706 0.91933C0.733709 0.888409 0.660208 0.871754 0.58547 0.870333C0.510732 0.868911 0.436247 0.882752 0.366343 0.91105C0.296439 0.939348 0.232508 0.981539 0.178264 1.03517C0.12402 1.08881 0.0805446 1.15282 0.0503627 1.22348C0.0201808 1.29414 0.00389474 1.37006 0.00244931 1.4468C0.00100389 1.52355 0.0144281 1.59961 0.041943 1.67056C0.0694579 1.7415 0.110515 1.80593 0.162728 1.86008L4.60635 6.59932L0.185671 11.492Z"
                                fill="#878787" />
                        </svg>
                        <Link :href="route('student.search1', { regNo: props.student.reg_no, searchId: searchStudent })"
                            class="relative inline-flex items-center py-2 text-xs font-semibold text-rc-gunsmoke  ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        Basic Information </Link>
                    </a>
                    <a href="#"
                        class="relative inline-flex items-center rounded-r-md pl-1  pt-2 py-2 text-gray-400  ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Next</span>
                        <svg width="4" height="8" viewBox="0 0 6 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.185671 11.492C0.134878 11.5482 0.0952219 11.6139 0.0689657 11.6855C0.0427095 11.757 0.0303675 11.833 0.0326452 11.909C0.034923 11.985 0.0517759 12.0596 0.0822408 12.1285C0.112706 12.1974 0.156186 12.2593 0.210201 12.3107C0.264215 12.362 0.327704 12.4017 0.397045 12.4276C0.466385 12.4535 0.540218 12.4651 0.614327 12.4617C0.688437 12.4582 0.761373 12.4398 0.82897 12.4076C0.896566 12.3753 0.957501 12.3298 1.00829 12.2736L5.7938 6.97658C5.89262 6.8673 5.94749 6.72394 5.94714 6.57593C5.94679 6.42793 5.89124 6.2865 5.7919 6.18067L0.981561 1.05045C0.930837 0.994821 0.869702 0.95025 0.801706 0.91933C0.733709 0.888409 0.660208 0.871754 0.58547 0.870333C0.510732 0.868911 0.436247 0.882752 0.366343 0.91105C0.296439 0.939348 0.232508 0.981539 0.178264 1.03517C0.12402 1.08881 0.0805446 1.15282 0.0503627 1.22348C0.0201808 1.29414 0.00389474 1.37006 0.00244931 1.4468C0.00100389 1.52355 0.0144281 1.59961 0.041943 1.67056C0.0694579 1.7415 0.110515 1.80593 0.162728 1.86008L4.60635 6.59932L0.185671 11.492Z"
                                fill="#878787" />
                        </svg>
                        <a href="#"
                            class="relative inline-flex items-center px-4 py-2 text-xs font-semibold text-gray-900  ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">Edit
                            a New Student</a>
                    </a>

                </div>
                <div>
                    <h1 class="text-rc-eastern-blue text-lg sm:text-3xl pt-3 pb-3 pl-4"> Edit Student Details</h1>
                </div>
                <form @submit.prevent="form.put(route('student.update', { studentId: student.id }))">
                    <div class=" pt-4">


                        <div>
                            <div class="flex flex-col space-y-4 ">
                                <div class=" border-2 border-gray-900/10 m-8 pl-3 shadow-lg pb-3 ">
                                    <div>
                                        <h2 class="p-4 text-base font-semibold leading-7 text-gray-900">Basic Details
                                        </h2>
                                        <div class=" grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                            <!-- <div class="sm:col-span-3 w-screen pt-4">
                                        <label for="fullName" class="block text-sm font-medium leading-6 text-gray-900">Full
                                            Name*</label>
                                        <div class="mt-2">
                                            <input type="text" name="fullName" v-model="form.full_name" id="fullName"
                                                autocomplete="given-name"
                                                class="block w-[76%] sm:w-[78%] lg:w-[76%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                placeholder="Enter Full Name">
                                        </div>
                                    </div> -->
                                        </div>
                                        <div class="lg:flex">
                                            <div class="lg:flex-1">
                                                <div class="sm:col-span-3">
                                                    <label for="first_name"
                                                        class="m-2 block text-sm font-medium leading-6 text-gray-900">
                                                        First
                                                        Name
                                                    </label>
                                                    <div class="mt-2">
                                                        <input type="text" name="first_name" v-model="form.first_name"
                                                            id="first_name" autocomplete="given-name"
                                                            class="block sm:w-[99%] w-[95%] lg:w-[88%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                            placeholder="Enter First Name">
                                                        <InputError class="mt-2" :message="form.errors.first_name" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="lg:flex-1 ">
                                                <div
                                                    class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0 sm:absolute absolute lg:w-[43%]">
                                                    <label for="last_name"
                                                        class="m-2 block text-sm font-medium leading-6 text-gray-900">Last
                                                        Name
                                                    </label>
                                                    <div class="mt-2">
                                                        <input type="text" name="last_name" v-model="form.last_name"
                                                            id="last_name" autocomplete="given-name"
                                                            class="block w-[95%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                            placeholder="Enter Last Name">
                                                        <InputError class="mt-2" :message="form.errors.last_name" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lg:flex">
                                        <div class="lg:flex-1">
                                            <div class="sm:col-span-3">
                                                <label for="reg_no"
                                                    class="m-2 block text-sm font-medium leading-6 text-gray-900">Registration
                                                    Number</label>
                                                <div class="mt-2">
                                                    <input type="text" name="reg_no" id="reg_no" v-model="form.reg_no"
                                                        autocomplete="given-name"
                                                        class="block sm:w-[99%] w-[95%] lg:w-[88%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        placeholder="Number">
                                                    <InputError class="mt-2" :message="form.errors.reg_no" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="lg:flex-1 ">
                                            <div
                                                class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0 sm:absolute absolute lg:w-[43%]">
                                                <label for="nic"
                                                    class="m-2 block text-sm font-medium leading-6 text-gray-900">NIC
                                                    Number</label>
                                                <div class="mt-2">
                                                    <input type="text" name="nic" id="nic" v-model="form.nic"
                                                        autocomplete="given-name"
                                                        class="block w-[95%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        placeholder="977842330v">
                                                    <InputError class="mt-2" :message="form.errors.nic" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="sm:col-span-3 w-screen visible sm:visible lg:invisible lg:absolute">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">NIC
                                Number</label>
                            <div class="mt-2">
                                <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                    class="block sm:w-[76%] w-[70%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    placeholder="977832110v">
                            </div>
                        </div> -->
                                    <div class="lg:flex">
                                        <div class="lg:flex-1">
                                            <div class="sm:col-span-3">
                                                <label for="dob"
                                                    class="m-2 block text-sm font-medium leading-6 text-gray-900">
                                                    Date Of Birth</label>
                                                <div class="mt-2">
                                                    <input type="date" name="dob" id="dob" v-model="form.dob"
                                                        autocomplete="given-name"
                                                        class="block sm:w-[99%] w-[95%] lg:w-[88%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        placeholder="AB342344">
                                                    <InputError class="mt-2" :message="form.errors.dob" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lg:flex-1 ">
                                            <div
                                                class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0 sm:absolute absolute lg:w-[43%]">
                                                <label for="enrollement_date"
                                                    class="m-2 block text-sm font-medium leading-6 text-gray-900">Enrollment
                                                    Date</label>
                                                <div class="mt-2">
                                                    <input type="date" name="enrollement_date"
                                                        v-model="form.date_of_admission" id="enrollement_date"
                                                        autocomplete="given-name"
                                                        class="block w-[95%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        placeholder="977842330v">
                                                    <InputError class="mt-2" :message="form.errors.date_of_admission" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="lg:flex">
                                        <div class="lg:flex-1">
                                            <div
                                                class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0  lg:w-[43%]">
                                                <label for="pass_out_date"
                                                    class="m-2 block text-sm font-medium leading-6 text-gray-900">Pass
                                                    Out Date</label>
                                                <div class="mt-2">
                                                    <input type="date" name="pass_out_date" v-model="form.date_of_leave"
                                                        id="pass_out_date" autocomplete="given-name"
                                                        class="block w-[102%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        placeholder="977842330v">
                                                    <InputError class="mt-2" :message="form.errors.date_of_leave" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="border-2 border-gray-900/10 m-8 pl-3 shadow-lg pb-3">
                                    <div>
                                        <h2 class="p-4 text-base font-semibold leading-7 text-gray-900">Contact Details
                                        </h2>
                                        <div class=" grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                            <div class="sm:col-span-3 w-screen pt-4">
                                                <label for="address"
                                                    class="m-2 block text-sm font-medium leading-6 text-gray-900">Address*</label>
                                                <div class="mt-2">
                                                    <input type="text" name="address" v-model="form.address"
                                                        id="address" autocomplete="given-name"
                                                        class="block w-[70%] sm:w-[85%] lg:w-[87%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        placeholder="172/1, Uthuru kirimetiana, Wennappuwa">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lg:flex">
                                        <div class="lg:flex-1">
                                            <div class="sm:col-span-3">
                                                <label for="mobile_01"
                                                    class="m-2 block text-sm font-medium leading-6 text-gray-900">Mobile
                                                    Number 01*</label>
                                                <div class="mt-2">
                                                    <input type="text" name="mobile_01" v-model="form.mobile_no"
                                                        id="mobile_01" autocomplete="given-name"
                                                        class="block sm:w-[99%] lg:w-[88%] w-[95%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        placeholder="+94712342344">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lg:flex-1 ">
                                            <div
                                                class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0 sm:absolute absolute lg:w-[43%]">
                                                <label for="mobile_02"
                                                    class="m-2 block text-sm font-medium leading-6 text-gray-900">Mobile
                                                    Number 02*</label>
                                                <div class="mt-2">
                                                    <input type="text" name="mobile_02" v-model="form.mobile_no2"
                                                        id="mobile_02" autocomplete="given-name"
                                                        class="block w-[95%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        placeholder="+9471 2342344">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="lg:flex">
                                        <div class="lg:flex-1">
                                            <div class="sm:col-span-3">
                                                <label for="land_no"
                                                    class="m-2 block text-sm font-medium leading-6 text-gray-900">Land
                                                    No</label>
                                                <div class="mt-2">
                                                    <input type="text" name="land_no" v-model="form.land_no"
                                                        id="land_no" autocomplete="given-name"
                                                        class="block sm:w-[99%] w-[95%] lg:w-[88%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        placeholder="+94272342344">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lg:flex-1 ">
                                            <div
                                                class="sm:col-span-3 invisible sm:invisible lg:visible z-0 sm:z-0 sm:absolute absolute lg:w-[43%]">
                                                <label for="email"
                                                    class="m-2 block text-sm font-medium leading-6 text-gray-900">Email</label>
                                                <div class="mt-2">
                                                    <input type="text" name="email" v-model="form.email" id="email"
                                                        autocomplete="given-name"
                                                        class="block w-[95%] rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        placeholder="student@gmail.com">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div>
                                        <div class="mt-6 flex items-center justify-end gap-x-6 pr-5">
                                            <!-- <button type="button"
                                        class="text-sm font-semibold leading-6 text-gray-900 shadow-inner">Cancel</button> -->
                                            <!-- <button>
                                        <Link :href="route('dashboard')" :active="route().current('dashboard')"
                                            class="text-sm font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded">
                                        Cancel
                                        </Link>
                                    </button>
                                    <button type="submit"
                                        class="rounded-md bg-rc-java sm:px-10 sm:py-2 py-1 px-5 text-sm font-semibold text-white  hover:bg-rc-bondi-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:rc-bondi-blue2">Submit</button>
                                     -->
                                            <!-- <PrimaryButton :disabled="form.processing">Save</PrimaryButton> -->


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="p-6 sm:mt-12 lg:mt-12 flex items-center gap-x-6 justify-end lg:mr-16  sm:mr-20">
                            <button type="button"
                                class="text-sm font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded">
                                <Link :href="route('dashboard')" :active="route().current('dashboard')"> Cancel
                                </Link>
                            </button>
                            <button type="submit"
                                class="rounded-md bg-rc-java sm:px-10 sm:py-2 py-1 px-5 text-sm font-semibold text-white  hover:bg-rc-bondi-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:rc-bondi-blue2">Submit</button>
                        </div>
                    </div>
                </form>
            </div>






        </div>
    </AuthenticatedLayout>
</template>