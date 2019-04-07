<template>
    <v-card color="#262e36">
        <v-card-title :class="meta.color" class=" white--text">
            <span class="subheading">{{ meta.name }}</span>
            <v-spacer></v-spacer>
        </v-card-title>
        <v-card-text>
            <v-container fluid grid-list-md>
                <v-layout wrap>
                    <v-flex xs6 sm6 md2 v-for="menu in menudata" :key="menu.id">
                        <router-link :to="menu.url">
                            <v-sheet
                            class="d-flex"
                            color="#3a4149"
                            >
                                <v-card flat style="background: none" class="py-4 link-menu">
                                    <v-card-text class="white--text">
                                        <v-icon dark x-large class="outlined">{{ menu.icon }}</v-icon>
                                        <div class="subheading py-2">{{ menu.name }}</div>
                                    </v-card-text>
                                </v-card>
                            </v-sheet>
                        </router-link>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: "MenuItem",
    props: {
        menudata: Array,
        meta: Object
    }
}
</script>

<style>
    a {
        text-decoration: none !important;
    }
</style>
