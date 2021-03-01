<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <form
                    id="app"
                    @submit="checkForm"
                    action="/second"
                    method="post"
                >

                    <p>
                        <label for="firstname">First Name</label>
                        <input
                            id="firstname"
                            v-model="name"
                            type="text"
                            name="firstname"
                        >
                    </p>
                    <p>
                        <label for="lastname">Last Name</label>
                        <input
                            id="lastname"
                            v-model="name"
                            type="text"
                            name="firstname"
                        >
                    </p>
                    <p>
                        <label for="birthdate">Birth Date</label>
                        <input
                            id="birthdate"
                            v-model="name"
                            type="text"
                            name="birthdate"
                        >
                    </p>
                    <p>
                        <label for="reportsubject">Report Subject</label>
                        <input
                            id="reportsubject"
                            v-model="name"
                            type="text"
                            name="reportsubject"
                        >
                    </p>
                    <button type="submit" class="btn btn-primary btn-next">Next</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Second_step"
}
</script>

<style scoped>

</style>
