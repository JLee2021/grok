import { ref } from "../app-lib"
import localforage from 'localforage'
import { Store } from "./base-store"

// Setup in memory state reactive array.
const state = ref([])
const dbName = import.meta.env.VITE_DBNAME


// Setup Database/Key-Value store.
const store = localforage.createInstance({
  name: dbName,
  storeName: 'hauls',
  description: 'Fishing Vessel Hauls',
  version: 1
})

export class HaulStore extends Store {
  constructor(arg = { vpNo: null, tripId: null }) {
    super()
    this.tripId = arg.tripId
    this.vpNo = arg.vpNo
	}

  getKey(vpNo = null, tripId = null) {
    if (vpNo && tripId) {
      return `${vpNo}-${tripId}`
    } else if (this.vpNo && this.tripId) {
      return `${this.vpNo}-${this.tripId}`
    }

    console.log(' - Warning: Haul -> GetId is missing: vpNo, or tripId.')
  }

  async getMany(key = null) {
    key = key ? `${key}` :this.getKey()
    return await store.getItem(key) || []
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
    // if (! state.value.length) {
    //   // load Hauls from indexDB.
    //   await store.iterate((value, key) => {
    //     state.value.push(value)
    //   })
    // }

    return state
  }


  async getOne(haulId) {
    const trips = await store.getItem(this.getKey()) || []
    return trips.find((value) => value.id == haulId)
  }

  nextId(items) {
    return super.nextId(items)
  }


  async addOne(item) {
    // { tripId, startGps, startDate }
    if (! item.tripId || ! item.startGps || ! item.startDate) {
      console.error('Missing a property: tripId, startGps, startDate.')
      return
    }

    // Get the store sub array and update it.
    const key = this.getKey(item.vpNo, item.tripId)
    let contents = await this.getMany(key)
    contents = this.addUpdate(item, contents)

    // Update state & indexDB
    super.updateState(state, contents)
    await store.setItem(key, contents)

    return item
  }

  async deleteAll() {
    // Clear the proxy; Notify watchers.
    state.value.splice(0)

    // Update indexDB??
    return await store.clear((err) => console.log('Store Error Detected: %o', err))
  }
}
