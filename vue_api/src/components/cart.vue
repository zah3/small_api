<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <a @click="onClicked">Cart number {{ ct.cart_number }}</a><button v-if="this.price.length > 0" class="btn btn-primary">Total price: {{this.price}} </button><button @click="onDelete" class="btn btn-danger"> DELETE </button>
            <app-product v-for="product in products" :pt="product" v-if="clicked"></app-product>
        </div>
    </div>
</template>
<script>
    import ProductFromCart from './products_from_cart.vue';
    import axios from 'axios';
    export default {
        props: ['ct'],
        data(){
            return {
                products:[],
                clicked: false,
                price: '',
            }
        },
        methods:{
            onClicked(){
                if(this.clicked == false){
                    this.onGetProducts();
                }else
                    this.clicked = false;
            },
            onGetProducts(){
                const token = localStorage.getItem('token');
                axios.post('http://127.0.0.1:8000/api/cart/'+ this.ct.cart_number +'?token='+token)
                    .then(
                        response => {
                            this.products = response.data.products;
                            this.price = response.data.price;
                            console.log(response);
                        },
                    )
                    .catch(
                        error => console.log(error)
                    );
                this.clicked = true;
            },
            onCartDeleted(id){
                const position = this.carts.findIndex((element) =>{
                    return element.id == id;
                })
                this.carts.splice(position,1)
            },onDelete(){
                const token = localStorage.getItem('token');
                axios.delete('http://127.0.0.1:8000/api/cart/'+ this.ct.cart_number +'?token='+token)
                    .then(
                        response => console.log(response)
                    ).catch(
                        error => console.log(error)
                    );
            },
        },
        components:{
            'app-product': ProductFromCart
        }
    }
</script>
<style scoped>
    a{
        cursor: pointer;
    }
</style>