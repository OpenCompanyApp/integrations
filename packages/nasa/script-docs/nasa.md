# NASA JavaScript API Reference

Namespace: `app.integrations.nasa`

NASA tools use three public NASA surfaces:

- `api.nasa.gov` for APOD, Mars rover photos, NeoWs, DONKI, EPIC, and Earth imagery/assets. These requests send the configured API key or `DEMO_KEY`.
- `images-api.nasa.gov` for Image and Video Library search, assets, metadata, and captions. These requests do not send the API key.
- `eonet.gsfc.nasa.gov/api/v3` for EONET natural events. These requests do not send the API key.

## APOD

`get_apod({ date?, start_date?, end_date?, count?, thumbs? })`

Returns a single APOD entry, `entries` when a date range or random count returns multiple entries, and includes `thumbnail_url` for videos when requested and available.

```js
var apod = app.integrations.nasa.get_apod({
  date: "2026-01-15",
  thumbs: true,
})

console.log(apod.title)
console.log(apod.url)
```
## Mars Rover Photos

`get_mars_rover_photos({ rover, sol?, earth_date?, camera?, page? })`

Use `sol` or `earth_date`. Rovers include `curiosity`, `opportunity`, `spirit`, and `perseverance`.

```js
var photos = app.integrations.nasa.get_mars_rover_photos({
  rover: "curiosity",
  sol: 1000,
  camera: "MAST",
})

for (const photo of (photos.photos)) {
  console.log(photo.earth_date + " " + photo.img_src)
}
```
## Asteroids

`get_asteroids({ start_date?, end_date? })`

Returns a NeoWs feed grouped by date. NASA limits feed date ranges to about seven days.

`browse_asteroids({ page?, size? })`

Browses the overall NeoWs dataset and is useful for finding asteroid IDs.

`get_asteroid({ id })`

Fetches one asteroid by NASA/JPL ID.

```js
var feed = app.integrations.nasa.get_asteroids({
  start_date: "2026-01-01",
  end_date: "2026-01-07",
})

console.log(feed.total_asteroids)
```
## DONKI

`get_donki_events({ type, start_date?, end_date?, most_accurate_only?, complete_entry_only?, speed?, half_angle?, catalog?, keyword?, location?, notification_type? })`

Supported `type` values are `CME`, `CMEAnalysis`, `GST`, `IPS`, `FLR`, `SEP`, `MPC`, `RBE`, `HSS`, `WSAEnlilSimulations`, and `notifications`.

```js
var flares = app.integrations.nasa.get_donki_events({
  type: "FLR",
  start_date: "2026-01-01",
  end_date: "2026-01-07",
})
```
## EPIC

`get_epic_images({ collection?, date?, all_dates? })`

`collection` is `natural` or `enhanced`. With no date, the tool returns latest image metadata. With `all_dates = true`, it returns available dates instead of image metadata.

```js
var latest = app.integrations.nasa.get_epic_images({
  collection: "natural",
})

var dates = app.integrations.nasa.get_epic_images({
  collection: "enhanced",
  all_dates: true,
})
```
## Earth

`get_earth_imagery({ lon, lat, date?, dim? })`

Returns NASA Earth imagery data for a coordinate. Some NASA responses are binary image content; in that case the tool returns `content_type`, `size_bytes`, and a note instead of embedding the image bytes.

`get_earth_assets({ lon, lat, date?, dim? })`

Returns available Earth asset dates for a coordinate.

```js
var assets = app.integrations.nasa.get_earth_assets({
  lon: -122.4194,
  lat: 37.7749,
  date: "2026-01-01",
})
```
## Image Library

`search_images({ q, media_type?, page?, year_start?, year_end?, center?, keywords?, nasa_id? })`

Searches the NASA Image and Video Library and returns normalized items with `nasa_id`, `title`, `description`, `date_created`, `media_type`, `keywords`, `center`, `photographer`, `thumbnail`, and `links`.

`get_image_asset({ nasa_id })`

Returns the asset manifest for a media ID.

`get_image_metadata({ nasa_id })`

Returns the metadata document for a media ID.

`get_image_captions({ nasa_id })`

Returns caption file locations for a media ID.

```js
var results = app.integrations.nasa.search_images({
  q: "apollo 11",
  media_type: "image",
})

var first = results.items[0]
var asset = app.integrations.nasa.get_image_asset({
  nasa_id: first.nasa_id,
})
```
## EONET

`get_eonet_events({ status?, category?, source?, limit?, days?, start?, end? })`

Lists EONET v3 natural events.

`get_eonet_event({ id })`

Fetches one event by ID.

`get_eonet_categories({})`

Lists category IDs for filters.

`get_eonet_sources({})`

Lists source IDs for filters.

```js
var events = app.integrations.nasa.get_eonet_events({
  status: "open",
  category: "wildfires",
  limit: 10,
})

for (const event of (events.events || [])) {
  console.log(event.id + " " + event.title)
}
```