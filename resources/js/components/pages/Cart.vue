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
             <form @submit.prevent="sendMail(cart.name, cart.contacts, cart.comments)">
                <input type="text" name="name" placeholder="Name" ><br>
                <textarea name="contacts" style="resize: none;"  cols="30" rows="2" placeholder="Contact details" ></textarea><br>
                <textarea name="comments" style="resize: none;" cols="30" rows="4" placeholder="Comments" ></textarea><br>
                <button type="submit" name="checkout" >Checkout</button>
            </form>  
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
                cart : {
                    name: '',
                    contacts:'',
                    comments:'',
                }
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
            },
            sendMail(name, contacts, comments){
                console.log(cart.name);
                // axios.post('cart', { 'name': name,'contacts':contacts,'comments':comments })
                // .then(() => {
                //     this.fetchProducts();
                // })
                // .catch(err => console.log(err))
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
    form {
        width: 400px;
        padding: 0px;
    }
    form input{
        width: 96%;
        margin-bottom: 10px;
        margin-left: 6px;
    }
    form textarea{
        width: 96%;
        margin-bottom: 10px;
        margin-left: 6px;
    }
    form a,form button{
        display: inline-flex;
        font-size: 20px;
        position: relative;
        left: 190px;
    }
 </style>