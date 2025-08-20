<script setup lang="ts">
import AddCardDialog from '@/components/AddCardDialog.vue';
import {
    defineProps
} from 'vue';
import CoulumnCard from './CoulumnCard.vue';
import NoCardsWarn from './NoCardsWarn.vue';

defineProps<{
    col: {
        id: number;
        title: string;
        cards: Array<{
            id: number;
            title: string;
            description: string;
            position: string;
        }>;
    };
}>();
</script>

<template>
    <div class="min-w-[250px] max-w-[250px] min-h-[120px] flex flex-col m-2 mt-0 rounded-xl border border-sidebar-border/70 bg-sidebar"
        :key="col.id">
        <p class="p-4 pb-0 text-lg font-semibold text-sidebar-text">
            {{ col.title }}
        </p>

        <div v-if="col.cards.length > 0" class="overflow-y-auto p-2 space-y-2 max-h-[calc(100vh-200px)]">
            <CoulumnCard v-for="card of col.cards" :key="card.id" :card="card" />
        </div>

        <NoCardsWarn v-else></NoCardsWarn>

        <div class="p-4 mt-auto">
            <AddCardDialog :title="col.title" :columnId="col.id" />
        </div>
    </div>
</template>
