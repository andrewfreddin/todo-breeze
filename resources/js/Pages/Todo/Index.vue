<template>
    <breeze-authenticated-layout>
        <create-todo :show="showModal" @toggle="showModal = !showModal" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Stuff I Need To Do
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <button @click="showModal = !showModal"
                            class="float-right mt-3 mr-2 text-green-500 bg-transparent border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1"
                            type="button"
                            style="transition: all .15s ease">
                        Create New Todo
                    </button>
                    <div class="p-6 bg-white border-b border-gray-200">
                        My Todos
                    </div>
                    <div v-if="todos.length > 0" class="p-6 bg-white border-b border-gray-200" v-for="todo in todos">
                        {{ todo.title}}
                        <inertia-link
                            class="float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                            :href="'/todos/' + todo.id + '/done'"
                            method="patch"
                            as="button"
                            type="button">
                                DONE
                        </inertia-link>
                    </div>
                    <div v-else class="p-6 bg-white border-b border-gray-200">
                        You don't have any pending Todos!
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import BButton from "@/Components/Button";
    import CreateTodo from "@/Pages/Todo/Create";
    import Chart from "@/Components/Chart";

    export default {
        props:{
          todos: {
              type: Array,
              default(){ return []; }
          }
        },

        data() {
            return {
                showModal: false,
            };
        },

        components: {
            BButton,
            BreezeAuthenticatedLayout,
            CreateTodo,
            Chart
        },
    }
</script>
