
<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <router-link class="navbar-brand" to="/">Home</router-link>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            
            <router-link v-if="isLogin" class="nav-item nav-link" to="/profile">Tài khoản</router-link>
            <button @click="logout" v-if="isLogin" class="nav-item nav-link" to="/logout">Đăng xuất</button>
            <router-link v-if="!isLogin" class="nav-item nav-link" to="/register">Đăng ký</router-link>
            <router-link v-if="!isLogin" class="nav-item nav-link" to="/login">Đăng nhập</router-link>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import { api } from '../boot/axios';

export default defineComponent ({
    name: "Navbar",
    setup(){
        let isLogin = false;

        const user = localStorage.getItem('user');
        if(user != null){
            isLogin = true;
        }
        return{
            isLogin
        }
    },
    methods:{
        logout(){
            api.post("/user/logout")
            .then((resp) => {
                localStorage.clear();

                if(resp){
                    window.location.href = "/login";
                }
            })
            .catch((err) => {})
        }
    },
});
</script>