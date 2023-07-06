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
  constructor(parentId) {
    this.tripId = parentId
	}

  async _getTripHauls(tripId) {
    return await store.getItem(`${tripId}`) || []
  }

  async getMany(id = null) {
   return await this._getTripHauls(id || this.tripId)
  }


	async addMany(items) {
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
    // if (! hauls.value.length) {
    //   // load Hauls from indexDB.
    //   await store.iterate((value, key) => {
    //     hauls.value.push(value)
    //   })
    // }

    return hauls
  }

  lastId(items) {
    return items.reduce((res, cur) => {
      return cur.id > res
        ? cur.id
        : res
    }, 0)
  }

  async addOne(item) {
    // { tripId, startGps, startDate }
    if (! item.tripId || ! item.startGps || ! item.startDate) {
      console.error('Missing a property: tripId, startGps, startDate.')
      return
    }

    const state = hauls
    let contents = await this._getTripHauls(item.tripId)

    // Setup Auto Increment ID
    item.id = 1 + this.lastId(contents)

    // Find haul or append a new one.
    // let index = contents.findIndex((val) => val.id == item.id)
    contents.push(item)

    // Reset App State
    state.value.splice(0, state.value.length, contents)

    // Push trips to indexDB
    return await store.setItem(`${item.tripId}`, contents)
  }

  async deleteAll() {
    // Clear the proxy; Notify watchers.
    hauls.value.splice(0)

    // Update indexDB??
    return await store.clear((err) => console.log('Store Error Detected: %o', err))
  }
}
