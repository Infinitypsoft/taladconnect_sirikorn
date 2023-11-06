import store from '../store'

store.subscribe((mutation) => {
  switch (mutation.type) {
    case 'auth/SET_ACCESS_TOKEN':
      if (mutation.payload) {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${mutation.payload}`
        localStorage.setItem('access_token', mutation.payload)
      } else {
        window.axios.defaults.headers.common['Authorization'] = null
        localStorage.removeItem('access_token')
      }
      break;
    case 'auth/SET_ACCESS_TOKEN_U':
      if (mutation.payload) {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${mutation.payload}`
        localStorage.setItem('access_token_u', mutation.payload)
      } else {
        window.axios.defaults.headers.common['Authorization'] = null
        localStorage.removeItem('access_token_u')
      }
      break;

    case 'auth/SET_ROLE':
      if (mutation.payload) {
        localStorage.setItem('role', mutation.payload)
      } else {
        localStorage.removeItem('role')
      }
      break;
    case 'auth/SET_ROLE_U':
      if (mutation.payload) {
        localStorage.setItem('role_u', mutation.payload)
      } else {
        localStorage.removeItem('role_u')
      }
      break;
      case 'auth/SET_PROFILE':
      if (mutation.payload) {
        localStorage.setItem('profile', mutation.payload)
      } else {
        localStorage.removeItem('profile')
      }
      break;
      case 'auth/SET_PROFILE_U':
      if (mutation.payload) {
        localStorage.setItem('profile_u', mutation.payload)
      } else {
        localStorage.removeItem('profile_u')
      }
      break;
    case 'SET_DRAWER':
      if (mutation.payload) {
        localStorage.setItem('drawer', mutation.payload)
      } else {
        localStorage.removeItem('drawer')
        // localStorage.setItem('drawer', true)
      }
      break;
    case 'auth/SET_COOKISE_U':
      if (mutation.payload) {
        localStorage.setItem('cookies_u', mutation.payload)
      } else {
        localStorage.removeItem('cookies_u')
      }
      break;
    case 'SET_MEMO_SESSION':
      if (mutation.payload) {
        localStorage.setItem('memo_session', mutation.payload)
      } else {
        localStorage.removeItem('memo_session')
      }
      break;
  }
})
