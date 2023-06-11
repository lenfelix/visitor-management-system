<template>
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <div class="w-full text-center"><a style="font-size: 25px; color: #213547; font-weight: bold;">Visitor Management System</a></div>
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
      </div>
  
      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          <div>
            <label for="email" class="py-2 block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
              <input id="email" v-model="user.email" name="email" type="email" autocomplete="email" required="" class="py-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
          </div>
  
          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="py-2 block text-sm font-medium leading-6 text-gray-900">Password</label>
            </div>
            <div class="mt-2">
              <input id="password" v-model="user.password" name="password" type="password" autocomplete="current-password" required="" class="py-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
          </div>
  
          <div style="margin-top: 30px;">
            <button type="submit" @click="login" style="background-color: #213547;" class="py-2 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
          </div>
      </div>
  </template>
  
<script>
import axios from 'axios';
import {computed, reactive, ref, watch, inject} from 'vue';
import { useRouter } from "vue-router";
import store from '../store'

export default {
  setup() {
    const router = useRouter();

    const user = {
        email: '',
        password: ''
    }


    function login(ev){
        ev.preventDefault();

        store
        .dispatch("login", user)
        .then(() => {
            loading.value = false;
            router.push('/dashboard')
        })
        .catch((err) => {
        });
    }



    return {
      login,
      user
    };
  },
};

</script>