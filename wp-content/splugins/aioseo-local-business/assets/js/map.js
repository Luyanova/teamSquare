const aioseoMapOptions = window.aioseoMapOptions || {}
document.addEventListener(aioseoMapOptions.mapLoadEvent, function (e) {
	if (null === e.detail || !e.detail || !e.detail.element || !e.detail.mapOptions) {
		return
	}

	const elem = document.querySelector(e.detail.element)
	if (!elem) {
		return
	}

	if (e.detail.placeId) {
		const frame = document.createElement('iframe')
		frame.style.width = e.detail.instance.width
		frame.style.height = e.detail.instance.height
		frame.style.border = '0'
		frame.frameborder = '0'
		frame.src = 'https://www.google.com/maps/embed/v1/place?key=' + aioseoMapOptions.apiKey + '&q=place_id:' + e.detail.placeId
		elem.replaceChildren(frame)
		return
	}

	// eslint-disable-next-line no-undef
	const Loader = new google.maps.plugins.loader.Loader({
		// eslint-disable-next-line no-undef
		apiKey    : aioseoMapOptions.apiKey,
		libraries : [ 'places' ]
	})

	Loader.load()
		.then((google) => {
			const map = new google.maps.Map(elem, e.detail.mapOptions)

			const marker = new google.maps.Marker({
				map      : map,
				position : e.detail.mapOptions.center,
				icon     : e.detail.customMarker
					? {
						url        : e.detail.customMarker,
						origin     : new google.maps.Point(0, 0),
						anchor     : new google.maps.Point(17, 34),
						scaledSize : new google.maps.Size(25, 25)
					}
					: null
			})

			if (e.detail.infoWindowContent) {
				const infoWindow = new google.maps.InfoWindow({
					content : e.detail.infoWindowContent
				})

				infoWindow.open(map, marker)

				marker.addListener('click', () => {
					infoWindow.open({
						anchor      : marker,
						map,
						shouldFocus : false
					})
				})
			}
		})
		.catch(e => {
			console.log(e)
		})
})