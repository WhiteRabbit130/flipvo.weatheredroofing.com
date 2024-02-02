
<template>
    <nav class="flex items-center gap-x-6 h-16 dark:bg-gray-900/40 bg-gray-100/40
               transition-colors duration-300 shadow ">
        <div id="global_loader" class="px-1 absolute"></div>
        <div class="flex md:w-2/6 whitespace-nowrap items-center px-4 pl-11">
            <h1 class="lg:text-2xl md:text-lg text-sm font-bold text-gray-800 dark:text-white">
                {{  _capitalize(__name) }}
            </h1>
        </div>
        <div class="w-2/6 items-center justify-center relative hidden md:flex">
            <div class="absolute top-0 bottom-0 pl-3 left-0 flex items-center dark:text-gray-300">
                <i class="fa fa-search font-extralight"></i>
            </div>
            <div v-if="search !== '' "
                 class="absolute top-0 bottom-0 pr-3 right-0 flex items-center dark:text-gray-300">
                <button @click="clearSearch">
                    <i class="fa fa-close "></i>
                </button>
            </div>
            <input v-model="search"
                   class="bg-gray-200 border border-gray-300 text-gray-900
                                       text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                       block w-full pl-10 p-2.5  dark:bg-gray-800 dark:border-gray-600
                                       dark:placeholder-gray-400 dark:text-white
                                       dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Search" type="text"/>

            <div v-if="search !== '' " class="absolute text-slate-600 top-[50px] left-0 right-0 bg-gray-50 border
                                        border-gray-200 shadow dark:bg-slate-200 ">
                {{ search }}
            </div>

        </div>
        <div class="flex flex-1 items-center justify-end  px-8 gap-4">
            <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar"
                    data-dropdown-placement="bottom-end"
                    class="flex h-10 w-10 mx-3 justify-center items-center font-bold bg-gray-800 rounded-full md:mr-0 focus:ring-4
                        focus:ring-gray-300 dark:focus:ring-gray-600 bg-center bg-cover"
                    :style="'background-image: url(data:image/png;base64,'+user.avatar +')'"
                    type="button">
                <span class="sr-only">Open user menu</span>
                <span v-if="!user.avatar" class="">{{ (user.name[0] + user.name[1]).toUpperCase() }}</span>

            </button>

            <!-- Dropdown menu -->
            <div id="dropdownAvatar"
                 class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                    <div class="capitalize">{{ (user.name) }}</div>
                    <div class="font-semibold dark:text-gray-400 truncate"> {{ (user.email) }}</div>
                </div>
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUserAvatarButton">
                    <li>
                        <router-link :to="{name:'profile'}" class="_dropdown_link">Profile</router-link>
                    </li>
                </ul>
                <div class="px-4 py-3 flex text-sm text-gray-900 dark:text-white">
                    <div class="capitalize">
                        <div class="hidden md:flex items-center gap-x-2.5">
                            <label class="inline-flex relative items-center cursor-pointer" for="darkMode-toggle">
                                <input id="darkMode-toggle" class="sr-only peer" type="checkbox" value="">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none
                                        dark:peer-focus:ring-gray-800 rounded-full peer  peer-checked:after:translate-x-full
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                        after:bg-white after:border-gray-200 peer-checked:after:border-gray-900
                                        after:border after:rounded-full after:h-5 after:w-5
                                        after:transition-all after:duration-300 dark:border dark:border-gray-600 peer-checked:bg-gray-900">

                                </div>
                                <i class=" absolute theme-toggle-dark-icon opacity-0 peer-checked:opacity-100
                                peer-checked:right-[-0.1rem] right-4 top-[.15rem] text-sm w-5 h-5 transition-all
                                duration-300  dark:text-gray-600 fa fa-moon-over-sun"></i>

                                <i class=" absolute theme-toggle-light-icon left-[.38rem] top-[.25rem] text-xs text-gray-600
                            opacity-100 peer-checked:opacity-0 peer-checked:left-5 transition-all duration-300
                              w-5 h-5 fa fa-sun"></i>
                            </label>
                        </div>
                    </div>
                    <div class="font-semibold dark:text-gray-400  " id="labelTheme">{{ bb() }}</div>
                </div>
                <div class="py-2">
                    <a class="_dropdown_link" type="button" @click="_logout">
                        Log out
                    </a>
                </div>
            </div>

        </div>
    </nav>
</template>
<script>
import {useRoute} from "vue-router";
import {  computed, ref} from "vue";
import store from "@/store";
import {mapActions} from "vuex";
import instance from "@/axios";
import {_capitalize} from "@/functions/helpers.js";

export default {
    components: {},
    setup() {
        const route = useRoute()
        const open = ref(false)
        return {
            open,
            route,
        }
    },
    methods: {
        ...mapActions({
            signOut: "auth/logout"
        }),
        async _logout() {
            await instance.get('/api/logout').then(() => {
                this.signOut()
            })
        },
        init() {
            const themeToggleDarkIcon = $('.theme-toggle-dark-icon');
            const themeToggleLightIcon = $('.theme-toggle-light-icon');
            const darkMode_toggle = document.getElementById('darkMode-toggle');

            if (!darkMode_toggle) return
            // Change the icons inside the button based on previous settings

            if (localStorage.getItem('color-theme') === 'dark' ||
                (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {

                darkMode_toggle.checked = true

                this.textLabel = 'Light Mode'
            } else {

                darkMode_toggle.checked = false

                this.textLabel = 'Dark Mode'
            }


            darkMode_toggle.addEventListener('change', function () {
                // if set via local storage previously
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                        darkMode_toggle.checked = true
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                        darkMode_toggle.checked = false
                    }
                    // if NOT set via local storage previously
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                        darkMode_toggle.checked = false
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                        darkMode_toggle.checked = true
                    }
                }
                const event = new CustomEvent('themeChange', {
                    detail: {
                        theme: localStorage.getItem('color-theme')
                    }
                });
                window.dispatchEvent(event)

            });

        },
        bb(){
             window.addEventListener('themeChange',(e)=>{
                if (e.detail.theme === 'dark'){
                    $('#labelTheme').text('Light mode')
                } else {
                    $('#labelTheme').text('Dark mode')
                }
            })
            return this.textLabel
        }
    },
    mounted() {
        this.init()
    },
    data() {
        const clearSearch = () => {
            this.search = ''
        }
        const __Breadcrumb = () => {
            return this.$route.meta.__name
        }
        const darkMode = () => {
            return localStorage.getItem('color-theme') === 'dark'
        }

        return {
            children: [],
            search: '',
            textLabel: '',
            user: store.state.auth.user,
            clearSearch,
            __name: computed(() => {
                return __Breadcrumb()
            }),
            darkMode,
            _capitalize,
        }
    },
    watch: {
        $route: function (current) {
            const route = this.$router.options.routes.find(route => route.path === current.path)

            if (route && Array.isArray(route.children)) {
                this.children = route.children
            } else if (route) {
                this.children = []
            }
        },
    }
}
</script>

