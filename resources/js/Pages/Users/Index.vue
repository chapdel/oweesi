<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>
        <div>
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4"
                    >
                        <t-table
                            :headers="[
                                { value: 'name', text: 'Name' },
                                { value: 'email', text: 'E-mail' },
                                {
                                    value: 'email_verified_at',
                                    text: 'Verified'
                                },
                                {
                                    value: 'created_at',
                                    text: 'Regislation Date'
                                }
                            ]"
                            :data="users"
                        >
                        </t-table>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    props: ["users"],

    components: {
        AppLayout
    }
};
</script>
