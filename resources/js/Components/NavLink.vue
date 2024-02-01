<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? ' inline-flex  px-1 pt-1 border-b-2 border-rc-bondi-blue2 text-sm  leading-5 text-white     bg-rc-bondi-blue2     font-medium'
        : 'inline-flex  px-1 pt-1 border-b-2 border-transparent text-sm  leading-5 text-white font-bold hover:text-white hover:bg-rc-bondi-blue2 focus:outline-none focus:text-gray-700  transition duration-150 ease-in-out     px-3 py-2 text-xs font-large'
);
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
