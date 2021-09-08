<template>
    <div class="container">
        <h2>Cart</h2>
        <div class="main-section">
            <div  v-for="product in products" v-bind:key="product.id">
                <div class="full-section">
                    <div class="info-section">
                        <img :src="`./image/${ product.image }`" alt="image">
                    </div>
                    <div class="info-section">
                        <ul>
                            <li>{{ product.title }}</li>
                            <li>{{ product.description }}</li>
                            <li>{{ product.price }}</li>
                        </ul>
                    </div> 
                    <form @submit.prevent="removeProductCart(product.id)" class="formRemove">
                        <div class="info-section">
                            <button type="submit">Remove</button>
                        </div> 
                    </form>
                </div>
            </div>   
        </div>
        <router-link class="nav-link" :to="{ name: 'index' }">Go to Index</router-link>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                product: {
                    id: '',
                    image: '',
                    title: '',
                    description: '',
                    price: '',
                },
            }
        },
         created() {
            this.fetchProducts();
        },
        methods: {
            fetchProducts() {
                fetch('cart')
                    .then(response =>response.json())
                    .then(response=> {
                        this.products = response
                })
            },
            removeProductCart(id) {
                //remove
                //delete => need to put with data option
                axios.delete('cart/'+ id, { data: { id } })
                .then(() => {
                    this.fetchProducts();
                })
                .catch(err => console.log(err))
            }
        }
    }
</script>

<style scoped>
    .full-section{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        width: 400px;
    }

    .info-section{
        padding: 5px;
    }
    .info-section img{
        width: 120px;
        height: 120px;
        padding: 0px;
    }
    .info-section ul{
        list-style-type: none;
        padding: 0px;
        margin: 0px;
        font-size: 3vh;
    }
    .info-section a{
        position: relative;
    
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .cart-section{
        padding: 0px;
        width: 400px;
        text-align: center;
    }
 </style>