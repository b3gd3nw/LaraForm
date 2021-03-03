<template>
    <div v-if="this.$cookie.get('step') === 'second'">
        <second_step></second_step>
    </div>
    <div v-else-if="this.$cookie.get('step') === 'three'">
        <social v-bind:counter_data="counter">

        </social>
    </div>
    <div v-else>
        <step-one
            v-bind:countries_data="countries"
        ></step-one>
    </div>
</template>

<script>
import Second_step from "./Second_step";

export default {
    name: "Reg_form",
    components: {Second_step},
    data() {
        return {
            countries: '',
            counter: ''
        }
    },
    mounted() {
        let self = this
        axios.get('/api/countries')
            .then(response => {
                self.countries = response.data
            })
        axios.get('/api/all_members')
            .then(response => {
                self.counter = response.data
        });


    }
}

</script>

<style scoped>

</style>
