<template>
  <div>
    <h4 class="text-center">Add Customer</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addCustomer">
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
                        <input type="address" class="form-control" v-model="customer.address">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="number" class="form-control" v-model="customer.phoneNumber">
                    </div><br>
                    <button type="submit" class="btn btn-info">Add Customer</button>
                </form>
            </div>
        </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
       customer:{}
    };
  },
  methods:{
    addCustomer(){
        this.$axios.get('/sanctum/csrf-cookie').then(response =>{
            this.$axios.post('/api/customers/store',this.customer)
            .then(response =>{
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
             .catch(function (error) {
                    // console.error(error);
            });
        })
    }
  },
  
  beforeRouteEnter(to,from,next){
    if (!window.Laravel.isLoggedIn) {
            window.location.href = "/";
        }
        next();
  }
}
</script>

<style>

</style>