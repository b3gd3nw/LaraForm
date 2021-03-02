<template>
    <div v-if="this.$cookie.get('step') === 'second'">
        <second_step></second_step>
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
            countries: ''
        }
    },
    mounted() {
        let self = this
        axios.get('/api/countries')
            .then(response => {
                self.countries = response.data
                console.log(self.countries)
            })
            .catch(function (error) {
                console.log(error)
            })
    }
}

</script>

<style scoped>

</style>
