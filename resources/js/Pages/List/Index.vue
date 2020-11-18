<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                List
                <a
                    :href="route('lists.create')"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 float-right"
                    >Add new list</a
                >
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
                                { value: 'title', text: 'Title' },
                                { value: 'uid', text: 'ID' },
                                {
                                    value: 'contacts_nb',
                                    text: 'Subscribers',
                                    className: 'text-center'
                                }
                            ]"
                            :data="lists"
                        >
                            <template slot="row" slot-scope="props">
                                <tr :class="props.trClass">
                                    <a
                                        :href="
                                            route('lists.show', props.row.uid)
                                        "
                                        class="block"
                                    >
                                        <td :class="props.tdClass">
                                            {{ props.row.title }}
                                        </td>
                                    </a>
                                    <td :class="props.tdClass">
                                        {{ props.row.uid }}
                                    </td>
                                    <td
                                        :class="props.tdClass"
                                        class="text-center"
                                    >
                                        {{ props.row.contacts_nb }}
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
    props: ["lists"],

    components: {
        AppLayout
    }
};
</script>
