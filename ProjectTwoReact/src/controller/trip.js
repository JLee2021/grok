import { TripModel } from '../model/trip.js'
import { TripStore } from '../store/trip.js'

const store = new TripStore()

export class TripCtrl {
	constructor() {}

	getModel() { return new TripModel(store) }

  getStore() { return store }
}

