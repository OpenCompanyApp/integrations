# Zoom — JavaScript API Reference

## list_meetings

List meetings for a Zoom user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | no | User ID or `"me"` for the authenticated user. Default: `"me"`. |
| `type` | string | no | Meeting type filter: `scheduled`, `live`, or `upcoming`. Default: `"live"`. |
| `page_size` | integer | no | Number of meetings per page (1–300). Default: 30. |
| `next_page_token` | string | no | Token for the next page of results. |

### Response

Returns an object with `meetings` array:

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | Meeting ID |
| `topic` | string | Meeting topic/title |
| `type` | integer | Meeting type (1=instant, 2=scheduled, 3=recurring no time, 8=recurring) |
| `start_time` | string | Start time (ISO 8601) |
| `duration` | integer | Duration in minutes |
| `timezone` | string | Meeting timezone |
| `join_url` | string | URL to join the meeting |

### Example

```js
var meetings = app.integrations.zoom.list_meetings({
  type: "live",
  page_size: 20,
})

for (const m of (meetings.meetings || [])) {
  console.log(m.topic + " at " + m.start_time + " (" + m.duration + " min)")
}
```
---

## get_meeting

Get details of a specific meeting by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `meeting_id` | string | yes | The meeting ID or UUID. |

### Response

Returns the full meeting object:

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | Meeting ID |
| `topic` | string | Meeting topic/title |
| `type` | integer | Meeting type |
| `start_time` | string | Start time (ISO 8601) |
| `duration` | integer | Duration in minutes |
| `timezone` | string | Meeting timezone |
| `agenda` | string | Meeting agenda/description |
| `join_url` | string | URL to join the meeting |
| `password` | string | Meeting password |
| `settings` | object | Meeting settings |

### Example

```js
var meeting = app.integrations.zoom.get_meeting({
  meeting_id: "123456789",
})

console.log("Topic: " + meeting.topic)
console.log("Join: " + meeting.join_url)
console.log("Password: " + (meeting.password || "none"))
```
---

## create_meeting

Create a new Zoom meeting.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `topic` | string | yes | Meeting topic/title. |
| `type` | string | no | `"1"` = instant, `"2"` = scheduled (default), `"3"` = recurring no fixed time, `"8"` = recurring fixed time. |
| `start_time` | string | no | Start time in ISO 8601 (e.g. `"2024-01-15T10:00:00Z"`). Required for scheduled meetings. |
| `duration` | integer | no | Duration in minutes. Default: 30. |
| `timezone` | string | no | Timezone (e.g. `"America/New_York"`). |
| `agenda` | string | no | Meeting description/agenda. |
| `user_id` | string | no | User ID to create meeting for. Default: `"me"`. |
| `settings` | object | no | Meeting settings object. |

### Response

Returns the created meeting with `id`, `topic`, `start_time`, `join_url`, and `password`.

### Example

```js
var meeting = app.integrations.zoom.create_meeting({
  topic: "Project Sync",
  type: "2",
  start_time: "2024-06-15T10:00:00Z",
  duration: 45,
  timezone: "America/New_York",
  agenda: "Weekly project sync meeting",
})

console.log("Created meeting: " + meeting.id)
console.log("Join URL: " + meeting.join_url)
```
---

## list_users

List users in the Zoom account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of users per page (1–300). Default: 30. |
| `next_page_token` | string | no | Token for the next page of results. |

### Response

Returns an object with `users` array:

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | User ID |
| `email` | string | Email address |
| `first_name` | string | First name |
| `last_name` | string | Last name |
| `type` | integer | User type (1=basic, 2=licensed, 3=on-prem) |
| `status` | string | Account status (active, pending, inactive) |

### Example

```js
var users = app.integrations.zoom.list_users({
  page_size: 50,
})

for (const u of (users.users || [])) {
  console.log(u.first_name + " " + u.last_name + " <" + u.email + ">")
}
```
---

## get_user

Get details of a specific Zoom user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | User ID or `"me"`. |

### Response

Returns a user object:

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | User ID |
| `email` | string | Email address |
| `first_name` | string | First name |
| `last_name` | string | Last name |
| `type` | integer | User type |
| `status` | string | Account status |
| `timezone` | string | User timezone |
| `created_at` | string | Account creation timestamp |

### Example

```js
var user = app.integrations.zoom.get_user({
  user_id: "me",
})

console.log("Name: " + user.first_name + " " + user.last_name)
console.log("Email: " + user.email)
console.log("Timezone: " + user.timezone)
```
---

## list_recordings

List cloud recordings for a user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | no | User ID or `"me"`. Default: `"me"`. |
| `page_size` | integer | no | Number of recordings per page (1–300). Default: 30. |
| `next_page_token` | string | no | Token for the next page of results. |

### Response

Returns an object with `meetings` array, each containing recording info:

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | Meeting instance ID |
| `topic` | string | Meeting topic |
| `start_time` | string | Recording start time |
| `duration` | integer | Duration in minutes |
| `recording_files` | array | Array of recording file objects with download URLs |
| `share_url` | string | Sharing URL |

### Example

```js
var recordings = app.integrations.zoom.list_recordings({
  user_id: "me",
  page_size: 10,
})

for (const r of (recordings.meetings || [])) {
  console.log(r.topic + " - " + r.start_time + " (" + r.duration + " min)")
  for (const f of (r.recording_files || [])) {
    console.log("  File: " + f.file_type + " - " + (f.download_url || "no url"))
  }
}
```
---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Response

Returns a user object:

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | User ID |
| `email` | string | Email address |
| `first_name` | string | First name |
| `last_name` | string | Last name |
| `type` | integer | User type |
| `status` | string | Account status |
| `timezone` | string | User timezone |
| `created_at` | string | Account creation timestamp |

### Example

```js
var user = app.integrations.zoom.get_current_user({})

console.log("Logged in as: " + user.first_name + " " + user.last_name + " (" + user.email + ")")
```
---

## Additional Tools

The integration also exposes these Zoom API operations:

| Tool | Purpose |
|------|---------|
| `create_user` | Create a user in the Zoom account with an action and user_info payload. |
| `create_webinar` | Create a webinar for a user with topic, start time, duration, timezone, and agenda. |
| `delete_meeting` | Delete a meeting by `meeting_id`. |
| `get_account` | Get the current Zoom account information. |
| `get_user_settings` | Get settings for a user by `user_id`. |
| `get_webinar` | Get webinar details by `webinar_id`. |
| `list_past_meetings` | List past instances for a meeting by `meeting_id`. |
| `list_webinars` | List webinars for a user with optional `page_size`. |
| `update_meeting` | Update topic, start time, duration, or agenda for an existing meeting. |

Examples:

```js
var webinar = app.integrations.zoom.create_webinar({
  user_id: "me",
  topic: "Customer onboarding",
  type: 5,
  start_time: "2026-06-15T10:00:00Z",
  duration: 60,
  timezone: "UTC",
})

var settings = app.integrations.zoom.get_user_settings({
  user_id: "me",
})
```
---

## Multi-Account Usage

If you have multiple Zoom accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.zoom.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.zoom.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.zoom.work.function_name({ /* parameters */ })
app.integrations.zoom.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
