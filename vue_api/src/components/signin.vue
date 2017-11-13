<template>
    <form>
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
        <button type="submit" class="btn btn-primary" @click.prevent="onSignIn"> Sign in</button>
    </form>
</template>
<script>
    import axios from 'axios';
    export default {
        data(){
            return{
                email: '',
                password: ''
            }
        },
        methods:{
            onSignIn(){
                axios.post('http://127.0.0.1:8000/api/user/sing_in',
                    { email: this.email, password: this.password},
                    {headers:{'X-Requested-With': 'application/xml'}})
                    .then(
                        (response) => {
                            const token = response.data.token;
                            const is_superuser = response.data.is_superuser;
                            const base64Url = token.split('.')[1];
                            const base64 = base64Url.replace('-','+').replace('_','/');
                            console.log(JSON.parse(window.atob(base64)));
                            console.log(response.data.is_superuser);
                            localStorage.setItem('token', token);
                            localStorage.setItem('is_superuser', is_superuser);
                        }
                    ).catch(
                    (error)     =>console.log(error)
                );
            }
        }
    }
</script>