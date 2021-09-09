<template>
    <div class="container">
        <form @submit.prevent="login">
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                    <div class="col-md-6">
                        <input v-model="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email" autofocus>
                    </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                    <div class="col-md-6">
                        <input v-model="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">   
                    </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>                
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email:'',
            password:'',
        }
    },
    methods: {
        login(){
            axios.post('login', { 'email': this.email,'password':this.password})
                .then(() => {
                    this.$router.push('sp-products');
            })
            .catch(err => console.log(err))
        }

   }     
}
</script>

<style  scoped>
    form{
        width: 300px;
        margin: 200px auto;
    }
</style>