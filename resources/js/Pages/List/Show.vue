<template>
    <app-layout>
        <template #backlink>
            <a :href="route('lists')">List</a>
        </template>
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
                                { value: 'email', text: 'E-mail' },
                                {
                                    value: 'status',
                                    text: 'Status',
                                    className: 'text-center'
                                },
                                {
                                    value: 'created_at',
                                    text: 'Date',
                                    className: 'text-right'
                                }
                            ]"
                            :data="contacts"
                        >
                            <template slot="row" slot-scope="props">
                                <tr :class="props.trClass">
                                    <td :class="props.tdClass">
                                        {{ props.row.email }}
                                    </td>
                                    <td
                                        :class="props.tdClass"
                                        class="text-center"
                                    >
                                        {{ props.row.status }}
                                    </td>
                                    <td
                                        :class="props.tdClass"
                                        class="text-right"
                                    >
                                        {{ props.row.created_at }}
                                    </td>
                                    <!-- <td
                                        :class="props.tdClass"
                                        class="text-right"
                                    >
                                        <a href="" class="block text-right">
                                            <t-button variant="secondary"
                                                >Edit</t-button
                                            >
                                        </a>
                                    </td> -->
                                </tr>
                            </template>
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
    props: ["contacts", "list"],

    components: {
        AppLayout
    }
};
</script>
