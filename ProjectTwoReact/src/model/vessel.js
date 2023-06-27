export class VesselModel {
	constructor(store) {
		this.store = store;
	}

	// Get a vessel from memory.
	getVessel(id) {
		return this.store.getMany(id)
	}
}

