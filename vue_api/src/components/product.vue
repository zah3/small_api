<template>
    <div class="panel panel-default">
        <div class="panel-body">
            {{ pc.title }}
            {{ pc.price }}
        </div>
        <div class="panel-footer" v-if="isToken()">
            <div v-if="editing">
                <input type="text" v-model="editValueTitle">
                <input type="text" v-model="editValuePrice">
                <a @click="onUpdate">Save</a>
                <a @click="onCancel">Cancel</a>
            </div>
            <div v-if="!editing">
                <a @click="onEdit">Edit</a>
                <a @click="onDelete">Delete</a>
            </div>
            <div>
                <a @click="onAdd"> Do You want to add to any cart ?</a>
                <form v-if="adding">
                    <select id="selector">
                        <option v-for="cart in carts" v-bind:value="cart.cart_number">
                            {{ cart.cart_number }}
                        </option>
                    </select>
                    <button class="btn btn-primary" @click.prevent="addToCart">Add it</button>
                </form>
            </div>
        </div>
        <br>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        props: ['pc'],
        data(){
            return {
                editing : false,
                adding: false,
                editValueTitle: this.pc.title,
                editValuePrice: this.pc.price,
                carts: []
            }
        },
        methods: {
            onEdit(){
                this.editing = true;
                this.editValueTitle = this.pc.title;
                this.editValuePrice = this.pc.price;
            },
            onCancel(){
                this.editing = false;
            },
            onDelete(){
                const token = localStorage.getItem('token');
                this.$emit('productDeleted', this.pc.id);
                axios.delete('http://127.0.0.1:8000/api/product/'+this.pc.id+'?token='+token)
                    .then(
                        response => console.log(response)
                    ).catch(
                        error => console.log(error)
                    );
            },
            onUpdate(){
                const token = localStorage.getItem('token');
                this.editing = false;
                this.pc.title = this.editValueTitle;
                this.pc.price = this.editValuePrice;
                console.log(this.editValueTitle,this.pc.title);
                axios.put('http://127.0.0.1:8000/api/product/'+this.pc.id+'?token='+token ,
                    {title : this.editValueTitle, price : this.editValuePrice})
                    .then(
                        response => console.log(response)
                    ).catch(
                        error => console.log(error)
                    );
            },
            isToken(){
                if(localStorage.getItem('token') === null)
                    return false;
                else
                    return true;
            },
            onAdd(){
                if(this.adding == false){
                    this.adding = true;
                    this.onGetCarts();
                }
                else
                    this.adding = false;
            },
            onGetCarts(){
                const token = localStorage.getItem('token');
                axios.get('http://127.0.0.1:8000/api/carts?token='+token)
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
            addToCart(){
                var select = $('#selector');
                const token = localStorage.getItem('token');
                axios.post('http://127.0.0.1:8000/api/cart/' + select.val() + '/product/' + this.pc.id + '?token=' + token)
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
            }
        }
    }
</script>
<style scoped>
    a{
        cursor: pointer;
    }
</style>