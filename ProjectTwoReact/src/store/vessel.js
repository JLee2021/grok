const vessels = [{
  name: "Vessel 1",
  id: "181345"
}, {
  name: "Vessel 2",
  id: "242345"
}]

export class VesselStore {
	construtor() {
	}

	getOne(id) {
		// inport indexDb logic.
		// fetch a vessel form indexDb.
	}

	getMany(ids) {
    return vessels
	}

  addOne(vessel) {
    if (! vessel.name || ! vessel.id) {
      console.error('Missing vessel.name or vessel.id param.')
    } else {
      vessels.push(vessel)
    }
  }
}

