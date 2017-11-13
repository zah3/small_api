<template>
    <form>
        <div class="form-group">
            <label for="name">name</label>
            <input type="text"
                   id="name"
                   class="form-control"
                   v-model="name">
        </div>
        <div class="form-group">
            <label for="email">email</label>
            <input type="text"
                   id="email"
                   class="form-control"
                   v-model="email">
        </div>
        <div class="form-group">
            <label for="password">password</label>
            <input type="text"
                   id="password"
                   class="form-control"
                   v-model="password">
        </div>
        <button type="submit" class="btn btn-primary" @click.prevent="onSignUp"> Signup</button>
    </form>
</template>
<script>
    import axios from 'axios';
    export default {
        data(){
            return{
                name:'',
                email: '',
                password: ''
            }
        },
        methods:{
            onSignUp(){
                axios.post('http://127.0.0.1:8000/api/user',
                    {name: this.name, email: this.email, password: this.password},
                    {headers:{'X-Requested-With': 'application/xml'}})
                    .then(
                        (response) => console.log(response)
                    ).catch(
                    (error)     =>console.log(error)
                );
            }
        }
    }
</script>