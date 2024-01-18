<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
//import NavForPages from '@/Layouts/NavForPages.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
//import TextInput from '@/Components/TextInput.vue';


const form = useForm({
    reg_no: "",
    first_name: "",
    last_name: "",
    dob: '',
    //shedule_date: new Date().toISOString().split('T')[0],
    date_of_admission: '',
    date_of_leave: '',
    address: "",
    email: "",
    mobile_no: 0,
    land_no: 0,

});
</script>

<template>
    <Head title="Add Student" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Student</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Add Student</div>
                    <form @submit.prevent="form.post(route('student.store'))" class="mt-6 space-y-6">

                        <div>
                            <InputLabel for="reg_no" value="Registration no" />
                            <input type="text" id="reg_no" v-model="form.reg_no" />
                            <InputError class="mt-2" :message="form.errors.reg_no" />
                        </div>
                        <div>
                            <InputLabel for="firstName" value="Fast Name" />
                            <input type="text" id="firstName" v-model="form.first_name" />
                            <InputError class="mt-2" :message="form.errors.first_name" />
                        </div>
                        <div>
                            <InputLabel for="last_name" value="Last Name" />
                            <input type="text" v-model="form.last_name">
                            <InputError class="mt-2" :message="form.errors.last_name" />
                        </div>
                        <div>
                            <InputLabel for="dob" value="Date of Birth" />
                            <input type="date" v-model="form.dob">
                            <InputError class="mt-2" :message="form.errors.dob" />
                        </div>
                        <div>
                            <InputLabel for="date_of_admission" value="Admission date" />
                            <input type="date" v-model="form.date_of_admission">
                            <InputError class="mt-2" :message="form.errors.date_of_admission" />
                        </div>
                        <div>
                            <InputLabel for="date_of_leave" value="Pass Out Date" />
                            <input type="date" v-model="form.date_of_leave">
                            <InputError class="mt-2" :message="form.errors.date_of_leave" />
                        </div>
                        <div>
                            <InputLabel for="address" value="Address" />
                            <input type="text" v-model="form.address">
                            <InputError class="mt-2" :message="form.errors.address" />
                        </div>
                        <div>
                            <InputLabel for="email" value="Email" />
                            <input type="text" v-model="form.email">
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div>
                            <InputLabel for="mobile_no" value="Mobile No" />
                            <input type="text" v-model="form.mobile_no">
                            <InputError class="mt-2" :message="form.errors.mobile_no" />
                        </div>
                        <div>
                            <InputLabel for="land_no" value="Land No" />
                            <input type="text" v-model="form.land_no">
                            <InputError class="mt-2" :message="form.errors.land_no" />
                        </div>



                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                            <!-- <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                            </Transition> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
