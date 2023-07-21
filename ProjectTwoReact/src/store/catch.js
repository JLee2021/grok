import localforage from 'localforage'
import { ref } from "../app-lib"
import { Store } from "./base-store"

// Setup state reactive array.
const state = ref([])
const dbName = import.meta.env.VITE_DBNAME

// Setup Database/Key-Value store.
const store = localforage.createInstance({
  name: dbName,
  storeName: 'catch',
  description: 'Fishing Vessel Catchs',
  version: 1
})

export class CatchStore extends Store {
  constructor(arg = {vpNo, tripId, haulId}) {
    super()
    this.vpNo = arg.vpNo
    this.tripId = arg.tripId
    this.haulId = arg.haulId
	}

  getKey(vpNo = null, tripId = null, haulId = null) {
    if (vpNo && tripId && haulId) {
      return `${vpNo}-${tripId}-${haulId}`
    } else if (this.vpNo && this.tripId && this.haulId) {
      return `${this.vpNo}-${this.tripId}-${this.haulId}`
    }

    console.log(' - Warning: Catch -> is missing: vpNo, tripId, or haulId.')
  }

  async getMany(key = null) {
    key = key ? `${key}` :this.getKey()
    return await store.getItem(key)
  }

	async addMany(items) {
		// Update indexDB
    items.forEach(item => {
      this.addOne(item)
    })
	}

  /**
   * Load catchs from indexDB, return a proxy (Reactive).
   * @returns Catchs Proxy.
   */
  async getRef() {
    // if (! state.value.length) {
    //   // load Catchs from indexDB.
    //   await store.iterate((value, key) => {
    //     state.value.push(value)
    //   })
    // }

    return state
  }

  async addOne(item) {
    // { tripId, startGps, startDate }
    if (! item.dispCode || ! item.haulId || ! item.specName) {
      console.error('Missing a property: tripId, startGps, startDate.')
      // return
    }

    // Get store key, and contents; Update or add an item.
    const key = this.getKey(item.vpNo, item.tripId, item.haulId)
    let contents = await this.getMany(key)
    contents = this.addUpdate(item, contents)

    // Reset App State
    state.value.splice(0, state.value.length, contents)
    await store.setItem(`${key}`, contents)

    // Update state & indexDB
    this.updateState(state, contents)
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
