<script setup lang="ts">
import AddColumnDialog from '@/components/AddColumnDialog.vue';
import Column from '@/components/Column.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import {
    type BreadcrumbItem
} from '@/types';
import {
    Head
} from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [{
    title: 'Board',
    href: '/board',
},];

defineProps<{
    board: {
        id: number,
        name: string
    },
    columns: Array<{
        id: number,
        title: string,
        cards: Array<{
            id: number,
            title: string,
            description: string,
            position: string
        }>,
    }>,
}>();
</script>

<template>

    <Head :title="board.name + ' - Board'" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="overflow-x-auto h-full p-4 flex justify-between">
                <Column v-for="col of columns" :key="col.id" :col="col" />
                <AddColumnDialog :boardId="board.id" />
            </div>
        </div>
    </AppLayout>
</template>
