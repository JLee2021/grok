import { ref } from "../app-lib"
import localforage from 'localforage'
// import { loginApi } from "../service/api"

// Setup in memory vessels reactive array.
const login = ref({})
const dbName = import.meta.env.VITE_DBNAME


// Setup Database/Key-Value store.
const store = localforage.createInstance({
  name: dbName,
  storeName: 'user',
  description: 'User Info: login, tokens, name, preferences, etc.',
  version: 1
})


export class LoginStore {
	construtor() {
	}

  async update() {
  }

	async addMany(items) {
		// Update indexDB
    for (const item of items) {
      await this.addOne(item)
    }
	}

  /**
   * Load user info from indexDB, return a proxy (Reactive).
   * @returns Login Proxy.
   */
  async getRef() {
    if (! login.value) {
      // load Logins from indexDB.
      await store.iterate((value, key) => {
        login.value.push(value)
      })
    }

    return login
  }

  async addOne(item) {
    // Get user profile; Or start one.
    let user = await store.getItem(item.id) || {}

    user = { ...item } // Update

    // if (user.auth) {
    // } else {
    // }

    // Reset App State
    login.value.name = user.name
    login.value.auth = user.auth

    // Push login to indexDB
    return await store.setItem(`${item.id}`, user)
  }

  async deleteAll() {
    // Clear the proxy; Notify watchers.
    Object.keys(login.value).forEach((key) => delete login.value[val])

    // Update indexDB??
    return await store.clear((err) => console.log('Store Error Detected: %o', err))
  }
}
