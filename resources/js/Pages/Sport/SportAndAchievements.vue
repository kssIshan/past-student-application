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
        <NavForPages :student="student"> </NavForPages>
        <!-- {{ student.sports }}
        {{ student.sports[3].id }}
        {{ student.sports[3].pivot.sport_id }} -->

        <!-- {{ sports }} -->
        <div class="p-10">
            <div v-if="message" class="text-green-600">{{ message }}</div>

            <div class="grid grid-cols-2  sm:mb-10 px-8">
                <div class="col-span-1 justify-center m-4">
                    <div
                        class="p-4 rounded-lg shadow-sm hover:shadow-lg invisible  absolute sm:flex sm:visible sm:pt-0 sm:ml-6">
                        <p class="  pl-4 font-medium text-md text-gray-500  font-large">{{ student.first_name }} {{
                            student.last_name
                        }}
                            <br> {{
                                student.reg_no }}
                        </p>
                    </div>
                </div>
                <div class="col-span-1 justify-center items-center sm:ml-0    mt-10">

                    <h1 class="   font-semibold text-xl text-gray-800 leading-tight">Sport
                        Information</h1>

                </div>
            </div>
            <div>
                <!-- <SavePopUp @pop-up-cancel="setIsOpen('savePopUp')" @submit-and-close="saveSportAndClose('savePopUp')"
        :open="saveOpen" :title="saveTitile">
        <div>
            <div>
                <form action="#">
                    <div>
                        <label for="">Sport Name:</label>
                        <select
                            class="block w-[85%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            v-model="form1.sport_id">
                            <option v-for="sport in sportList" :value="sport.id">
                                {{ sport.sport_name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="">Period:</label>
                        <input
                            class="block w-[85%] rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                            type="text" v-model="form1.period" id="first-name" autocomplete="given-name">
                    </div>
                </form>
            </div>
        </div>
    </SavePopUp> -->
            </div>
            <PopUp :open="saveOpen">
                <div class="bg-blue-100 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class=" sm:items-start">

                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">
                                Add Sport
                            </DialogTitle>
                            <div class=" mt-2">

                                <div class="sm:col-span-3">
                                    <form action="#">
                                        <div>
                                            <label for="">Sport Name:</label>
                                            <select
                                                class="block w-[85%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                v-model="form1.sport_id">
                                                <option v-for="sport in sportList" :value="sport.id">
                                                    {{ sport.sport_name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="">Period:</label>
                                            <input
                                                class="block w-[85%] rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                type="text" v-model="form1.period" id="first-name"
                                                autocomplete="given-name">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-100 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button"
                        class="float-right text-white mr-16 bg-rc-bondi-blue hover:bg-rc-bondi-blue2  font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 focus:outline-non"
                        @click="saveSportAndClose('savePopUp')">save</button>
                    <button type="button"
                        class="text-sm float-right font-semibold leading-6 text-gray-900 shadow-inner  px-5 me-2 mb-2  border-2 border-rc-java py-1 rounded"
                        @click="setIsOpen('savePopUp')" ref="cancelButtonRef">Cancel</button>
                </div>
            </PopUp>

            <div class="flex items-end justify-end p-4 mb-6" @click="saveOpen = true">
                <div>
                    <button
                        class="text-sm  float-right font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                        type="button">Add New Sport</button>

                </div>
            </div>


            <div class="px-8">
                <div class="border-2 border-gray-900/10 rounded-lg ml-2 my-2 p-4 shadow-inner hover:shadow-lg  pb-3">

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Sport Name</th>
                                <th scope="col" class="px-6 py-3">Period</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="sportDetail in student.sports"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">{{ sportDetail.sport_name }}</td>
                                <td class="px-6 py-4">
                                    <!-- <template v-for="sport in sports">
                        <template v-if="sportDetail.pivot.sport_id == sport.sport_id">
                            {{ sport.period }}
                        </template>

                    </template> -->
                                    <!-- {{ sportDetail.pivot.period }} -->
                                    {{ sportDetail.pivot.period }}
                                </td>
                                <td class="flex items-center px-6 py-4">

                                    <!-- <Link :href="route('exam.showresult', { studentId: student.id, examId: exam.id })" method="get"                        as="button"> -->
                                    <!-- <p class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        Result </p> -->
                                    <!-- </Link> -->

                                    <!-- <Link :href="route('exam.edit', { studentId: student.id, examId: exam.id })" method="get"         as="button"> -->
                                    <!-- <PopUp @pop-up-cancel="setIsOpen(updateOpen)" @submit-and-close="saveSportAndClose(updateOpen)"
                        :open="updateOpen" :title="popUpTitile">

                    </PopUp> -->
                                    <!-- <UpdatePopUp :sportId="sportDetail.pivot.sport_id" @pop-up-cancel="setIsOpen('updatePopUp')"
                        @update-and-close="UpdateSportAndClose('updatePopUp')" :open="updateOpen"
                        :title="updateTitile">

                    </UpdatePopUp> -->
                                    <PopUp :open="updateOpen">
                                        <div class="bg-blue-100 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                            <div class=" sm:items-start">

                                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                    <DialogTitle as="h3"
                                                        class="text-base font-semibold leading-6 text-gray-900">
                                                        Edit SPort
                                                    </DialogTitle>
                                                    <div class="mt-2">
                                                        <div>
                                                            <div>
                                                                <form>
                                                                    <div>
                                                                        <label for="">Sport Name:</label>
                                                                        <select
                                                                            class="block w-[85%]  rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                                            v-model="form2.sport_id">
                                                                            <option v-for="sport in sportList"
                                                                                :value="sport.id">
                                                                                {{ sport.sport_name }}
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div>
                                                                        <label for="">Period:</label>
                                                                        <input
                                                                            class="block w-[85%] rounded-md border-0 py-1.5 text-gray-900 ring-1 sm:my-5 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rc-java sm:text-sm sm:leading-6"
                                                                            type="text" v-model="form2.period"
                                                                            id="first-name" autocomplete="given-name">
                                                                    </div>
                                                                    <!-- <div>{{ sportDetail.id }}</div> -->
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-blue-100 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                            <button type="button"
                                                class="float-right text-white mr-16 bg-rc-bondi-blue hover:bg-rc-bondi-blue2  font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 focus:outline-non"
                                                @click="UpdateSportAndClose('updatePopUp', sportDetail.id)">Update</button>
                                            <button type="button"
                                                class="text-sm float-right font-semibold leading-6 text-gray-900 shadow-inner  px-5 me-2 mb-2  border-2 border-rc-java py-1 rounded"
                                                @click="setIsOpen('updatePopUp')" ref="cancelButtonRef">Cancel</button>

                                        </div>
                                    </PopUp>
                                    <button class="p-2" @click="updateOpen = true, getSport(sportDetail.id)">
                                        <a href="#"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><svg
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_626_412)">
                                                    <path
                                                        d="M20.71 7.04006C21.1 6.65006 21.1 6.00006 20.71 5.63006L18.37 3.29006C18 2.90006 17.35 2.90006 16.96 3.29006L15.12 5.12006L18.87 8.87006M3 17.2501V21.0001H6.75L17.81 9.93006L14.06 6.18006L3 17.2501Z"
                                                        fill="#92DD32" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_626_412">
                                                        <rect width="24" height="24" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </button>

                                    <!-- </Link> -->
                                    <Link :href="route('sport.destroy', { studentId: student.id, sportId: sportDetail.id })"
                                        method="delete" as="button">
                                    <p class="font-medium p-2 text-red-600 dark:text-red-500 hover:underline ms-3"><svg
                                            width="15" height="18" viewBox="0 0 15 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.5 1H11L10 0H5L4 1H0.5V3H14.5M1.5 16C1.5 16.5304 1.71071 17.0391 2.08579 17.4142C2.46086 17.7893 2.96957 18 3.5 18H11.5C12.0304 18 12.5391 17.7893 12.9142 17.4142C13.2893 17.0391 13.5 16.5304 13.5 16V4H1.5V16Z"
                                                fill="#FF6868" />
                                        </svg>
                                    </p>
                                    </Link>

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
                    <!-- <p class=" font-medium pl-14 text-md text-gray-500 text-xs font-large">
        {{ student.first_name }} {{ student.last_name }} <br> {{
            student.reg_no }}
    </p> -->

                    <div class="lg:flex-1">
                        <button type=" button"
                            class="float-right text-white mr-16 bg-rc-bondi-blue hover:bg-rc-bondi-blue2  font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 focus:outline-non">

                            <Link :href="route('achievement.create', { studentId: student.id })" method="get" as="button">
                            Add New Achievement</Link>

                        </button>
                    </div>

                </div>
                <div class="px-8">
                    <div class="border-2 border-gray-900/10 rounded-lg ml-2 my-2 p-4 shadow-inner hover:shadow-lg  pb-3">

                        <table class="w-full  text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Sport Name</th>
                                    <th scope="col" class="px-6 py-3">Achievement Name</th>
                                    <th scope="col" class="px-6 py-3">Achievement Date</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Achievement Type</th>
                                    <th scope="col" class="px-6 py-3">Age gap</th>
                                    <th scope="col" class="px-6 py-3">Achievement Level</th>
                                    <th scope="col" class="px-6 py-3">Description</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
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
                                            <!-- <span v-else>---</span> -->
                                        </template>
                                    </td>
                                    <td class="px-6 py-4">{{ achievement.achievement_name }}</td>
                                    <td class="px-6 py-4">{{ achievement.achievement_date }}</td>
                                    <td class="px-6 py-4">{{ achievement.achievement_status }}</td>
                                    <td class="px-6 py-4">{{ achievement.achievement_type }}</td>
                                    <td class="px-6 py-4">{{ achievement.age_gap }}</td>
                                    <td class="px-6 py-4">{{ achievement.achievement_level }}</td>
                                    <td class="px-6 py-4">{{ achievement.description }}</td>


                                    <td class="flex items-center px-6 py-4">

                                        <!-- <Link :href="route('exam.showresult', { studentId: student.id, examId: exam.id })" method="get"                        as="button"> -->
                                        <!-- <p class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
            Result </p> -->
                                        <!-- </Link> -->

                                        <Link
                                            :href="route('achievement.edit', { studentId: student.id, achievementId: achievement.id })"
                                            method="get" as="button">
                                        <a href="#"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><svg
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_626_412)">
                                                    <path
                                                        d="M20.71 7.04006C21.1 6.65006 21.1 6.00006 20.71 5.63006L18.37 3.29006C18 2.90006 17.35 2.90006 16.96 3.29006L15.12 5.12006L18.87 8.87006M3 17.2501V21.0001H6.75L17.81 9.93006L14.06 6.18006L3 17.2501Z"
                                                        fill="#92DD32" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_626_412">
                                                        <rect width="24" height="24" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        </Link>
                                        <Link
                                            :href="route('achievement.destroy', { studentId: student.id, achievementId: achievement.id })"
                                            method="delete" as="button">
                                        <p class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><svg
                                                width="15" height="18" viewBox="0 0 15 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14.5 1H11L10 0H5L4 1H0.5V3H14.5M1.5 16C1.5 16.5304 1.71071 17.0391 2.08579 17.4142C2.46086 17.7893 2.96957 18 3.5 18H11.5C12.0304 18 12.5391 17.7893 12.9142 17.4142C13.2893 17.0391 13.5 16.5304 13.5 16V4H1.5V16Z"
                                                    fill="#FF6868" />
                                            </svg>
                                        </p>
                                        </Link>

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


            <!-- <div>{{ student.sports }}</div> -->
            <!-- <div v-for="sportDetail in student.sports">
    <div>{{ sportDetail.sport_name }}</div>
    <div v-for="sport in sports">
        <div v-if="sportDetail.pivot.sport_id == sport.sport_id">
            {{ sport.period }}
        </div>
    </div>
</div> -->
            <!-- <div>{{ sports }}</div> -->
        </div>
    </AuthenticatedLayout>
</template>