<template>
    <div>
        <button class="btn btn-primary" @click="onGetProducts">Get Products</button>
        <hr>
        <app-product v-for="product in products" :pc="product" @productDeleted="onProductDeleted($event)"></app-product>
        <hr>
        <button v-if="getCounter() > 0" class="btn btn-primary" @click="minusCounter">Prev</button>
        <button v-if="!getLastPageInfo()" class="btn btn-primary" @click="addCounter">Next</button>
    </div>
</template>
<script>
    import Product from './product.vue';
    import Axios from 'axios';
    export default {
        data(){
            return {
                products: [],
                counter: 0,
                pageNumber: '',
                lastPage : false
            }
        },
        methods:{
            getLastPageInfo(){
              return this.lastPage;
            },
            getCounter(){
              return this.counter;
            },
            addCounter(){
                this.counter++;
                this.onGetProducts();
            },
            minusCounter(){
                if(this.counter > 0)
                    this.counter--;
                this.onGetProducts();
            },
            onGetProducts(){
                if(this.counter <= 0)
                    this.pageNumber = '';
                else
                    this.pageNumber = '?page=' + this.counter;
                Axios.get('http://127.0.0.1:8000/api/products'+this.pageNumber)
                    .then(
                        response => {
                            this.products = response.data.products;
                            this.lastPage = response.data.lastPage;
                            console.log(response);
                        },
                    )
                    .catch(
                        error => console.log(error)
                    );
            },
            onProductDeleted(id){
                const position = this.products.findIndex((element) =>{
                    return element.id == id;
                })
                this.products.splice(position,1)
            }
        },
        components:{
            'app-product': Product
        }
    }
</script>