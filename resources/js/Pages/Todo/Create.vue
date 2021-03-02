<template>
    <modal :show="show" @toggle="$emit('toggle')">
        <template v-slot:title>
            Create New Todo
        </template>

        <form @submit.prevent="submit">
            <label for="first_name">Title:</label><br/>
            <input id="first_name" type="text" v-model="form.title" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"/>
        </form>

        <template v-slot:footer>
            <button
                class="text-green-500 bg-transparent border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1"
                type="button" style="transition: all .15s ease" @click="submit">
                SAVE
            </button>
        </template>
    </modal>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import BButton from "@/Components/Button";
    import Modal from "@/Components/Modal";

    export default {
        props: {
            show: {
                type: Boolean,
                default: false,
            },

            todos: {
                type: Array,
                default() {
                    return [];
                }
            }
        },

        emits: ['toggle'],

        data() {
            return {
                showModal: false,

                form:{
                    title: "",
                }
            };
        },

        methods: {
            submit() {
                this.$emit('toggle');
                this.$inertia.post(route('todos.store'), this.form);
            },
        },

        components: {
            Modal,
            BButton,
        },
    }
</script>
