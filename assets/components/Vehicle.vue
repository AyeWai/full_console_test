<template>
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
