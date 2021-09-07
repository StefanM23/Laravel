<template>
    <div>
        <h2>Products</h2>
        <div  v-for="product in products" v-bind:key="product.id">
            <div class="title">{{ product.title }}</div>
            <div class="title">{{ product.description }}</div>
            <div class="title">{{ product.price }}</div>
            <div class="title">{{ product.image }}</div>
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
                product_id: '',
                edit: false
            }
        },
        created() {
            this.fetchProducts();
        },
        methods: {
            fetchProducts() {
                fetch('index')
                    .then(response =>response.json())
                    .then(response=> {
                        this.products = response
                    })
            }
        }
    }
</script>

