# Strava Lua API Reference

Namespace: `app.integrations.strava`

Use this integration for Strava athletes, activities, uploads, clubs, routes,
segments, streams, and relative API calls. Returned values are the parsed Strava
JSON response. Route exports and other non-JSON responses return `{ body = "..." }`.

## Athletes

| Function | Purpose |
|----------|---------|
| `get_athlete({})` | Get the authenticated athlete profile. |
| `get_current_user({})` | Alias for authenticated athlete profile. |
| `get_athlete_stats({ athlete_id })` | Get all-time, year-to-date, and recent activity totals. |
| `get_athlete_zones({})` | Get heart rate and power zones for the authenticated athlete. |

## Activities And Uploads

| Function | Purpose |
|----------|---------|
| `list_activities({ page?, per_page?, before?, after? })` | List authenticated athlete activities. `per_page` is capped at 200. |
| `get_activity({ activity_id })` | Get a detailed activity. |
| `create_activity({ name, type, start_date_local, elapsed_time, description?, distance?, trainer?, commute? })` | Create a manual activity. |
| `update_activity({ activity_id, payload })` | Update editable activity fields. |
| `get_activity_streams({ activity_id, keys, resolution?, series_type? })` | Get stream data such as time, distance, latlng, heartrate, cadence, watts, or moving. |
| `list_activity_laps({ activity_id })` | List laps for an activity. |
| `get_activity_zones({ activity_id })` | Get zone distribution for an activity. |
| `upload_activity({ file_path, data_type, name?, description?, trainer?, commute?, external_id? })` | Upload a FIT, TCX, or GPX file for asynchronous processing. |
| `get_upload({ upload_id })` | Poll upload processing status. |

Example:

```lua
local activities = app.integrations.strava.list_activities({ per_page = 5 })

for _, activity in ipairs(activities) do
  print(activity.name .. " " .. activity.type)
end
```

## Clubs

| Function | Purpose |
|----------|---------|
| `list_clubs({ page?, per_page? })` | List clubs the authenticated athlete belongs to. |
| `get_club({ club_id })` | Get one club. |
| `list_club_activities({ club_id, page?, per_page? })` | List recent activities for club members. |
| `list_club_members({ club_id, page?, per_page? })` | List club members. |

Club activity and member endpoints require the authenticated athlete to belong
to the club.

## Routes

| Function | Purpose |
|----------|---------|
| `list_routes({ athlete_id, page?, per_page? })` | List routes created by an athlete. |
| `get_route({ route_id })` | Get route details. |
| `export_route({ route_id, format })` | Export route as `gpx` or `tcx`. |
| `get_route_streams({ route_id })` | Get route coordinate and elevation streams. |

## Segments

| Function | Purpose |
|----------|---------|
| `list_starred_segments({ page?, per_page? })` | List starred segments for the authenticated athlete. |
| `get_segment({ segment_id })` | Get one segment. |
| `star_segment({ segment_id, starred })` | Star or unstar a segment. |
| `explore_segments({ bounds, activity_type?, min_cat?, max_cat? })` | Explore top segments in a bounding box. |
| `list_segment_efforts({ segment_id, start_date_local?, end_date_local?, page?, per_page? })` | List efforts for a segment. |
| `get_segment_effort({ effort_id })` | Get one segment effort. |
| `get_segment_streams({ segment_id, keys, resolution?, series_type? })` | Get stream data for a segment. |

`bounds` is `[sw_lat, sw_lng, ne_lat, ne_lng]`. Segment streams use the same
key style as activity streams.

## Generic API Helpers

| Function | Purpose |
|----------|---------|
| `api_get({ path, params? })` | Send GET to a relative Strava API path. |
| `api_post({ path, payload? })` | Send POST to a relative Strava API path. |
| `api_put({ path, payload? })` | Send PUT to a relative Strava API path. |
| `api_delete({ path, payload? })` | Send DELETE to a relative Strava API path. |

Generic helpers reject absolute URLs. Use relative paths such as `/athlete`,
`/activities/{id}`, `/segments/starred`, or `/routes/{id}` so the host controls
credentials and base URL handling.

## Multi-Account Usage

All functions work under account-specific namespaces:

```lua
app.integrations.strava.list_activities({})
app.integrations.strava.default.list_activities({})
app.integrations.strava.personal.list_activities({})
```
