import { ref } from "../app-lib"
import localforage from 'localforage'

// Setup in memory vessels reactive array.
const vessels = ref([])
const dbName = import.meta.env.VITE_DBNAME


// Setup Database/Key-Value store.
const store = localforage.createInstance({
  name: dbName,
  storeName: 'vessels',
  description: 'Fishing Vessels',
  version: 1
})


export class VesselStore {
	construtor() {
	}

	async addMany(items) {
    // items = items.length ? items :[]
    // this.deleteAll()

		// Update indexDB
    items.forEach(vessel => {
      this.addOne(vessel)
    })
	}

  /**
   * Load vessels from indexDB, return a proxy (Reactive).
   * @returns Vessels Proxy.
   */
  async getRef() {
    if (! vessels.value.length) {
      // load Vessels from indexDB.
      await store.iterate((value, key) => {
        vessels.value.push(value)
      })
    }

    return vessels
  }

  async addOne(vessel) {
    if (! vessel.name || ! vessel.vpNo) {
      console.error('Missing vessel.name or vessel.vpNo param.')
    } else {
      await store.setItem(`${vessel.vpNo}`, vessel)
    }

    vessels.value.push(vessel)
  }

  async deleteAll() {
    // Clear the proxy; Notify watchers.
    vessels.value.splice(0)

    // Update indexDB??
    return await store.clear((err) => console.log('Store Error Detected: %o', err))
  }
}
