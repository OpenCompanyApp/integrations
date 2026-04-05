# Strava — Lua API Reference

## list_activities

List recent activities for the authenticated athlete.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Items per page (default: 30, max: 200) |

### Examples

```lua
local result = app.integrations.strava.list_activities({
  page = 1,
  per_page = 10
})

for _, activity in ipairs(result) do
  print(activity.name .. " - " .. activity.type .. " - " .. activity.start_date)
end
```

---

## get_activity

Get detailed information about a specific activity.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The activity ID |

### Examples

```lua
local result = app.integrations.strava.get_activity({
  id = 12345678
})

print(result.name)
print("Distance: " .. result.distance .. "m")
print("Moving time: " .. result.moving_time .. "s")
```

---

## create_activity

Create a manual activity entry.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the activity |
| `type` | string | yes | Activity type: "Run", "Ride", "Swim", "Hike", "Walk", "WeightTraining", etc. |
| `start_date_local` | string | yes | Local start date/time (ISO 8601, e.g. `"2026-04-05T10:00:00"`) |
| `elapsed_time` | integer | yes | Total elapsed time in seconds |
| `description` | string | no | Description of the activity |
| `distance` | number | no | Distance in meters |
| `trainer` | integer | no | Set to 1 for trainer activity |
| `commute` | integer | no | Set to 1 for commute |

### Examples

```lua
local result = app.integrations.strava.create_activity({
  name = "Morning Run",
  type = "Run",
  start_date_local = "2026-04-05T08:00:00",
  elapsed_time = 1800,
  description = "Easy 5K around the park",
  distance = 5000
})

print("Created activity: " .. result.id .. " - " .. result.name)
```

---

## get_athlete

Get the authenticated athlete's profile.

### Parameters

None.

### Examples

```lua
local result = app.integrations.strava.get_athlete({})

print(result.firstname .. " " .. result.lastname)
print("Followers: " .. result.follower_count)
print("Following: " .. result.friend_count)
```

---

## list_routes

List routes for a specific athlete.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `athlete_id` | integer | yes | The athlete ID |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Items per page (default: 30) |

### Examples

```lua
local result = app.integrations.strava.list_routes({
  athlete_id = 12345,
  per_page = 10
})

for _, route in ipairs(result) do
  print(route.name .. " - " .. route.distance .. "m - " .. route.estimated_moving_time .. "s")
end
```

---

## list_clubs

List clubs the authenticated athlete belongs to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Items per page (default: 30) |

### Examples

```lua
local result = app.integrations.strava.list_clubs({
  per_page = 10
})

for _, club in ipairs(result) do
  print(club.name .. " - " .. club.member_count .. " members")
end
```

---

## get_club

Get details about a specific club.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `club_id` | integer | yes | The club ID |

### Examples

```lua
local result = app.integrations.strava.get_club({
  club_id = 12345
})

print(result.name)
print("Members: " .. result.member_count)
print("Sport type: " .. result.sport_type)
```

---

## get_current_user

Get the currently authenticated athlete's profile.

### Parameters

None.

### Examples

```lua
local result = app.integrations.strava.get_current_user({})

print("Athlete: " .. result.firstname .. " " .. result.lastname)
print("City: " .. (result.city or "N/A"))
print("Country: " .. (result.country or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Strava accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.strava.function_name({...})

-- Explicit default (portable across setups)
app.integrations.strava.default.function_name({...})

-- Named accounts
app.integrations.strava.personal.function_name({...})
app.integrations.strava.work.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
