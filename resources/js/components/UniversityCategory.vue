<template>
    <div class="container">
        <h2>Univerity Category</h2>
        <div class="row">
            <div class="col-12 col-md-3" v-for="university in this.universities" v-bind:key="university.id">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <img :src="`storage/${university.image}`" class="card-img-top" alt="image category">
                    <div class="card-body">
                        <h5 class="card-title">{{ university.name }}</h5>
                        <p class="card-text">{{ university.direction }}</p>
                        <p class="card-text">{{ university.open_time }} - {{ university.close_time }}</p>
                        <a href="#" class="btn btn-dark d-block">Show More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            universities: []
        }
    },
    mounted() {
        axios.get('/api/categories/university')
            .then(response => {
                this.universities = response.data;
            })
            .catch(function (error) {
                console.log(error);
            })
    },
}
</script>
