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

import { Plus } from "lucide-vue-next";

const boardName = ref<string>("Atividade importantissima!");
const isOpen = ref<boolean>(false);

const props = defineProps<{
    userId: number
}>();

const creating = ref(false);

const submit = () => {
    router.post('/boards', {
        name: boardName.value,
        user_id: props.userId
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
            <button
                class="flex items-center gap-2 w-full px-3 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/80 transition"
                @click="creating = true">
                <Plus class="w-4 h-4" />
                Nova Board
            </button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <DialogHeader>
                <DialogTitle>Criar Quadro</DialogTitle>
                <DialogDescription>
                    Crie um novo quadro.
                </DialogDescription>
            </DialogHeader>
            <div class="grid gap-4 py-4">
                <div class="grid grid-cols-4 items-center gap-4">
                    <Label for="name" class="text-right">
                        Nome
                    </Label>
                    <Input id="name" v-model="boardName" class="col-span-3" />
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
