# Client for the Zoom REST API v2 — Lua API Reference

## zoom_create_meeting

Create a Zoom meeting for a user. Supports scheduling with topic, start time, duration, and settings..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | User ID or email address to create the meeting for. |
| `topic` | string | yes | Meeting topic / title. |
| `type` | integer | no | Meeting type: 1=Instant, 2=Scheduled (default), 3=Recurring no fixed time, 8=Recurring fixed time. |
| `start_time` | string | no | Meeting start time in ISO 8601 format (e.g.,  |
| `duration` | integer | no | Meeting duration in minutes. |
| `timezone` | string | no | Timezone for the meeting (e.g.,  |
| `agenda` | string | no | Meeting description / agenda. |
| `settings` | string | no | JSON object of meeting settings (host_video, participant_video, join_before_host, etc.). |

### Example

```lua
local result = app.integrations.zoom.zoom_create_meeting({
  user_id = ""
  topic = ""
  type = 0
})
```

## zoom_create_user

Create a new user in the Zoom account..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `action` | string | yes | Creation action:  |
| `email` | string | yes | Email address for the new user. |
| `first_name` | string | no | First name of the user. |
| `last_name` | string | no | Last name of the user. |
| `type` | integer | no | User type: 1=Basic, 2=Licensed, 3=On-prem. |

### Example

```lua
local result = app.integrations.zoom.zoom_create_user({
  action = ""
  email = ""
  first_name = ""
})
```

## zoom_create_webinar

Create a Zoom webinar for a user. Supports scheduling with topic, start time, duration, and timezone..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | User ID or email address to create the webinar for. |
| `topic` | string | yes | Webinar topic / title. |
| `type` | integer | no | Webinar type: 5=Webinar, 6=Recurring webinar, 9=Recurring webinar no fixed time. |
| `start_time` | string | no | Webinar start time in ISO 8601 format. |
| `duration` | integer | no | Webinar duration in minutes. |
| `timezone` | string | no | Timezone for the webinar (e.g.,  |
| `agenda` | string | no | Webinar description / agenda. |

### Example

```lua
local result = app.integrations.zoom.zoom_create_webinar({
  user_id = ""
  topic = ""
  type = 0
})
```

## zoom_delete_meeting

Delete a Zoom meeting by ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `meeting_id` | string | yes | The meeting ID to delete. |

### Example

```lua
local result = app.integrations.zoom.zoom_delete_meeting({
  meeting_id = ""
})
```

## zoom_get_account

Get the current Zoom account information..

### Example

```lua
local result = app.integrations.zoom.zoom_get_account({
})
```

## zoom_get_meeting

Get details of a Zoom meeting by ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `meeting_id` | string | yes | The meeting ID. |

### Example

```lua
local result = app.integrations.zoom.zoom_get_meeting({
  meeting_id = ""
})
```

## zoom_get_user

Get details of a Zoom user by ID or email address..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | User ID or email address. |

### Example

```lua
local result = app.integrations.zoom.zoom_get_user({
  user_id = ""
})
```

## zoom_get_user_settings

Get settings for a Zoom user..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | User ID or email address. |

### Example

```lua
local result = app.integrations.zoom.zoom_get_user_settings({
  user_id = ""
})
```

## zoom_get_webinar

Get details of a Zoom webinar by ID..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `webinar_id` | string | yes | The webinar ID. |

### Example

```lua
local result = app.integrations.zoom.zoom_get_webinar({
  webinar_id = ""
})
```

## zoom_list_meetings

List meetings for a Zoom user. Filter by type (scheduled, live, upcoming) with pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | User ID or email address. |
| `type` | string | no | Meeting type filter:  |
| `page_size` | integer | no | Number of records returned per page (default 30, max 300). |
| `next_page_token` | string | no | Token for the next page of results. |

### Example

```lua
local result = app.integrations.zoom.zoom_list_meetings({
  user_id = ""
  type = ""
  page_size = 0
})
```

## zoom_list_past_meetings

List past instances of a Zoom meeting..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `meeting_id` | string | yes | The meeting ID to list past instances for. |

### Example

```lua
local result = app.integrations.zoom.zoom_list_past_meetings({
  meeting_id = ""
})
```

## zoom_list_recordings

List cloud recordings for a Zoom user..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | User ID or email address. |
| `page_size` | integer | no | Number of records returned per page (default 30, max 300). |
| `next_page_token` | string | no | Token for the next page of results. |

### Example

```lua
local result = app.integrations.zoom.zoom_list_recordings({
  user_id = ""
  page_size = 0
  next_page_token = ""
})
```

## zoom_list_users

List users in the Zoom account. Filter by status and role with pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | User status filter:  |
| `role_id` | string | no | Filter by role ID. |
| `page_size` | integer | no | Number of records returned per page (default 30, max 300). |
| `next_page_token` | string | no | Token for the next page of results. |

### Example

```lua
local result = app.integrations.zoom.zoom_list_users({
  status = ""
  role_id = ""
  page_size = 0
})
```

## zoom_list_webinars

List webinars for a Zoom user..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | User ID or email address. |
| `page_size` | integer | no | Number of records returned per page (default 30, max 300). |

### Example

```lua
local result = app.integrations.zoom.zoom_list_webinars({
  user_id = ""
  page_size = 0
})
```

## zoom_update_meeting

Update an existing Zoom meeting. Supports changing topic, start time, duration, and agenda..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `meeting_id` | string | yes | The meeting ID to update. |
| `topic` | string | no | New meeting topic / title. |
| `start_time` | string | no | New start time in ISO 8601 format. |
| `duration` | integer | no | New duration in minutes. |
| `agenda` | string | no | New meeting agenda. |

### Example

```lua
local result = app.integrations.zoom.zoom_update_meeting({
  meeting_id = ""
  topic = ""
  start_time = ""
})
```

---

## Multi-Account Usage

If you have multiple zoom accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.zoom.function_name({...})

-- Explicit default (portable across setups)
app.integrations.zoom.default.function_name({...})

-- Named accounts
app.integrations.zoom.work.function_name({...})
app.integrations.zoom.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
