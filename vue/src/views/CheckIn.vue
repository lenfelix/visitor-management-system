<template>
    <div class="min-h-full">
      <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <h1 class="text-3xl font-bold tracking-tight text-gray-900">Check In</h1>
        </div>
      </header>

      <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="flex">
                <div class="w-1/2 mr-2">
                    <label for="name" class="py-2 block text-sm font-medium leading-6 text-gray-900">Full Name *</label>
                    <div class="mt-2">
                        <input id="name" v-model="data.name" name="name" type="text" autocomplete="name" required="" class="py-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>
                <div class="w-1/2 ml-2">
                    <label for="identity" class="py-2 block text-sm font-medium leading-6 text-gray-900">NRIC/Passport *</label>
                    <div class="mt-2">
                        <input id="identity" v-model="data.identity" name="identity" type="text" autocomplete="identity" required="" class="py-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2 mr-2">
                    <label for="phone" class="py-2 block text-sm font-medium leading-6 text-gray-900">Contact No *</label>
                    <div class="mt-2">
                        <input id="phone" v-model="data.phone" name="phone" type="text" autocomplete="phone" required="" class="py-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>
                <div class="w-1/2 ml-2">
                    <label for="vehicleno" class="py-2 block text-sm font-medium leading-6 text-gray-900">Vehicle Number</label>
                    <div class="mt-2">
                        <input id="vehicleno" v-model="data.vehicleno" name="vehicleno" type="text" autocomplete="vehicleno" required="" placeholder="Walk-In Leave Blank" class="py-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>
            </div>
            <div>
                <label for="purpose" class="py-2 block text-sm font-medium leading-6 text-gray-900">Purpose of visiting *</label>
                <div class="mt-2">
                    <input id="purpose" v-model="data.purpose" name="purpose" type="text" autocomplete="purpose" required="" class="py-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                </div>
            </div>

            <div>
                <label for="remarks" class="py-2 block text-sm font-medium leading-6 text-gray-900">Remarks</label>
                <div class="mt-2">
                    <textarea v-model="data.remarks" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" rows="4" placeholder="Enter remarks"></textarea>
                </div>
            </div>

            <div>
                <button type="submit" @click="checkIn" style="background-color: #213547;" class="py-2 mt-4 ml-auto flex w-1/6 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>    
            </div>
        </div>
      </main>
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

    const data = {
        name: '',
        identity: '',
        phone: '',
        vehicleno: '',
        purpose: '',
        remarks: ''
    }


    function checkIn(){
        axios.post('http://127.0.0.1:80/api/check-in', data).then(res => {
            console.log(res);
            router.push('/dashboard');
        })

        
    }


    return {
      checkIn,
      data
    };
  },
};


</script>
