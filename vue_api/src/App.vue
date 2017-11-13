<template>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <router-link to="/" >Products</router-link>
                    <router-link to="/new_product" >Make new product</router-link>
                    <router-link to="/new_cart" >Make new cart</router-link>
                    <router-link to="/carts" >Carts</router-link>
                    <router-link to="/signup" v-if="!isToken()" >Sign up</router-link>
                    <router-link to="/signin" v-if="!isToken()" >Sign in</router-link>
                    <button  v-if="isToken()" @click="forgetToken()" class="btn btn-primary">Log out</button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {}
        },
        methods:{
            isToken(){
                if(localStorage.getItem('token') === null)
                    return false;
                else
                    return true;
                this.$forceUpdate();
            },
            forgetToken(){
                localStorage.removeItem('token');
                this.$forceUpdate();
            }
        }
    }
</script>

<style>
    #app {
        margin: 40px;

    }
</style>
