<template>
    <v-app>
        <v-main>
            <h1>Fleet Management App</h1>
            <v-form>
                <v-container>
                    <v-row>
                        <v-col>
                        <h2>Fleet</h2>
                        <v-text-field
                            v-model="form.label"
                            label="Add Fleet label"
                        />
                        <v-text-field
                            v-model="form.plateNumber"
                            label="Select Plate number"
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
        </v-main>
    </v-app>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const form = ref({
  label: '',
  plateNumber: ''
})

const vehicles = ref([])

async function sendVehicleForm() {

  const response = await axios.post('/vehicle', form.value)

}

</script>