<script setup lang="ts">
interface Board {
    id: number;
    name: string;
}

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
import { Link, usePage } from '@inertiajs/vue3';
import { LayoutGrid, Plus } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { onMounted } from 'vue';
import { useFetch } from '@/hooks/useFetch';

const page = usePage();
const authUser = page.props.auth?.user;

const {
    data: boards,
    fetchData: fetchBoards,
    loading,
    error,
} = useFetch<Board[]>(`/api/user/${authUser?.id}/boards`);

onMounted(fetchBoards);
console.log('Boards:', boards);
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

        <SidebarContent>
            <div class="px-3 py-2">
                <p class="text-sm font-semibold text-gray-400 mb-2">Suas Boards</p>

                <!-- Loading state -->
                <div v-if="loading" class="text-gray-400 text-sm">Carregando boards...</div>

                <!-- Erro -->
                <div v-else-if="error" class="text-red-500 text-sm">Erro ao carregar boards.</div>

                <!-- Lista -->
                <SidebarMenu v-else>
                    <SidebarMenuItem v-for="board in boards" :key="board.id">
                        <SidebarMenuButton as-child>
                            <Link :href="`/board/${board.id}`">
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
                    class="flex items-center gap-2 w-full px-3 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/80 transition">
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
