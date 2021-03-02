<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Todo index
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        THIS IS THE TODO INDEX
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200" v-for="todo in todos">
                        {{ todo.title}}
                        <inertia-link
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                            :href="'/todos/' + todo.id + '/done'" method="patch" as="button" type="button">DONE</inertia-link>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import BButton from "@/Components/Button";

    export default {
        props:{
          todos: {
              type: Array,
              default(){ return []; }
          }
        },
        components: {
            BreezeAuthenticatedLayout,
            BButton,
        },
    }
</script>
