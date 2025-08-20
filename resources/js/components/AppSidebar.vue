<script setup lang="ts">
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem
} from '@/components/ui/sidebar';

import { Link } from '@inertiajs/vue3';
import { LayoutGrid, Plus } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { ref } from 'vue';

defineProps<{
    boards: Array<{ id: number; name: string }>;
}>();

const creating = ref(false);
// const newBoardName = ref("");

// Criação da board
// const createBoard = async () => {
//     if (!newBoardName.value.trim()) return;

//     router.post('/boards', { name: newBoardName.value }, {
//         onSuccess: () => {
//             newBoardName.value = "";
//             creating.value = false;
//         }
//     });
// };
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <!-- LOGO -->
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                        <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <!-- CONTEÚDO -->
        <SidebarContent>
            <div class="px-3 py-2">
                <p class="text-sm font-semibold text-gray-400 mb-2">Suas Boards</p>

                <SidebarMenu>
                    <SidebarMenuItem v-for="board in boards" :key="board.id">
                        <SidebarMenuButton as-child>
                            <Link :href="route('boards.show', board.id)">
                            <LayoutGrid class="mr-2 h-4 w-4" />
                            {{ board.name }}
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </div>

            <!-- BOTÃO DE CRIAR NOVA BOARD -->
            <div class="px-3 mt-4">
                <button
                    class="flex items-center gap-2 w-full px-3 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/80 transition"
                    @click="creating = true">
                    <Plus class="w-4 h-4" />
                    Nova Board
                </button>
            </div>
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>

    <slot />


</template>
