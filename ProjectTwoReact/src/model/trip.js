export class TripModel {
	constructor(store) {
		this.store = store;
	}

	// Get a vessel from memory.
	getTrip(id) {
		return this.store.getMany(id)
	}
}

