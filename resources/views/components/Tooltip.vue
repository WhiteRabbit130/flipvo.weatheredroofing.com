<template>
    <component :is="$props.is" v-if="$props.sbj==='popover'" :data-popover-target="$props.container_id"
               :data-popover-placement="$props.placement"  >
        <slot name="trigger_content"></slot>
    </component>
    <component :is="$props.is" v-else :data-tooltip-target="$props.container_id"
               :data-tooltip-placement="$props.placement" >
        <slot name="trigger_content"></slot>
    </component>
    <div v-if="$props.sbj==='popover'" data-popover :id="$props.container_id" role="tooltip"
         :class="$props.popover_container_class">
        <slot name="container_content"></slot>
        <div data-popper-arrow></div>
    </div>
    <div v-else :id="$props.container_id" role="tooltip"
         :class="$props.tooltip_container_class">
        <slot name="container_content"></slot>
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</template>

<script>
export default {
    name: "Tooltip",
    props: {
        is: {
            default: 'p',
        },
        sbj: {
            default: 'popover'
        },
        container_id: {},
        placement: {
            default: 'bottom'
        },
        tooltip_container_class: {
            default :`absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700`
        },
        popover_container_class: {
            default: `absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800`
        },
        event:{
            default:'hover'
        }
    },
    methods: {
        initPoops() {
            let target = $('#'+this.$props.container_id)
            let toggle = $('[data-'+this.$props.sbj+'-target="'+this.$props.container_id+'"]')
            let options = {
                placement: this.$props.placement,
                triggerType:this.$props.event,
            };

            return  new this.run[this.$props.sbj](target[0], toggle[0], options)
        }
    },
    mounted() {
        this.initPoops().toggle()
    },
    data(){
        return {
            run:{
                popover:Popover,
                tooltip:Tooltip,
            }
        }
    }

}
</script>

<style scoped>

</style>
