<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavForPages from '@/Layouts/NavForPages.vue';
// import SavePopUp from '@/Components/SavePopUp.vue';
import UpdatePopUp from '@/Components/UpdatePopUp.vue'
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import axios from 'axios';
import SavePopUp from '@/Components/SavePopUp.vue';
import PopUp from '@/Components/PopUp.vue';
// import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline'

const saveOpen = ref(false);
const sportID = ref(0);
const updateOpen = ref(false);
// const popup = ref(true);
const saveTitile = ref('Add New Sport');
const updateTitile = ref('Edit Sport');
let loading = ref(false);


const props = defineProps({
    sports: {
        type: Array
    },//list of sports from sport_student with period
    sportList: {
        type: Array
    },//by all()
    student: {
        type: Object
    },
    achievements: {
        type: Array
    },
    message: {
        type: String
    }
})

const form1 = useForm({
    sport_id: "",
    period: ""
})

const form2 = useForm({
    sport_id: "",
    period: ""
})

const setIsOpen = async (popUpId) => {
    if (popUpId === 'savePopUp') {
        saveOpen.value = !saveOpen.value
        console.log(saveOpen);
    }
    else if (popUpId === 'updatePopUp') {
        updateOpen.value = !updateOpen.value
        console.log(updateOpen);
    }

}
const saveSportAndClose = async (popUpId) => {
    if (popUpId === 'savePopUp') {
        saveOpen.value = !saveOpen.value
        console.log(saveOpen);

        try {
            loading.value = true
            //const response = await axios.post(route('sport.store', { studentId: props.student.id }), form1);
            const response = await axios.post(route('sport.attach', { studentId: props.student.id }), form1);
            console.log(response, route('sport.attach', { studentId: props.student.id }), form1);
            //form1 = {};

            loading.value = false
            ////window.location.href = route('sport.index', { studentId: props.student.id });



        } catch (e) {
            console.log(e, "6");
            //console.log(e.response.status, 'status');
            // if (e.response.status === 422) {

            //     console.log(e.response.data.errors, "putError msg");
            // }
        }
    }
    // else if (popUpId === 'updatePopUp') {
    //     updateOpen.value = !updateOpen.value
    //     console.log(updateOpen);
    // }



}
const UpdateSportAndClose = async (popUpId, sport_id) => {
    console.log(form2, 'form Object');
    console.log(sport_id, 'test');
    if (popUpId == 'updatePopUp') {
        updateOpen.value = !updateOpen.value
        //console.log(updateOpen);



        try {
            //loading.value = true
            //const response = await axios.post(route('sport.store', { studentId: props.student.id }), form1);
            const response = await axios.put(route('sport.update', { studentId: props.student.id, sportId: sport_id }), form2);
            console.log(response, 'respose');
            //form1 = {};

            //loading.value = false
            //window.location.href = route('sport.index', { studentId: props.student.id });


        } catch (e) {
            console.log(e, "6");
            //console.log(e.response.status, 'status');
            // if (e.response.status === 422) {

            //     console.log(e.response.data.errors, "putError msg");
            // }
        }
    }
    // else if (popUpId === 'updatePopUp') {
    //     updateOpen.value = !updateOpen.value
    //     console.log(updateOpen);
    // }
}
const getSport = async (sportId) => {
    console.log(sportId, "getSportID from getSport");

    const response = await axios.get(route('sport.edit', { studentId: props.student.id, sportId: sportId }));
    form2.sport_id = response.data[0].pivot.sport_id;  // Use .value to update the ref
    form2.period = response.data[0].pivot.period;
    console.log(response);
    console.log(response.data, 'get sport');
    console.log(response.data[0].pivot.sport_id, 'get sportId from responce');
    console.log(response.data[0].pivot.period, 'period');

    const sportData = response.data; // Assuming the response contains the entire sport object

    // Accessing sport_name
    const sportName = sportData[0].sport_name;
    console.log(sportName); // Output the sport_name
    console.log(sportData[0]);



}


</script>

<template>

    <Head title="Add Union" />
    <AuthenticatedLayout>
        <div class="p-10">
            <div v-if="message" class="text-green-600">{{ message }}</div>

            <div class="grid grid-cols-2  sm:mb-10 px-8">
                <div class="col-span-1 justify-center m-4">
                    <div
                        class="p-4 rounded-lg shadow-sm hover:shadow-lg invisible  absolute sm:flex sm:visible sm:pt-0 sm:ml-6">
                        <p class="  pl-4 font-medium text-md text-gray-500  font-large">{{ student.first_name }}
                            {{ student.last_name }}
                            <br> {{ student.reg_no }}
                        </p>
                    </div>
                </div>
                <div class="col-span-1 justify-center items-center sm:ml-0    mt-10">
                    <h1 class="   font-semibold text-xl text-gray-800 leading-tight">Sport
                        Information</h1>
                </div>
            </div>
            <div>
            </div>
            <div class="px-8">
                <div class="border-2 border-gray-900/10 rounded-lg ml-2 my-2 p-4 shadow-inner hover:shadow-lg  pb-3">

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Sport Name</th>
                                <th scope="col" class="px-6 py-3">Period</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="sportDetail in student.sports"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">{{ sportDetail.sport_name }}</td>
                                <td class="px-6 py-4">
                                    {{ sportDetail.pivot.period }}
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="p-4 flex justify-center items-center  ml-3 my-2 px-3  pb-3">
                <div>
                    <h1 class="pl-16 font-semibold text-xl text-gray-800 leading-tight">Achievements</h1>
                </div>
            </div>
            <div class="  ">
                <div class="lg:flex">
                </div>
                <div class="px-8">
                    <div
                        class="border-2 border-gray-900/10 rounded-lg ml-2 my-2 p-4 shadow-inner hover:shadow-lg  pb-3">

                        <table
                            class="w-full  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Sport Name</th>
                                    <th scope="col" class="px-6 py-3">Achievement Name</th>
                                    <th scope="col" class="px-6 py-3">Achievement Date</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Achievement Type</th>
                                    <th scope="col" class="px-6 py-3">Age gap</th>
                                    <th scope="col" class="px-6 py-3">Achievement Level</th>
                                    <th scope="col" class="px-6 py-3">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="achievement in achievements "
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">

                                        <template v-for="sport in sportList ">
                                            <span v-if="achievement.sport_id == sport.id">
                                                {{ sport.sport_name }}
                                            </span>
                                        </template>
                                    </td>
                                    <td class="px-6 py-4">{{ achievement.achievement_name }}</td>
                                    <td class="px-6 py-4">{{ achievement.achievement_date }}</td>
                                    <td class="px-6 py-4">{{ achievement.achievement_status }}</td>
                                    <td class="px-6 py-4">{{ achievement.achievement_type }}</td>
                                    <td class="px-6 py-4">{{ achievement.age_gap }}</td>
                                    <td class="px-6 py-4">{{ achievement.achievement_level }}</td>
                                    <td class="px-6 py-4">{{ achievement.description }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 flex justify-end">
            <Link :href="route('dashboard')" :active="route().current('dashboard')"
                class="rounded-md bg-rc-java sm:px-10 sm:py-2 py-1 px-5 text-sm font-semibold text-white  hover:bg-rc-bondi-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:rc-bondi-blue2">
            back
            </Link>
        </div>
    </AuthenticatedLayout>
</template>