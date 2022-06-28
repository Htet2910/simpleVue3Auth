<template>
  <div>
        <h4 class="text-center">All Customers</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>PhoneNumber</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="customer in customers" :key="customer.id" >
                     <td> {{customer.id}}</td>
                     <td>{{customer.name}}</td>
                     <td>{{customer.email}}</td>
                     <td>{{customer.address}}</td>
                     <td>{{customer.phoneNumber}}</td>
                     <td>
                     <div class="btn-group" role="group">
                      
                        <router-link :to="{name: 'editCustomer', params: { id: customer.id }}" class="btn btn-primary">Edit
                        </router-link>&nbsp;&nbsp;
                        <button class="btn btn-danger" @click="deleteCustomer(customer.id)">Delete</button>
                    </div>
                </td>
                </tr>
            </tbody>
        </table>
         <button type="button" class="btn btn-info" @click="this.$router.push('/customers/store')">Add Customer</button>
  </div>

</template>

<script>
export default {
  data(){
    return{
         customers:[]
    };
  },
  created(){
    this.$axios.get('/sanctum/csrf-cookie').then(response =>{
        this.$axios.get('/api/customers')
        .then(response =>{
            this.customers =response.data;
        })
        .catch(function(error){
            // console.log(error);
        })
    })

  },
  methods:{
     deleteCustomer(id){
      this.$axios.get('/sanctum/csrf-cookie').then(response =>{
          this.$axios.delete(`/api/customers/destroy/${id}`)
          .then(response => {
             let i =  this.customers.map(item => item.id).indexOf(id);
             this.customers.splice(i,1);
          })
          .catch(function (error) {
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
    },
};
</script>

<style>

</style>