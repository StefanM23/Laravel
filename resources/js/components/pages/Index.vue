<template>
    <div>
        <h2>Products</h2>
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
                    <form @submit.prevent="addProductCart(product.id)" class="formAdd">
                        <div class="info-section">
                            <button type="submit">Add</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
        <div class="cart-section">
            <router-link class="nav-link" :to="{ name: 'cart' }">Go to the cart</router-link>
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
            }
        },
        created() {
            this.fetchProducts();
        },
        methods: {
            fetchProducts() {
                fetch('index')
                    .then(response => response.json())
                    .then(response => {
                        this.products = response
                    })
            },
            addProductCart(id) {
              
                //add
                axios.post('index', {id})
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

