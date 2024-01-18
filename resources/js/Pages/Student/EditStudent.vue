<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
const props = defineProps({
    student: {
        type: Object
    }
});

const form = useForm({
    first_name: props.student.first_name,
    last_name: props.student.last_name,
    dob: props.student.dob,
    //shedule_date: new Date().toISOString().split('T')[0],
    date_of_admission: props.student.date_of_admission,
    date_of_leave: props.student.date_of_leave,
    address: props.student.address,
    email: props.student.email,
    mobile_no: props.student.mobile_no,
    land_no: props.student.land_no,

});

</script>
<template>
    <AuthenticatedLayout>
        {{ student }}
        <div>
            <form @submit.prevent="form.put(route('student.update', { studentId: student.id }))" class="mt-6 space-y-6">

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div>
                                <InputLabel for="last_name" value="Fast Name" />
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
                                <PrimaryButton :disabled="form.processing">Update</PrimaryButton>
                                <!-- <button>Update</button> -->
                                <!-- <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Updated.</p>
                        </Transition>
                        <Link as="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            :href="route('post.postlist')">Back</Link> -->
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>