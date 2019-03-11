<template>
<v-app>
  <div id="bg"></div>
  <v-toolbar :clipped-left="clipped" fixed app color="transparent" dense v-if="isAuth">
    <v-spacer></v-spacer>
    <v-toolbar-items>
      <v-btn flat dense class="primary--text text--darken-2 text-capitalize" @click="signOut">sign out</v-btn>
    </v-toolbar-items>
  </v-toolbar>
  <v-content>
    <v-container fill-height>
      <nuxt />
    </v-container>
  </v-content>
  <v-footer :fixed="fixed" app color="transparent" class="white--text">
    <span>&copy; 2019</span>
  </v-footer>
</v-app>
</template>

<script>
export default {
  data() {
    return {
      clipped: false,
      drawer: false,
      fixed: false,
      items: [{
          icon: 'apps',
          title: 'Welcome',
          to: '/'
        },
        {
          icon: 'bubble_chart',
          title: 'Inspire',
          to: '/inspire'
        }
      ],
      title: 'Authentication'
    }
  },
  computed: {
    isAuth() {
      return this.$store.state.user ? true : false
    }
  },
  methods: {
    signOut() {
      this.$store.commit('RESET_STATE')
      this.$router.push('/')
    }
  }
}
</script>
