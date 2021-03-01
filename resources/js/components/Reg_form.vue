<template>
    <div v-if="this.$cookie.get('step') === 'second'">
        <second_step></second_step>
    </div>
    <div v-else>
        <step-one></step-one>
    </div>
</template>

<script>
import Second_step from "./Second_step";
export default {
    name: "Reg_form",
    components: {Second_step}
}

</script>

<style scoped>

</style>
