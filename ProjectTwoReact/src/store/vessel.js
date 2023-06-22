import localforage from 'localforage'

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

	async getOne(id) {
    return await store.getItem(`${id}`)
		// inport indexDb logic.
		// fetch a vessel form indexDb.
	}

	async getMany() {
    const vessels = []
    await store.iterate((value, key) => {
      // console.warn('Vessel: %o, %o', value, key)
      vessels.push(value)
    })
    return vessels
	}

  async addOne(vessel) {
    if (! vessel.name || ! vessel.id) {
      console.error('Missing vessel.name or vessel.id param.')
    } else {
      await store.setItem(`${vessel.id}`, vessel)
    }
  }

  async clearAll() {
    return await store.clear((err) => console.log('Store Error Detected'))
  }
}
