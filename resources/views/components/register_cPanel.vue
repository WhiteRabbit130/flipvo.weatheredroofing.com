<template>
    <form class="w-full max-w-lg flex-1 flex-col flex gap-4">
        <div class="text-center mb-5">
            <p class="text-lg text-gray-700">Create an account </p>
        </div>
        <div class="flex flex-wrap  ">
            <div class="w-full ">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                    Full Name
                </label>
                <input id="name"
                       v-model="form.name"
                       class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded-lg
                    py-3 px-4 leading-tight mb-3 focus:outline-none focus:bg-white focus:border-teal-300"
                       placeholder="johne" type="text">
                <InputError :errors="errors" :error="errors.name"></InputError>
            </div>

        </div>
        <div class="flex flex-wrap  ">
            <div class="w-full ">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                    E-mail
                </label>
                <input id="email"
                       v-model="form.email"
                       class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded-lg
                    py-3 px-4 leading-tight mb-3 focus:outline-none focus:bg-white focus:border-teal-300"
                       placeholder="johne@exampl.com" type="email">
                <InputError :errors="errors" :error="errors.email"></InputError>
            </div>
        </div>
        <div class="flex flex-wrap  ">
            <div class="w-full ">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                    Phone
                </label>
                <input id="phone"
                       v-model="form.phone"
                       class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded-lg
                    py-3 px-4 leading-tight mb-3 focus:outline-none focus:bg-white focus:border-teal-300"
                       placeholder=" " type="text">
                <InputError :errors="errors" :error="errors.phone"></InputError>
            </div>
        </div>
        <div class="flex flex-wrap ">
            <div class="flex-1">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                    Password
                </label>
                <input id="password"
                       v-model="form.password"
                       class="appearance-none  block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded-lg
                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-teal-300"
                       type="password">
                <InputError :errors="errors" :error="errors.password"></InputError>
            </div>
        </div>
        <div class="flex flex-wrap ">
            <div class="flex-1">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                       for="password_confirmation">
                    Confirm password
                </label>
                <input id="password_confirmation"
                       v-model="form.password_confirmation"
                       class="appearance-none  block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded-lg
                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-teal-300"
                       type="password">
                <InputError :errors="errors" :error="errors.password_confirmation"></InputError>
            </div>
        </div>

        <div class="  mt-6">
            <div class="flex justify-end">
                <Btn :onClick="submit" class="_btn _btn-success py-3"
                     icon-class="fa-duotone fa-door-open fa-lg">
                    Create
                </Btn>
            </div>
        </div>
    </form>
</template>
<script>
import {ref} from "vue";
import use_user from '@/CRUD/user'
import {mapActions} from "vuex";
import axios from "axios";

export default {
    name: "login_cpanel",
    data() {
        const form = ref({
            email: '',
            password: '',
            remember_me: false
        })
        const {register,errors} =use_user()
        return {
            form,
            errors,
            register,
            message: ''
        }
    },
    methods: {
        submit() {
            return this.register(this.form)
                .then((res)=>{
                    if (res && res.data.success){
                        this.login()
                    }
            })
        },
        ...mapActions({
            signIn: 'auth/login_cPanel'
        }),
        async login() {
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
