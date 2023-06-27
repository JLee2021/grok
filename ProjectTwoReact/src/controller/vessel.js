import { VesselModel } from '../model/vessel.js'
import { VesselStore } from '../store/vessel.js'

const store = new VesselStore()

export class VesselCtrl {
	constructor() {
	}

	getModel() {
		return new VesselModel(store)
	}

  getStore() {
    return store
  }
}


