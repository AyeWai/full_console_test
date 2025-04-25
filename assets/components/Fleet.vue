<template>
    /<v-app>
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
                    <v-select
                        v-model="form.vehiculeId"
                        label="Select Fleet id"
                        :items = [1,2,3,4,5]
                    />
                    </v-col>
                <v-row>
            </v-container>
        </v-form>
    </v-app>
</template>