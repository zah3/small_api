<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="panel-body">
                {{ pt.title }}
                {{ pt.price }}
            </div>
            <div class="panel-footer">
                <div>
                    <button @click="onDelete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import ProductFromCart from './products_from_cart.vue';
    import axios from 'axios';
    export default {
        props: ['pt'],
        data(){
            return {
                title : this.pt.title,
            }
        },
        methods:{
            onDelete(){
                console.log(this.pt.cart_number, this.pt.id);
                const token = localStorage.getItem('token');
                axios.delete('http://127.0.0.1:8000/api/cart/' + this.pt.cart_number + '/product/' + this.pt.product_id + '?token='+token)
                    .then(
                        response => console.log(response)
                    ).catch(
                        error => console.log(error)
                    );
            },
        }

    }
</script>
<style scoped>
    a{
        cursor: pointer;
    }
</style>