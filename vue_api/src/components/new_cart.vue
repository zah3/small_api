<template>
    <button class="btn btn-primary" @click="onMakeNewCart">Make new cart</button>
</template>
<script>
    import axios from 'axios';

    export default {
        data(){
            return {
            }
        },
        methods: {
            onMakeNewCart(){
                const token = localStorage.getItem('token');
                axios.post('http://127.0.0.1:8000/api/cart?token=' + token)
                    .then(
                        (response) => {
                            alert(response.data.message);
                        }
                    ).catch(
                        (error)     =>console.log(error)
                    );
            }
        }
    }
</script>