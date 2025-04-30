<script setup>
import { ref } from 'vue'
import axios from 'axios'
import Vehicle from '../components/Vehicle.vue';
import Fleet from '../components/Fleet.vue';

const form = ref({
  label: '',
  plateNumber: ''
})

const vehicles = ref([])

async function sendVehicleForm() {

  const response = await axios.post('/vehicle', form.value)

}
</script>

<template>
    <v-app>
        <v-main>
            <h1>Fleet Management App</h1>
            <v-form>
                <v-container>
                    <v-row>
                        <Vehicle/>
                        <Fleet/>
                    </v-row>
                </v-container>
            </v-form>
        </v-main>
    </v-app>
</template>
