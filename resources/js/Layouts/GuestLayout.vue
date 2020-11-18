<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100" v-if="0 == 1">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <inertia-link
                                :href="route('dashboard')"
                                class="flex flex-row"
                            >
                                <jet-application-mark
                                    class="block h-9 w-auto"
                                />
                                <span
                                    class="text-2xl font-semibold ml-2 text-indigo-700"
                                    >Notch Relay</span
                                >
                            </inertia-link>
                        </div>

                        <!-- Navigation Links -->
                        <div
                            class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                        >
                            <!-- <jet-nav-link
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                            >
                                Dashboard
                            </jet-nav-link>
                            <jet-nav-link
                                :href="route('users')"
                                :active="route().current('users')"
                            >
                                Users
                            </jet-nav-link>
                            <jet-nav-link
                                :href="route('lists')"
                                :active="route().current('lists')"
                            >
                                Lists
                            </jet-nav-link> -->
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div
                        class="hidden sm:flex sm:items-center sm:ml-6"
                        v-if="$page.user"
                    >
                        <div class="ml-3 relative">
                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button
                                        v-if="
                                            $page.jetstream.managesProfilePhotos
                                        "
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out"
                                    >
                                        <img
                                            class="h-8 w-8 rounded-full object-cover"
                                            :src="$page.user.profile_photo_url"
                                            :alt="$page.user.name"
                                        />
                                    </button>

                                    <button
                                        v-else
                                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                                    >
                                        <div>{{ $page.user.name }}</div>

                                        <div class="ml-1">
                                            <svg
                                                class="fill-current h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </div>
                                    </button>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div
                                        class="block px-4 py-2 text-xs text-gray-400"
                                    >
                                        Manage Account
                                    </div>

                                    <jet-dropdown-link
                                        :href="route('profile.show')"
                                    >
                                        Profile
                                    </jet-dropdown-link>

                                    <jet-dropdown-link
                                        :href="route('api-tokens.index')"
                                        v-if="$page.jetstream.hasApiFeatures"
                                    >
                                        API Tokens
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Management -->
                                    <template
                                        v-if="$page.jetstream.hasTeamFeatures"
                                    >
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400"
                                        >
                                            Manage Team
                                        </div>

                                        <!-- Team Settings -->
                                        <jet-dropdown-link
                                            :href="
                                                route(
                                                    'teams.show',
                                                    $page.user.current_team
                                                )
                                            "
                                        >
                                            Team Settings
                                        </jet-dropdown-link>

                                        <jet-dropdown-link
                                            :href="route('teams.create')"
                                            v-if="
                                                $page.jetstream.canCreateTeams
                                            "
                                        >
                                            Create New Team
                                        </jet-dropdown-link>

                                        <div
                                            class="border-t border-gray-100"
                                        ></div>

                                        <!-- Team Switcher -->
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400"
                                        >
                                            Switch Teams
                                        </div>

                                        <template
                                            v-for="team in $page.user.all_teams"
                                        >
                                            <form
                                                @submit.prevent="
                                                    switchToTeam(team)
                                                "
                                                :key="team.id"
                                            >
                                                <jet-dropdown-link as="button">
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <svg
                                                            v-if="
                                                                team.id ==
                                                                    $page.user
                                                                        .current_team_id
                                                            "
                                                            class="mr-2 h-5 w-5 text-green-400"
                                                            fill="none"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                            ></path>
                                                        </svg>
                                                        <div>
                                                            {{ team.name }}
                                                        </div>
                                                    </div>
                                                </jet-dropdown-link>
                                            </form>
                                        </template>

                                        <div
                                            class="border-t border-gray-100"
                                        ></div>
                                    </template>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Logout
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown = !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex': !showingNavigationDropdown
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex': showingNavigationDropdown
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                v-if="$page.user"
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown
                }"
                class="sm:hidden"
            >
                <div class="pt-2 pb-3 space-y-1">
                    <!-- <jet-responsive-nav-link
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                    >
                        Dashboard
                    </jet-responsive-nav-link> -->
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <img
                                class="h-10 w-10 rounded-full"
                                :src="$page.user.profile_photo_url"
                                :alt="$page.user.name"
                            />
                        </div>

                        <div class="ml-3">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ $page.user.email }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <jet-responsive-nav-link
                            :href="route('profile.show')"
                            :active="route().current('profile.show')"
                        >
                            Profile
                        </jet-responsive-nav-link>

                        <jet-responsive-nav-link
                            :href="route('api-tokens.index')"
                            :active="route().current('api-tokens.index')"
                            v-if="$page.jetstream.hasApiFeatures"
                        >
                            API Tokens
                        </jet-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <jet-responsive-nav-link as="button">
                                Logout
                            </jet-responsive-nav-link>
                        </form>

                        <!-- Team Management -->
                        <template v-if="$page.jetstream.hasTeamFeatures">
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Manage Team
                            </div>

                            <!-- Team Settings -->
                            <jet-responsive-nav-link
                                :href="
                                    route('teams.show', $page.user.current_team)
                                "
                                :active="route().current('teams.show')"
                            >
                                Team Settings
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link
                                :href="route('teams.create')"
                                :active="route().current('teams.create')"
                            >
                                Create New Team
                            </jet-responsive-nav-link>

                            <div class="border-t border-gray-200"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Switch Teams
                            </div>

                            <template v-for="team in $page.user.all_teams">
                                <form
                                    @submit.prevent="switchToTeam(team)"
                                    :key="team.id"
                                >
                                    <jet-responsive-nav-link as="button">
                                        <div class="flex items-center">
                                            <svg
                                                v-if="
                                                    team.id ==
                                                        $page.user
                                                            .current_team_id
                                                "
                                                class="mr-2 h-5 w-5 text-green-400"
                                                fill="none"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                ></path>
                                            </svg>
                                            <div>{{ team.name }}</div>
                                        </div>
                                    </jet-responsive-nav-link>
                                </form>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </nav>
        <nav
            class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg"
        >
            <div
                class="container px-4 mx-auto flex flex-wrap items-center justify-between"
            >
                <div
                    class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start"
                >
                    <inertia-link
                        :href="route('home')"
                        class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-no-wrap uppercase text-white flex flex-row"
                    >
                        <jet-application-mark class="block h-9 w-auto" />
                        <span
                            class="text-2xl font-semibold ml-2 text-indigo-700"
                            >Notch Relay</span
                        >
                    </inertia-link>
                    <button
                        class="cursor-pointer text-xl leading-none px-3 border border-solid border-transparent rounded bg-gray-100 block lg:hidden outline-none focus:outline-none"
                        type="button"
                        v-if="0 == 1"
                        @click="toggleNavbar()"
                    >
                        <svg
                            class="w-6 h-6 text-indigo-700"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                v-if="!showMenu"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            ></path>
                            <path
                                v-else
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            ></path>
                        </svg>
                    </button>
                </div>
                <div
                    class="lg:flex flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden"
                    :class="{ hidden: !showMenu, block: showMenu }"
                >
                    <ul class="flex flex-col lg:flex-row list-none mr-auto">
                        <li class="flex items-center">
                            <a
                                class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                                href="#"
                                ><i
                                    class="lg:text-gray-300 text-gray-500 far fa-file-alt text-lg leading-lg mr-2"
                                ></i>
                                Docs</a
                            >
                        </li>
                    </ul>
                    <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
                        <li class="flex items-center">
                            <a
                                :href="route('dashboard')"
                                v-if="$page.user"
                                class="bg-white text-gray-800 active:bg-gray-100 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 flex flex-row"
                                type="button"
                                style="transition: all 0.15s ease 0s;"
                            >
                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                    ></path>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                            <a
                                :href="route('register')"
                                v-else
                                class="bg-white text-gray-800 active:bg-gray-100 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 flex flex-row"
                                type="button"
                                style="transition: all 0.15s ease 0s;"
                            >
                                <svg
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
                                        d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                                <span>Getting Started</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <slot></slot>
            <footer class="relative bg-gray-300 pt-8 pb-6">
                <div
                    class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
                    style="height: 80px; transform: translateZ(0px);"
                >
                    <svg
                        class="absolute bottom-0 overflow-hidden"
                        xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="none"
                        version="1.1"
                        viewBox="0 0 2560 100"
                        x="0"
                        y="0"
                    >
                        <polygon
                            class="text-gray-300 fill-current"
                            points="2560 0 2560 100 0 100"
                        ></polygon>
                    </svg>
                </div>
                <div class="container mx-auto px-4">
                    <div class="flex flex-wrap">
                        <div class="w-full lg:w-6/12 px-4">
                            <h4 class="text-3xl font-semibold">
                                Notch Relay
                            </h4>
                            <h5 class="text-lg mt-0 mb-2 text-gray-700">
                                Notch Relay is free marketing tool.
                            </h5>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="flex flex-wrap items-top mb-6">
                                <div class="w-full lg:w-4/12 px-4 ml-auto">
                                    <span
                                        class="block uppercase text-gray-600 text-sm font-semibold mb-2"
                                        >Useful Links</span
                                    >
                                    <ul class="list-unstyled">
                                        <li>
                                            <a
                                                class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm"
                                                href="https://www.github.com/chapdel/notchrelay"
                                                target="_blank"
                                                >Github</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-6 border-gray-400" />
                    <div
                        class="flex flex-wrap items-center md:justify-between justify-center"
                    >
                        <div class="w-full md:w-4/12 px-4 mx-auto text-center">
                            <div
                                class="text-sm text-gray-600 font-semibold py-1"
                            >
                                Copyright © 2020 Notch Relay.
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple> </portal-target>
    </div>
</template>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";

export default {
    components: {
        JetApplicationMark
    },

    data() {
        return {
            showMenu: false
        };
    },
    methods: {
        toggleNavbar: function() {
            alert("ddd");
            this.showMenu = !this.showMenu;
        }
    }
};
</script>
