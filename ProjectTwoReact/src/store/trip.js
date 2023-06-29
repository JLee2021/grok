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
	construtor() {
	}

  async update(vpNo) {
    if (! vpNo) {
      console.error('Update was passed an empty vpNo. ')
    }

    return await store.getItem(vpNo).then(items => {
      items = items || []
      trips.value.splice(0)
      items.forEach(item => trips.value.push(item))
    })

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
    if (! trips.value.length) {
      // load Trips from indexDB.
      await store.iterate((value, key) => {
        trips.value.push(value)
      })
    }

    return trips
  }

  async addOne(item) {
    // ctrl.getStore().addOne({ vpNo, obsId, id: tripNum })
    if (! item.vpNo || ! item.obsId || ! item.id) {
      console.error('Missing property: vpNo, obsId, or id.')
      return
    }

    // Get trip list; Or start one.
    let tripList = await store.getItem(item.vpNo) || []

    const index = tripList.findIndex((t) => t.id == item.id)
    if (index > -1) {
      tripList[index] = { ...item } // Update
    } else {
      tripList.push({ ...item }) // Create
    }

    // Reset App State
    trips.value.splice(0)
    tripList.forEach(t => trips.value.push(t))
    await this.update(item.vpNo)

    // Push trips to indexDB
    return await store.setItem(`${item.vpNo}`, tripList)
  }

  async deleteAll() {
    // Clear the proxy; Notify watchers.
    trips.value.splice(0)

    // Update indexDB??
    return await store.clear((err) => console.log('Store Error Detected: %o', err))
  }
}
