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

const cardTitle = ref<string>("Atividade importantissima!");
const cardDescription = ref<string>("Descrição da atividade");
const isOpen = ref<boolean>(false);

const props = defineProps<{
    columnId: number
}>();

const submit = () => {
    router.post('/cards', {
        title: cardTitle.value,
        column_id: props.columnId,
        description: cardDescription.value
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
            <Button class="w-full" variant="default">
                Adicionar um Cartão
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <DialogHeader>
                <DialogTitle>Adicionar Cartão</DialogTitle>
                <DialogDescription>
                    Crie um novo cartão para a coluna.
                </DialogDescription>
            </DialogHeader>
            <div class="grid gap-4 py-4">
                <div class="grid grid-cols-4 items-center gap-4">
                    <Label for="name" class="text-right">
                        Título
                    </Label>
                    <Input id="name" v-model="cardTitle" class="col-span-3" />
                </div>
                <div class="grid grid-cols-4 items-center gap-4">
                    <Label for="description" class="text-right">
                        Descrição
                    </Label>
                    <Input id="description" v-model="cardDescription" class="col-span-3" />
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
