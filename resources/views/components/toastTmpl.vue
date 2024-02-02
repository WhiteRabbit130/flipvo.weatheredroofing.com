<template>
    <div class="px-3 dark:text-gray-200 text-gray-700 text-sm">
        <div class="text-lg font-light">
            <p> {{ $props.title }} </p>
        </div>
        <div class="text-xs" v-html="$props.description"></div>
    </div>
</template>
<script>
export default {
    name: "toastTmpl",
    props: {
        type: {
            default: ""
        },
        title: {
            default: ""
        },
        description: {
            default: ""
        },
    },
    setup(props) {
        const icon = props.type === 'danger' ? '<i class="fa-solid fa-circle-exclamation text-red-500"></i>'
            : props.type === 'success' ? '<i class="fa-solid fa-circle-check text-green-500"></i>'
                : props.type === 'info' ? '<i class="fa-solid fa-circle-info text-cyan-500"></i>'
                    : props.type === 'warning' ? '<i class="fa-solid fa-triangle-exclamation text-orange-500"></i>'
                        : '<i class="fa fa-circle-info text-white "></i>'

        return {
            icon
        }
    },
}
</script>
