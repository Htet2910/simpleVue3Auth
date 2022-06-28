<template>
   <div>
        <h4 class="text-center">Edit Book</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateCustomer">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="customer.name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model="customer.email">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" v-model="customer.address">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" v-model="customer.phoneNumber">
                    </div>

                   <br>
                    <button type="submit" class="btn btn-primary">Update Customer</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
   data() {
        return {
            customer: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/customers/edit/${this.$route.params.id}`)
                .then(response => {
                    this.customer = response.data;
                })
                .catch(function (error) {
                    // console.error(error);
                });
        })
    },
    methods:{
        updateCustomer(){
                  this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/customers/update/${this.$route.params.id}`, this.customer)
                    .then(response => {
                        this.$router.push(
                            {name:'customers'},
                            {email: 'customers'},
                            {address: 'customers'},
                            {phoneNumber: 'customers'}
                        );
                        // this.$router.push({email: 'customers'});
                        // this.$router.push({address: 'customers'});
                        // this.$router.push({phoneNumber: 'customers'});
                    })
                    .catch((error)=> {
                        // console.error(error);
                    });
            })
        }
    },

    beforeRouterEnter(to,from,next){
         if (!window.Laravel.isLoggedIn) {
            window.location.href = "/";
        }
        next();
    }
}
</script>

<style>

</style>