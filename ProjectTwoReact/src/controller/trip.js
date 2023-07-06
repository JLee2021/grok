import { TripModel } from '../model/trip.js'
import { TripStore } from '../store/trip.js'

export class TripCtrl {
	constructor() {}

	getModel(id) {
    return new TripModel(this.getStore(id))
  }

  getStore(id) {
    return new TripStore(id)
  }
}

