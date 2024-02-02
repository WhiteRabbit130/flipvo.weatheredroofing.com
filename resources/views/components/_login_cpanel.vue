<template>
    <form class="w-full max-w-lg flex-1 flex-col flex gap-4">
        <div class="text-center mb-5">
            <p class="text-lg text-gray-700">Connect now !</p>
        </div>
        <div class="py-2 text-red-500" v-if="message">
            {{ message }}
        </div>
        <div class="flex flex-wrap  ">
            <div class="w-full ">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    E-mail
                </label>
                <input id="grid-last-name"
                       v-model="form.email"
                       class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded-lg
                    py-3 px-4 leading-tight mb-3 focus:outline-none focus:bg-white focus:border-teal-300"
                       placeholder="johne@email.com" type="email">
            </div>

        </div>
        <div class="flex flex-wrap ">
            <div class="flex-1">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    Password
                </label>
                <input id="grid-password"
                       v-model="form.password"
                       class="appearance-none  block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded-lg
                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-teal-300"
                       type="password">

            </div>
        </div>

        <div class="space-y-6 mt-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" v-model="form.remember_me"
                           class="w-4 h-4 text-blue-500 bg-gray-100 rounded border-gray-300
                    focus:ring-blue-500 dark:focus:ring-blue-500 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                           name="remember_me"
                           type="checkbox">
                    <label class="ml-2 block text-sm text-gray-800" for="remember_me">
                        Remember me
                    </label>
                </div>
                <div class="text-sm">

                </div>
            </div>
            <div class="flex justify-end">
                <Button :onClick="login" class="_btn _btn-success py-3"
                        icon-class="fa-duotone fa-door-open fa-lg">
                    Submit
                </Button>
            </div>
        </div>
    </form>

</template>

<script>
import axios from "axios";
import {ref} from "vue";
import {mapActions} from "vuex";
import Button from "./_button.vue";

export default {
    name: "login_cpanel",
    components: {
        Button,
    },
    data() {
        const form = ref({
            email: '',
            password: '',
            remember_me: false
        })
        const error = ref()
        return {
            form,
            error,
            message: ''
        }
    },
    methods: {
        ...mapActions({
            signIn: 'auth/login_cPanel'
        }),
        async login() {
            event.preventDefault()
            this.message = ''
            axios.post('/api/login_cpanel', this.form).then((res) => {
                this.signIn({ response:res, push:()=>{return{name:'cPanel'}}
                })
            }).catch((e) => {
                console.log(e)
                if (e.response.data){
                    this.error = 'erreur de validation des coordonnees'
                    this.message = e.response.data.message || 'Les information données sont incorrect'
                }
            })

        },
    },
}
</script>
