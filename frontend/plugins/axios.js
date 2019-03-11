export default function ({ $axios, store, app }) {
  const { user } = store.state
  const token = user ? user.api_token : '' 

  $axios.setToken(token)

  $axios.onRequest(config => {
    console.log('Making request to ' + config.url)
  })

  $axios.onError(error => {
    const code = parseInt(error.response && error.response.status)
    if (code === 400 || code === 404) {
      app.$toast.error(error.response.data.error)
    } 
    // else if(code !== 422 && code !== 404){
    //   app.$toast.error(error.message)
    // }
  })
}