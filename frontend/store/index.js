export const state = () => ({
  user: false,
  login: true,
  signup: false,
  registeredEmail: ''
})

export const mutations = {
  STORE_USER (state, payload) {
    state.user = payload
  },
  TOGGLE_AUTH (state) {
    state.signup = !state.signup
    state.login = !state.login
  },
  SET_REGISTERED_EMAIL (state, payload) {
    state.registeredEmail = payload
  },
  RESET_STATE (state) {
    state.registeredEmail = '',
    state.user = false
  }
}

export const actions = {
  async register ({ commit }, params) {
    await this.$axios.$post('/register', params)
    commit('SET_REGISTERED_EMAIL', params.email)
  },
  
  async signIn ({ commit }, params) {
    const { data } = await this.$axios.$post('login', params)
    commit('STORE_USER', data)
  },

  async resend ({ commit }, params) {
    try {
      const { data } = await this.$axios.post('resend-verification', params)
      this.$toast.success(data.success)
    } catch(e) {
      console.log(e.response)
    }
  }
}