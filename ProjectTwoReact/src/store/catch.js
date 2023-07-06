import { ref } from "../app-lib"
import localforage from 'localforage'

// Setup in memory catchs reactive array.
const catchs = ref([])
const dbName = import.meta.env.VITE_DBNAME


// Setup Database/Key-Value store.
const store = localforage.createInstance({
  name: dbName,
  storeName: 'catch',
  description: 'Fishing Vessel Catchs',
  version: 1
})


export class CatchStore {
  constructor(parentId) {
    this.catchId = parentId
	}

  async _getHaulCatches(tripId) {
    return await store.getItem(`${tripId}`) || []
  }

  async getMany(id = null) {
   return await this._getHaulCatches(id || this.tripId)
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
    // if (! catchs.value.length) {
    //   // load Catchs from indexDB.
    //   await store.iterate((value, key) => {
    //     catchs.value.push(value)
    //   })
    // }

    return catchs
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
    if (! item.dispCode || ! item.haulId || ! item.specName) {
      console.error('Missing a property: tripId, startGps, startDate.')
      // return
    }
    const id = item.haulId
    const state = catchs
    let contents = await this._getHaulCatches(id)

    // Setup Auto Increment ID
    item.id = 1 + this.lastId(contents)

    // Find catch or append a new one.
    // let index = contents.findIndex((val) => val.id == item.id)
    contents.push(item)

    // Reset App State
    state.value.splice(0, state.value.length, contents)

    // Push trips to indexDB
    return await store.setItem(`${id}`, contents)
  }

  async deleteAll() {
    // Clear the proxy; Notify watchers.
    catchs.value.splice(0)

    // Update indexDB??
    return await store.clear((err) => console.log('Store Error Detected: %o', err))
  }
}
