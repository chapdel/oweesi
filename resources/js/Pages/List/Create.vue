<template>
    <app-layout>
        <template #backlink>
            <a
                :href="route('lists')"
                class="text-xs text-gray-600 flex flex-row"
                ><svg
                    class="w-4 h-4 mr-1"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    ></path>
                </svg>
                <span>Lists</span></a
            >
        </template>
        <template #header>
            <h2 class="font-semibold text-base text-gray-800 leading-tight">
                New List
            </h2>
        </template>
        <div>
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <jet-form-section @submitted="createList">
                        <template #title>
                            Create new list
                        </template>

                        <template #description>
                            Provide information of your new list.
                        </template>

                        <template #form>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="password" value="Title" />
                                <jet-input
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.title"
                                />
                                <jet-input-error
                                    :message="form.error('password')"
                                    class="mt-2"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <jet-label
                                    for="description"
                                    value="Description"
                                />
                                <textarea
                                    class="mt-1 block form-input rounded-md shadow-sm w-full"
                                    v-model="form.description"
                                    rows="3"
                                ></textarea>
                            </div>
                        </template>

                        <template #actions>
                            <jet-action-message
                                :on="form.recentlySuccessful"
                                class="mr-3"
                            >
                                Saved.
                            </jet-action-message>

                            <jet-button
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Save
                            </jet-button>
                        </template>
                    </jet-form-section>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {
    components: {
        AppLayout,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel
    },
    data() {
        return {
            form: this.$inertia.form(
                {
                    title: "",
                    description: ""
                },
                {
                    bag: "createList",
                    resetOnSuccess: true
                }
            )
        };
    },
    methods: {
        createList() {
            this.form
                .post(route("lists.store"), {
                    preserveScroll: true
                })
                .then(() => {
                    //this.$refs.current_password.focus()
                });
        }
    }
};
</script>
