import { VesselModel } from '../model/vessel.js'
import { VesselStore } from '../store/vessel.js'

export class VesselCtrl {
	constructor() {}

	getModel(id) { return new VesselModel(this.getStore(id)) }
  getStore(id) { return new VesselStore(id) }
}

