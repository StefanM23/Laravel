<template>
    <div class="container">
       <div  v-for="product in products" v-bind:key="product.id">
           <div class="full-section-products" >
                <div class="info-section">
                    <img :src="`./image/${product.image}`" alt="image">
                </div>
                <div class="info-section">
                    <ul>
                        <li>{{ product.title }}</li>
                        <li>{{ product.description }}</li>
                        <li>{{ product.price }}$</li>
                    </ul>
                </div>
                <div class="info-section">
                    <a href="" name='edit'>Edit</a>
                </div>
                <form>
                    <div class="info-section">
                        <button type="submit" name="id" >Delete</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="cart-section-products"> 
            <button name='logout' v-on:click="logout" id="logout">Logout</button>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                products: [],
                product: {
                    id: '',
                    image: '',
                    title: '',
                    description: '',
                    price: '',
                },
                authUser: window.authUser
            }
        },
        created() {
            this.fetchProducts();
        },
        methods: {
            fetchProducts() {
                fetch('products')
                    .then(response => response.json())
                    .then(response => {
                        this.products = response
                    })
            },
            logout(){
                console.log('Logout');
                axios.post('logout')
                .then(() => {
                    this.$router.push('sp-login');
            })
            .catch(err => console.log(err))
            }
        }
    }
</script>
<style scoped>
    .info-section{
    padding: 5px;
    height: 150px;
}
.info-section img{
    width: 100%;
    height: 100%;
    padding: 0px;
}
.info-section ul{
    list-style-type: none;
    padding: 0px;
    margin: 0px;
    font-size: 22px;
}
.info-section button{
    position: relative;
    font-size: 25px;
    top: 40px;
    left: 60px;
    border-radius: 20px;
    width: 100px;
    border:1px solid black;
    background-color: rgb(208, 245, 140);
}
.info-section a{
    position: relative;
    font-size: 25px;
    top: 40px;
    left: 100px; 
}
.full-section-products{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    width: 600px;
}
</style>