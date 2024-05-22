<template>
    <v-layout>
      <v-app-bar>
        <v-app-bar-nav-icon app variant="text" @click.stop="drawer = !drawer" style="position: absolute; right: 0;"></v-app-bar-nav-icon>
      </v-app-bar>

      <v-navigation-drawer v-model="drawer">
        <v-list>
            
          <v-switch
            style="position: fixed; bottom: 0px; left: 30px;"
            @change="toggleTheme()"
            :label="'change to ' + themeName"
          ></v-switch>
        </v-list>
      </v-navigation-drawer>

      <v-main style="min-height: 300px; padding-bottom: 100px;">
        <router-view></router-view>
        <v-overlay scrollStrategy="block" v-model="store.getters.isLoading"></v-overlay>
      </v-main>
      <notifications position="bottom right"/>
    </v-layout>
</template>

<script setup>
  import { useTheme } from 'vuetify';
  import { ref, computed } from 'vue';
  import { useRoute } from 'vue-router';
  import { useStore } from 'vuex';
  import { useNotification } from "@kyvg/vue3-notification";
  import { useRouter } from 'vue-router';
  import { onMounted } from 'vue';

  const route = useRoute();
  const store = useStore();
  const router = useRouter();
  const { notify } = useNotification();
  const theme = useTheme();

  const drawer = ref(false);

  const themeName = computed(() => {
    return theme.global.current.value.dark ? 'light' : 'dark';
  });

  function toggleTheme() {
    theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark';
    store.commit('setViewMode', theme.global.name.value);
  };

  onMounted(async () => {
    store.commit('setRoute', route);
    store.commit('setRouter', router);
    store.commit('setNotify', notify);
    
    theme.global.name.value = store.state.viewMode;
  });

</script>