import { HaulModel } from '../model/haul.js'
import { HaulStore } from '../store/haul.js'

const store = new HaulStore()

export class HaulCtrl {
	constructor() {}

	getModel() { return new HaulModel(store) }

  getStore() { return store }
}

