<script lang="ts" setup>
// import {
//     Button
// } from "@/components/ui/button"
import {
    Dialog,
    DialogContent,
    DialogDescription,
    // DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog"
// import {
//     Input
// } from "@/components/ui/input"
// import {
//     Label
// } from "@/components/ui/label"
import { ref } from "vue";

const isOpen = ref<boolean>(false);

const props = defineProps<{
    card: {
        id: number;
        title: string;
        description: string;
        position: string;
    };
}>();
</script>

<template>

    <Dialog v-model:open="isOpen">
        <DialogTrigger as-child>
            <div class="mt-4 p-6 rounded-xl cursor-pointer border border-sidebar-border/70">
                {{ props.card.title }}
            </div>
            <!-- <Button variant="default">
                Adicionar um Cartão
            </Button> -->
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <DialogHeader>
                <DialogTitle>{{ props.card.title }}</DialogTitle>
                <DialogDescription>
                    {{ props.card.description || "Esse cartão não posssui descrição." }}
                </DialogDescription>
            </DialogHeader>
            <!-- <div class="grid gap-4 py-4">
                <div class="grid grid-cols-4 items-center gap-4">
                    <Label for="name" class="text-right">
                        Título
                    </Label>
                    <Input id="name" v-model="cardTitle" class="col-span-3" />
                </div>
            </div> -->
            <!-- <DialogFooter>
                <Button type="submit" @click="submit">
                    Adicionar
                </Button>
            </DialogFooter> -->
        </DialogContent>
    </Dialog>
</template>