import { ref } from "../app-lib"
import localforage from 'localforage'
import { tripApi } from "../service/api"

// Setup in memory vessels reactive array.
const trips = ref([])
const dbName = import.meta.env.VITE_DBNAME


// Setup Database/Key-Value store.
const store = localforage.createInstance({
  name: dbName,
  storeName: 'trips',
  description: 'Fishing Vessel Trips',
  version: 1
})


export class TripStore {
  constructor(parentId) {
    this.vpNo = parentId
  }

  setParent(parentId) {
    this.vpNo = parentId
  }

  async getMany(id) {
    return await this._getVesselTrips(id || this.vpNo)
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
    // if (! trips.value.length) {
    //   // load Trips from indexDB.
    //   await store.iterate((value, key) => {
    //     trips.value.push(value)
    //   })
    // }

    return trips
  }

  async _getVesselTrips(vpNo) {
    return await store.getItem(`${vpNo}`) || []
  }

  async addOne(item) {
    // ctrl.getStore().addOne({ vpNo, obsId, id: tripNum })
    if (! item.vpNo || ! item.obsId || ! item.id) {
      console.error('Missing property: vpNo, obsId, or id.')
      return
    }
    const state = trips
    let contents = await this._getVesselTrips(item.vpNo)

    // Find trip or append a new one.
    let index = contents.findIndex((val) => val.id == item.id)
    contents[index < 0 ? contents.length :index] = { ...item }

    // Reset App State
    state.value.splice(0, state.value.length, contents)

    // Push trips to indexDB
    return await store.setItem(`${item.vpNo}`, contents)
  }

  async deleteAll() {
    // Clear the proxy; Notify watchers.
    trips.value.splice(0)

    // Update indexDB??
    return await store.clear((err) => console.log('Store Error Detected: %o', err))
  }
}
