# Radar — Ruby API Reference

## list_geofences

List geofences from Radar with optional filters for tag, group, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of results to return (default: 100, max: 1000) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `tag` | string | no | Filter geofences by tag |
| `group` | string | no | Filter geofences by group identifier |

### Example

```ruby
result = app.integrations.radar.list_geofences(limit: 50, tag: "store")
result.geofences.each do |geofence|
  puts((geofence._id).to_s + ": " + (geofence.description).to_s)
end
```
---

## get_geofence

Retrieve detailed information about a specific geofence by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `geofence_id` | string | yes | The unique identifier of the geofence to retrieve |

### Example

```ruby
result = app.integrations.radar.get_geofence(geofence_id: "5e523d5a91a0bc0046c1bdee")
gf = result.geofence
puts("Name: " + (gf.description).to_s)
puts("Tag: " + ((gf.tag || "none")).to_s)
```
---

## create_geofence

Create a new geofence in Radar with a name, type, and geometry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the geofence |
| `description` | string | no | A description of the geofence |
| `type` | string | no | The geofence type: `"circle"`, `"polygon"`, or `"isochrone"` |
| `coordinates` | string | no | GeoJSON coordinates or a center point (e.g. `"lat,lng"`) |
| `radius` | integer | no | Radius in meters (for circle geofences) |
| `tag` | string | no | A tag to categorize the geofence |
| `group` | string | no | A group identifier for the geofence |
| `external_id` | string | no | An optional external ID for mapping to your own records |
| `metadata` | object | no | Optional custom metadata key-value pairs |

### Example

```ruby
result = app.integrations.radar.create_geofence(name: "Downtown Store", description: "Flagship downtown store geofence", type: "circle", coordinates: "40.70390,-73.98970", radius: 200, tag: "store", group: "nyc")
puts("Created geofence: " + (result.geofence._id).to_s)
```
---

## list_users

List users from Radar with optional filters for tags and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of results to return (default: 100, max: 1000) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `tags` | string | no | Filter users by tags (comma-separated) |

### Example

```ruby
result = app.integrations.radar.list_users(limit: 25, tags: "driver")
result.users.each do |user|
  puts((user._id).to_s + ": " + ((user.description || "unnamed")).to_s)
end
```
---

## get_user

Retrieve detailed information about a specific Radar user by their ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | The unique identifier of the user to retrieve |

### Example

```ruby
result = app.integrations.radar.get_user(user_id: "5e523d5a91a0bc0046c1bdee")
user = result.user
puts("User: " + (user._id).to_s)
puts("Location: " + (user.location.latitude).to_s + ", " + (user.location.longitude).to_s)
```
---

## list_events

List events from Radar with optional filters for type, user, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of results to return (default: 100, max: 1000) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `type` | string | no | Filter by event type, e.g. `"user.entered_geofence"`, `"user.exited_geofence"` |
| `user_id` | string | no | Filter events by user ID |
| `geofence_id` | string | no | Filter events by geofence ID |

### Example

```ruby
result = app.integrations.radar.list_events(limit: 50, type: "user.entered_geofence")
result.events.each do |event|
  puts((event.type).to_s + " at " + (event.createdAt).to_s)
  puts("  User: " + (event.user._id).to_s)
  puts("  Geofence: " + (event.geofence._id).to_s)
end
```
---

## get_current_user

Get the currently authenticated Radar user's account information.

### Parameters

This tool takes no parameters.

### Example

```ruby
result = app.integrations.radar.current_user()
user = result.user
puts("Logged in as: " + ((user.description || user._id)).to_s)
puts("Email: " + ((user.email || "N/A")).to_s)
```
---

## Multi-Account Usage

```ruby
# Default account
app.integrations.radar.list_geofences()
# Named accounts
app.integrations.radar.logistics.list_geofences()
app.integrations.radar.fleet.list_events()
```