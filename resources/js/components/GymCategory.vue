<template>
    <div class="container">
        <h2>Gym Category</h2>
        <div class="row">
            <div class="col-12 col-md-3" v-for="gym in this.gyms" v-bind:key="gym.id">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <img :src="`storage/${gym.image}`" class="card-img-top" alt="image category">
                    <div class="card-body">
                        <h5 class="card-title">{{ gym.name }}</h5>
                        <p class="card-text">{{ gym.direction }}</p>
                        <p class="card-text">{{ gym.open_time }} - {{ gym.close_time }}</p>
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
            gyms: []
        }
    },
    mounted() {
        axios.get('/api/categories/gym')
            .then(response => {
                this.gyms = response.data;
            })
            .catch(function (error) {
                console.log(error);
            })
    },
}
</script>
