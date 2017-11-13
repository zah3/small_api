<template>
    <form @submit.prevent="onSubmitted">
        <div class="form-group">
            <label for="title">Title</label>
            <input
                    type="text"
                    id="title"
                    class="form-control"
                    v-model="productTitle">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input
                    type="text"
                    id="price"
                    class="form-control"
                    v-model="productPrice">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</template>
<script>
    import axios from 'axios';

    export default {
        data(){
            return {
                productTitle: '',
                productPrice: ''
            }
        },
        methods: {
            onSubmitted(){
                const token = localStorage.getItem('token');
                axios.post('http://127.0.0.1:8000/api/product?token=' + token,
                    {title: this.productTitle, price: this.productPrice})
                    .then(
                        (response) => console.log(response)
                    ).catch(
                        (error)     =>console.log(error)
                    );
            }
        }
    }
</script>