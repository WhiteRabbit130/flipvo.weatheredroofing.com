<template>
    <button v-if="!disabled" type="button" :class="[!clickable ?'_disabled':'' , isConfirm?'rounded-r-none':''] "
            @click="()=>{!confirm?submit():isConfirm = true}"
            @focusout="()=>{isConfirm = false}"
            class="flex items-center relative  ">
        <i v-if="!clickable" class="fa-duotone fa-spinner-third fa-spin fa-lg mr-2"></i>
        <i v-else-if="loader" :class="iconClass" class="mr-2"></i>
        <slot/>
        <div v-if="confirm" :class="[isConfirm?'w-10 ':'w-0 ring-0  opacity-0']"
                @click="confirmed"
             class="bg-green-200 absolute top-0 bottom-0 left-full   rounded-r-lg overflow-hidden ml-1 ring-4 ring-green-400
                    flex items-center text-gray-700 justify-center font-black hover:bg-green-500 hover:text-white transition-all">OK</div>
    </button>

    <button v-else type="button" class="_btn _disabled">
        <i class="fa-duotone fa-bug fa-lg mr-2"></i>
        <slot/>
    </button>
</template>
<script>
export default {
    name: "_button",
    props: {
        onClick: {},
        callback: {},
        loader: {
            default: true
        },
        disabled: {
            default: false
        },
        iconClass: {
            default: 'fa-duotone fa-save'
        },
        data: {
            default: null
        },
        confirm: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        confirmed(){
            console.log(this.isConfirm);
            event.stopPropagation()

            this.submit()
        },
        submit() {
            this.isConfirm = false; // if confirmation is required
            if (!this.clickable) return;
            return new Promise((resolve, reject) => {
                this.clickable = false
                resolve(this.$props.onClick(this.$props.data));
            }).then((res) => {
                setTimeout(() => {
                    this.clickable = true
                    return res
                }, 500)
            }).catch((err) => {
                setTimeout(() => {
                    this.clickable = true
                    return err
                }, 500)
            })
        },
    },
    watch: {
        clickable(newQuestion, oldQuestion) {
        }
    },
    data() {
        return {
            clickable: true,
            isConfirm: false,
        }
    }
}
</script>
