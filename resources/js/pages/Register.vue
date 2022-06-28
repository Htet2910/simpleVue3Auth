<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <div class="card card-default">
                    <div class="card-header">Register</div>
                     <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="name"  type="email" class="form-control" v-model="name" equired
                                           autofocus autocomplete="off"> 
                                </div>
                            </div><br>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">E-mail Address</label>
                                <div class="col-md-6">
                                    <input id="email"  type="email" class="form-control" v-model="email" equired
                                           autofocus autocomplete="off"> 
                                </div>
                            </div><br>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password"  type="password" class="form-control" v-model="password" equired
                                           autofocus autocomplete="off"> 
                                </div>
                            </div><br>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                     </div>
                    </div>
                </div>
           </div>
       </div>
</template>

<script>
export default {
 data(){
    return {
        name:'',
        email:'',
        password:'',
        error:null
    };
  },
  methods:{
    handleSubmit(e){
        e.preventDefault();
        if(this.password.length>0){
              axios.get('/sanctum/csrf-cookie').then(response =>{
                   axios.post('/api/register',{
                    name:this.name,
                    email:this.email,
                    password:this.password
                   }).then(response =>{
                       if(response.data.success){
                         window.location.href = "/login";
                        }else{
                            this.error =response.data.message;
                        }
                   })
                   .catch((error)=>{
                        // console.log(error);
                   });    
                })
        } 
    }
  },

  beforeRouterEnter(to,from,next){
        if(window.Laravel.isLoggedIn){
            return next('dashboard');
        }
        next();
  }
};
</script>

<style>

</style>