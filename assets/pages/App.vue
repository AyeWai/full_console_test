<script setup>
import { ref } from "vue";
import axios from "axios";
import Vehicle from "../components/Vehicle.vue";
import Fleet from "../components/Fleet.vue";
import DialogueVehicle from "../components/DialogueVehicle.vue";

const form = ref({
  label: "",
  plateNumber: "",
});

const vehicles = ref([]);

const tab = ref(null);

async function sendVehicleForm() {
  const response = await axios.post("/vehicle", form.value);
}
</script>

<template>
  <v-app>
    <v-main>
      <h1>Fleet Management App</h1>
      <v-card>
        <v-tabs v-model="tab" bg-color="primary">
          <v-tab value="vehicle">Vehicle</v-tab>
          <v-tab value="fleet">Fleet</v-tab>
        </v-tabs>

        <v-card-text>
          <v-tabs-window v-model="tab">
            <v-tabs-window-item value="vehicle">
              <Vehicle />
              <DialogueVehicle />
            </v-tabs-window-item>

            <v-tabs-window-item value="fleet">
              <Fleet />
              <Dialogue />
            </v-tabs-window-item>
          </v-tabs-window>
        </v-card-text>
      </v-card>
    </v-main>
  </v-app>
</template>
