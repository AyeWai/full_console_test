<template>
  <v-col cols="12" md="4">
    <h2 class="mb-4">Vehicle</h2>
    <v-data-table-server
      v-model:items-per-page="itemsPerPage"
      :headers="headers"
      :items="serverItems"
      :items-length="totalItems"
      :loading="loading"
      :search="search"
      item-value="name"
      @update:options="loadItems"
    ></v-data-table-server>
    <v-text-field v-model="form.plateNumber" label="Add Plate Number" />
    <v-text-field v-model="form.brand" label="Add Brand" />
  </v-col>
  <v-btn
    class="mt-2"
    text="Submit"
    @click.prevent="sendVehicleForm"
    block
  ></v-btn>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const form = ref({
  plateNumber: "",
  brand: "",
});

const vehicles = ref([]);

const itemsPerPage = ref(10);

const headers = ref([
  {
    title: "Plate Number",
    align: "start",
    sortable: false,
    key: "plate_number",
  },
  { title: "Brand", key: "brand", align: "end" },
]);

const search = ref("");
const serverItems = ref([]);
const loading = ref(true);
const totalItems = ref(0);
function loadItems({ page, itemsPerPage, sortBy }) {
  loading.value = true;
  axios
    .get("/vehicle", {
      params: {
        page,
        itemsPerPage,
        sortBy: sortBy?.[0]?.key || null,
        sortDesc: sortBy?.[0]?.order === "desc" ? true : false,
      },
    })
    .then((response) => {
      const { items, total } = response.data;
      serverItems.value = items;
      totalItems.value = total;
    })
    .catch((error) => {
      console.error("Error fetching vehicles:", error);
    })
    .finally(() => {
      loading.value = false;
    });
}

async function sendVehicleForm() {
  const response = await axios.post("/vehicle", form.value);
}
</script>
