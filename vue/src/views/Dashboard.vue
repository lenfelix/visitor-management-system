<template>
    <div class="min-h-full">
      <header class="bg-white shadow">
        <div class="flex mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <div class="flex my-auto items-center h-full text-3xl font-bold tracking-tight text-gray-900">
            <p class="my-auto">Dashboard</p>
          </div>

          <div class="ml-auto flex">
            <div class="border border-solid border-#213547 p-5">
              <div>Visitor Inside</div>
              <div> {{todayCI}}</div>
            </div>
            <div class="ml-3 border border-solid border-#213547  p-5">
              <div>Today's Check Out</div> 
                <div>{{todayCO}}</div>
            </div>
          </div>
        </div>
      </header>

      <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
          <div class="mb-4">
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Search by phone number..."
              class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            />
          </div>
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose of Visit</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle Plate No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(visit, i) in tableData" :key="i">
                  <td class="px-6 py-4 whitespace-nowrap">{{visit.visitor.full_name}}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{visit.visitor.phone}}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{visit.purpose_of_visit}}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{visit.vehicle_plate_no ?? "Walk-In"}}</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <!-- {{ (parseInt(visit.checkinout_status) > 0) ? 'In' : 'Out' }} -->
                    <div v-if="parseInt(visit.checkinout_status) > 0">
                      <ArrowLeftCircleIcon style="color: green; width: 40px;"/>
                    </div>
                    <div v-else>
                      <ArrowRightCircleIcon style="color: red; width: 40px;"/>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">{{visit.formatted_updated_at}}</td>
                  <td><button @click="checkout(visit.id)" v-if="visit.checkinout_status > 0" style="font-size: 13px;">Check Out</button></td>
                </tr>
            </tbody>
          </table>
          <div style="text-align: center;" class="w-full mt-5" v-if="tableData.length == 0">No Records Found.</div>
        </div>
      </main>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { ArrowLeftCircleIcon } from "@heroicons/vue/24/solid";
  import { ArrowRightCircleIcon } from "@heroicons/vue/24/solid";
  import { debounce } from 'lodash';

  export default {
    components: {
      ArrowLeftCircleIcon,
      ArrowRightCircleIcon
    },
    data() {
      return {
        tableData: [],
        searchQuery: '',
        todayCI: null,
        todayCO: null,
      };
    },
    mounted() {
      this.fetchTableData();
      console.log('abc');
    },
    methods: {
      fetchTableData() {
        axios
          .get('http://127.0.0.1:80/api/visitation', {
            params: {
              searchQuery: this.searchQuery
            }
          })
          .then(response => {
            this.tableData = response.data.visitation
            if(this.todayCI == null && this.todayCO == null){
              this.todayCI = response.data.todayC1;
              this.todayCO = response.data.todayC0;
            }
          })
          .catch(error => {
            console.error(error);
          });
      },
      checkout(visit_id){
        console.log(visit_id);
        axios.post('http://127.0.0.1:80/api/check-out', {params: { visitation_id: visit_id }})
        .then(response => {
            this.fetchTableData();
          })
          .catch(error => {
            console.error(error);
          });
      }
    },
    computed: {
      filteredTableData() {
        if (this.searchQuery === '') {
          return this.tableData;
        } else {
          const query = this.searchQuery.toLowerCase();
          return this.tableData.filter(visit =>
            visit.visitor.phone.toLowerCase().includes(query)
          );
        }
      },
    },
    watch: {
      searchQuery: debounce(function (newSearchQuery) {
        this.searchQuery = newSearchQuery;
        this.fetchTableData();
      }, 1000),
    },

  };
  </script>