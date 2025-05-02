<template>
  <v-dialog max-width="500">
    <template v-slot:activator="{ props: activatorProps }">
      <v-btn
        v-bind="activatorProps"
        color="surface-variant"
        text="Create"
        variant="flat"
      ></v-btn>
    </template>

    <template v-slot:default="{ isActive }">
      <v-card title="Dialog">
        <v-card-text>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua.
          <v-text-field v-model="form.plateNumber" label="Add Plate Number" />
          <v-text-field v-model="form.brand" label="Add Brand" />
          <v-btn
            class="mt-2"
            text="Submit"
            @click.prevent="sendVehicleForm"
            block
          ></v-btn>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn text="Close Dialog" @click="isActive.value = false"></v-btn>
        </v-card-actions>
      </v-card>
    </template>
  </v-dialog>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const form = ref({
  plateNumber: "",
  brand: "",
});

async function sendVehicleForm() {
  const response = await axios.post("/vehicle", form.value);
}
</script>
