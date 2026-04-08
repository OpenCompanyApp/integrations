# Strava — Lua API Reference

## list_activities

List recent activities for the authenticated Strava athlete. Supports pagination and date filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Activities per page (default: 30, max: 200) |
| `before` | integer | no | Unix timestamp — return activities before this time |
| `after` | integer | no | Unix timestamp — return activities after this time |

### Examples

#### List recent activities

```lua
local result = app.integrations.strava.list_activities({
  per_page = 5
})

for _, activity in ipairs(result) do
  print(activity.name .. " — " .. activity.type .. " — " .. activity.start_date)
end
```

#### Filter activities by date range

```lua
local result = app.integrations.strava.list_activities({
  after = 1704067200,   -- 2024-01-01
  before = 1706745600,  -- 2024-02-01
  per_page = 50
})
```

---

## get_activity

Get detailed information about a specific Strava activity.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `activity_id` | integer | yes | The ID of the activity to retrieve |

### Example

```lua
local result = app.integrations.strava.get_activity({
  activity_id = 1234567890
})

print(result.name)
print("Distance: " .. (result.distance / 1000) .. " km")
print("Moving time: " .. result.moving_time .. " seconds")
print("Elevation gain: " .. result.total_elevation_gain .. " m")
```

---

## create_activity

Create a manual activity on Strava.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name of the activity (e.g., "Morning Run") |
| `type` | string | yes | Activity type: Run, Ride, Swim, Hike, Walk, Workout, WeightTraining, Yoga, etc. |
| `start_date_local` | string | yes | ISO 8601 local start date/time (e.g., "2025-01-15T09:30:00") |
| `elapsed_time` | integer | yes | Elapsed time in seconds |
| `description` | string | no | Description of the activity |
| `distance` | number | no | Distance in meters |
| `trainer` | integer | no | Set to 1 if trainer/trainer ride |
| `commute` | integer | no | Set to 1 if commute |

### Example

```lua
local result = app.integrations.strava.create_activity({
  name = "Morning Run",
  type = "Run",
  start_date_local = "2025-01-15T09:30:00",
  elapsed_time = 1800,
  distance = 5000,
  description = "Easy 5K run in the park"
})

print("Created activity: " .. result.id .. " — " .. result.name)
```

---

## get_athlete

Get the authenticated athlete's Strava profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.strava.get_athlete({})

print(result.firstname .. " " .. result.lastname)
print("Followers: " .. result.follower_count)
print("Following: " .. result.friend_count)
print("City: " .. (result.city or "N/A"))
print("Country: " .. (result.country or "N/A"))
```

---

## list_clubs

List clubs the authenticated athlete belongs to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Clubs per page (default: 30) |

### Example

```lua
local result = app.integrations.strava.list_clubs({
  per_page = 10
})

for _, club in ipairs(result) do
  print(club.name .. " — " .. club.sport_type .. " — " .. club.member_count .. " members")
end
```

---

## get_current_user

Get the current authenticated user's Strava profile. This is an alias for `get_athlete`.

### Parameters

None.

### Example

```lua
local result = app.integrations.strava.get_current_user({})

print("Logged in as: " .. result.firstname .. " " .. result.lastname)
```

---

## Multi-Account Usage

If you have multiple Strava accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.strava.list_activities({})

-- Explicit default (portable across setups)
app.integrations.strava.default.list_activities({})

-- Named accounts
app.integrations.strava.personal.list_activities({})
app.integrations.strava.team.list_activities({})
```

All functions are identical across accounts — only the credentials differ.
