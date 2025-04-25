<template>
  <v-app>
    <v-main>
        <h1 class="mb-4">Fleet Management App</h1>
        <v-form >
          <v-container>
            <v-row>
              <v-col cols="12" md="4">
                <h2 class="mb-4">Vehicle</h2>
                <v-text-field
                  v-model="form.plateNumber"
                  label="Add Plate Number"
                />
                <v-text-field
                  v-model="form.brand"
                  label="Add Brand"
                />
              </v-col>
              <v-btn
                class="mt-2"
                text="Submit"
                @click.prevent="sendVehicleForm"
                block
              ></v-btn>
            </v-row>
          </v-container>
        </v-form>
        <v-list>
          <v-list-item v-for="(vehicle, index) in vehicles" :key="index">
            <v-list-item-title>{{ task }}</v-list-item-title>
          </v-list-item>
        </v-list>
    </v-main>
  </v-app>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const form = ref({
  plateNumber: '',
  brand: ''
})

const vehicles = ref([])

async function sendVehicleForm() {

  const response = await axios.post('/vehicle', form.value)

}

</script>
