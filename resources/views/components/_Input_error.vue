<template>
    <div v-if="errors" class="">
        <div class="p-2" v-if="error">
            <ul  class="gap-1 flex flex-col text-xs text-red-600 dark:text-red-400" >
                <li v-for="text in error"> {{ text }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "_Input_error",
    props: ['error','errors']
}
</script>

