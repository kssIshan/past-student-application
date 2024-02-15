<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
// import { ref } from 'vue'
import PopUp from './PopUp.vue';
// const open = ref(true)
// const setIsOpen = async () => {
//     open.value = !open.value
//     console.log(open);
// }
// const submitAndClose = async () => {
//     open.value = !open.value
//     console.log(open);


// }
const props = defineProps({
    title: {
        type: String
    },
    open: {
        type: Boolean
    },
    sportId: {
        type: Number
    }
})
</script>
<template>
    <PopUp :open="open">
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class=" sm:items-start">

                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">
                        {{ title }}
                    </DialogTitle>
                    <div class="mt-2">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button type="button"
                class="float-right text-white mr-16 bg-rc-bondi-blue hover:bg-rc-bondi-blue2  font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 focus:outline-non"
                @click="$emit('UpdateAndClose', sportId)">Update</button>
            <button type="button"
                class="text-sm float-right font-semibold leading-6 text-gray-900 shadow-inner sm:px-10 px-5 border-2 border-rc-java py-1 rounded"
                @click="$emit('popUpCancel')" ref="cancelButtonRef">Cancel</button>

        </div>
    </PopUp>
</template>