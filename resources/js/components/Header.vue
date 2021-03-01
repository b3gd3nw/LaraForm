<template>
    <div class="container-fluid">
        <div class="jumbotron jumbotron-fluid map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3303.7615498732034!2d-118.34587228439435!3d34.10124852259263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bf20e4c82873%3A0x14015754d926dadb!2s7060%20Hollywood%20Blvd%2C%20Los%20Angeles%2C%20CA%2090028%2C%20USA!5e0!3m2!1sen!2sua!4v1611071178556!5m2!1sen!2sua" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" class="map_frame"></iframe>
        </div>
    </div>
</template>

<script>
export default {
name: "Header"
}
</script>

<style scoped>
    .map>iframe {
        width: 100%;
    }

    .container-fluid {
        padding: 0;
    }
</style>
