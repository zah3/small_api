<template>
    <div>
        <button class="btn btn-primary" @click="onGetProducts">Get Carts</button>
        <hr>
        <app-product v-for="cart in carts" :ct="cart" @productDeleted="onProductDeleted($event)"></app-product>
        <hr>

    </div>
</template>
<script>
    import Cart from './cart.vue';
    import Axios from 'axios';
    export default {
        data(){
            return {
                carts: [],
            }
        },
        methods:{
            onGetProducts(){
                const token = localStorage.getItem('token');
                Axios.get('http://127.0.0.1:8000/api/carts?token='+token)
                    .then(
                        response => {
                            this.carts = response.data.carts;
                            console.log(response);
                        },

                    )
                    .catch(
                        error => console.log(error)
                    );
            },
            onCartDeleted(id){
                const position = this.carts.findIndex((element) =>{
                    return element.id == id;
                })
                this.carts.splice(position,1)
            }
        },
        components:{
            'app-product': Cart
        }
    }
</script>