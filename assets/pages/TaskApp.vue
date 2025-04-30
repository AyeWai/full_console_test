<template>
  <v-app>
    <v-main>
      <v-container>
        <h1 class="text-h4 mb-4">📝 Tasks</h1>
        <v-text-field
          v-model="newTask"
          label="Add task"
          @keyup.enter="addTask"
          append-icon="mdi-plus"
          @click:append="addTask"
        />
        <v-list>
          <v-list-item v-for="(task, index) in tasks" :key="index">
            <v-list-item-title>{{ task }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-container>
    </v-main>
  </v-app>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const newTask = ref('')
const tasks = ref([])

async function addTask() {
  const title = newTask.value.trim()
  if (!title) return

  try {
    const response = await axios.post('/api/tasks', { title })
    tasks.value.push(title)
    newTask.value = ''
  } catch (error) {
    console.error('Error adding task:', error)
  }
}
</script>
