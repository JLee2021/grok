import { ref } from "../app-lib"
import localforage from 'localforage'

// Setup in memory hauls reactive array.
const hauls = ref([])
const dbName = import.meta.env.VITE_DBNAME


// Setup Database/Key-Value store.
const store = localforage.createInstance({
  name: dbName,
  storeName: 'hauls',
  description: 'Fishing Vessel Hauls',
  version: 1
})


export class HaulStore {
	construtor() {
	}

	async addMany(items) {
    // items = items.length ? items :[]

		// Update indexDB
    items.forEach(item => {
      this.addOne(item)
    })
	}

  /**
   * Load hauls from indexDB, return a proxy (Reactive).
   * @returns Hauls Proxy.
   */
  async getRef() {
    if (! hauls.value.length) {
      // load Hauls from indexDB.
      await store.iterate((value, key) => {
        hauls.value.push(value)
      })
    }

    return hauls
  }

  async addOne(item) {
    if (! item.name || ! item.id) {
      console.error('Missing item.name or item.id param.')
    } else {
      await store.setItem(`${item.id}`, item)
    }

    hauls.value.push(item)
  }

  async deleteAll() {
    // Clear the proxy; Notify watchers.
    hauls.value.splice(0)

    // Update indexDB??
    return await store.clear((err) => console.log('Store Error Detected: %o', err))
  }
}
