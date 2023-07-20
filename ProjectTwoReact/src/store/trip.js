import { ref } from "../app-lib"
import localforage from 'localforage'
import { Store } from "./base-store"

// Setup in memory vessels reactive array.
const state = ref([])
const dbName = import.meta.env.VITE_DBNAME


// Setup Database/Key-Value store.
const store = localforage.createInstance({
  name: dbName,
  storeName: 'trips',
  description: 'Fishing Vessel Trips',
  version: 1
})
class Page {
  constructor() {
    // Links: next, previous, first, last
    this.limit = 10
    this.offset = 1
  }

}

export class TripStore extends Store {
  constructor(vpNo) {
    super()
    this.vpNo = vpNo
  }

  async getMany(key) {
    key = this.getKey(key)
    return await store.getItem(key) || []
  }

  getKey(vpNo) {
    return vpNo || this.vpNo
  }

	async addMany(items) {
		// Update indexDB
    for (const item of items) {
      await this.addOne(item)
    }
	}

  /**
   * Load vessels from indexDB, return a proxy (Reactive).
   * @returns Vessels Proxy.
   */
  async getRef() {
    // if (! state.value.length) {
    //   // load Trips from indexDB.
    //   await store.iterate((value, key) => {
    //     state.value.push(value)
    //   })
    // }

    return state
  }

  async getOne(tripId, vpNo) {
    const state = await store.getItem(`${vpNo}`) || []
    return state.find((value) => value.id == tripId)
  }

  async addOne(item) {
    // ctrl.getStore().addOne({ vpNo, obsId, id: tripNum })
    if (! item.vpNo || ! item.obsId) {
      console.error('Missing property: vpNo, obsId.')
      return
    }

    const key = this.getKey(item.vpNo)
    let contents = await this.getMany(key)
    contents = super.addUpdate(item, contents)

    // Update state & indexDB
    super.updateState(state, contents)
    await store.setItem(key, contents)

    // Return trip
    return item
  }

  async deleteAll() {
    // Clear the proxy; Notify watchers.
    state.value.splice(0)

    // Update indexDB??
    return await store.clear((err) => console.log('Store Error Detected: %o', err))
  }
}
