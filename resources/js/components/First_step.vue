<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <form method="POST" id="form">
                    <p>
                        <label for="firstname">First Name</label>
                        <input
                            id="firstname"
                            type="text"
                            name="firstname"
                        >
                    </p>
                    <p>
                        <label for="lastname">Last Name</label>
                        <input
                            id="lastname"
                            type="text"
                            name="firstname"
                        >
                    </p>
                    <p>
                        <label for="birthdate">Birth Date</label>
                        <input
                            id="birthdate"
                            type="text"
                            name="birthdate"
                        >
                    </p>
                    <p>
                        <label for="reportsubject">Report Subject</label>
                        <input
                            id="reportsubject"
                            type="text"
                            name="reportsubject"
                        >
                    </p>
                    <p>
                        <label for="country">Country</label>
                        <input
                            id="country"
                            type="text"
                            name="country"
                        >
                    </p>
                    <p>
                        <label for="phone">Phone</label>
                        <input
                            id="phone"
                            type="text"
                            name="phone"
                        >
                    </p>
                    <p>
                        <label for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                        >
                    </p>
                    <a v-on:click="myMethod" class="btn btn-primary btn-next">Next</a>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { required, minLength, between } from 'vuelidate/lib/validators'
export default {
    methods: {
        myMethod() {
            let formData = new FormData(document.getElementById("form"));
            this.$http.post(
                'submit.store',
                formData
            )
        }
    }
}
</script>

<style scoped>
p {
    display: flex;
    flex-direction: column;
}

.btn-next {
    float: right;
}
</style>
