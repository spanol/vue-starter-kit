<script setup lang="ts">
import {
    Button
} from "@/components/ui/button"
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog"
import {
    Input
} from "@/components/ui/input"
import {
    Label
} from "@/components/ui/label"

import {
    router
} from '@inertiajs/vue3';
import {
    ref
} from "vue";

const columnTitle = ref<string>("Coluna de prioridades");
const isOpen = ref<boolean>(false);

const props = defineProps<{
    boardId: number
}>();


const submit = () => {
    router.post('/columns', {
        title: columnTitle.value,
        board_id: props.boardId
    }, {
        onSuccess: () => {
            isOpen.value = false;
        },

        onError: (error) => {
            console.error(error);
        }
    });
};
</script>

<template>

    <Dialog v-model:open="isOpen">
        <DialogTrigger as-child>
            <Button variant="outline">
                Adicionar nova coluna
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <DialogHeader>
                <DialogTitle>Adicionar Coluna</DialogTitle>
                <DialogDescription>
                    Crie uma nova coluna.
                </DialogDescription>
            </DialogHeader>
            <div class="grid gap-4 py-4">
                <div class="grid grid-cols-4 items-center gap-4">
                    <Label for="name" class="text-right">
                        Título
                    </Label>
                    <Input id="name" v-model="columnTitle" class="col-span-3" />
                </div>
            </div>
            <DialogFooter>
                <Button type="submit" @click="submit">
                    Adicionar
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
