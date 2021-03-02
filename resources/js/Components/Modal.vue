<template>
    <div>
        <div v-if="show"
             class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
            <div class="relative w-auto my-6 mx-auto max-w-6xl">
                <!--content-->
                <div
                    class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t">
                        <h3 class="text-3xl font-semibold">
                            <slot name="title" />
                            <button
                                class="p-1 ml-auto bg-transparent border-0 text-black text-3xl leading-none font-semibold outline-none focus:outline-none"
                                @click="toggleModal()"
                            >
                                <span class="bg-transparent text-black hover:text-red-600 h-6 w-6 text-5xl block outline-none focus:outline-none"
                                      style="transition: all .5s ease"
                                >
                                    ×
                                </span>
                            </button>
                        </h3>

                    </div>
                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        <slot />
                    </div>
                    <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b">
                        <slot name="footer" />
                    </div>
                </div>
            </div>
        </div>
        <div v-if="show" @click="toggleModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
</template>

<script>
    export default {

        props: {
            show: {
                type: Boolean,
                default: false,
            },

            hasSave: {
                type: Boolean,
                default: false,
            },
        },

        emits: ['toggle'],

        methods: {
            toggleModal: function () {
                this.$emit("toggle");
            }
        },
    }
</script>
