# Gong — Lua API Reference

## list_calls

List call recordings from Gong.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fromDateTime` | string | no | Start of date range in ISO 8601 (e.g., `"2025-01-01T00:00:00Z"`) |
| `toDateTime` | string | no | End of date range in ISO 8601 (e.g., `"2025-01-31T23:59:59Z"`) |
| `workspaceId` | string | no | Workspace ID to filter calls by |
| `userId` | array | no | Array of user IDs to filter calls by |
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Maximum number of calls to return (default: 100) |

### Response

Returns an object with:

| Field | Type | Description |
|-------|------|-------------|
| `calls` | array | Array of call objects |
| `count` | integer | Number of calls returned |
| `totalRecords` | integer | Total matching records (if available) |
| `cursor` | string | Cursor for the next page (if available) |

### Example

```lua
local result = app.integrations.gong.list_calls({
  fromDateTime = "2025-01-01T00:00:00Z",
  toDateTime = "2025-01-31T23:59:59Z"
})

for _, call in ipairs(result.calls) do
  print(call.title .. " — " .. call.duration .. "s")
end
```

---

## get_call

Get detailed information about a specific call.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `callId` | string | yes | The unique call identifier |

### Example

```lua
local result = app.integrations.gong.get_call({
  callId = "1234567890"
})

print("Title: " .. result.title)
print("Duration: " .. result.duration .. " seconds")
```

---

## list_users

List users in the Gong workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Maximum number of users to return (default: 100) |

### Response

Returns an object with:

| Field | Type | Description |
|-------|------|-------------|
| `users` | array | Array of user objects |
| `count` | integer | Number of users returned |
| `totalRecords` | integer | Total matching records (if available) |
| `cursor` | string | Cursor for the next page (if available) |

### Example

```lua
local result = app.integrations.gong.list_users({})

for _, user in ipairs(result.users) do
  print(user.firstName .. " " .. user.lastName .. " — " .. user.email)
end
```

---

## list_deals

List deals tracked in Gong.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fromDateTime` | string | no | Start of date range in ISO 8601 |
| `toDateTime` | string | no | End of date range in ISO 8601 |
| `pipelineId` | string | no | Pipeline ID to filter deals by |
| `stageIds` | array | no | Array of stage IDs to filter by |
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Maximum number of deals to return (default: 100) |

### Response

Returns an object with:

| Field | Type | Description |
|-------|------|-------------|
| `deals` | array | Array of deal objects |
| `count` | integer | Number of deals returned |
| `totalRecords` | integer | Total matching records (if available) |
| `cursor` | string | Cursor for the next page (if available) |

### Example

```lua
local result = app.integrations.gong.list_deals({
  fromDateTime = "2025-01-01T00:00:00Z",
  toDateTime = "2025-03-31T23:59:59Z"
})

for _, deal in ipairs(result.deals) do
  print(deal.name .. " — Stage: " .. deal.stage .. " — Amount: " .. deal.amount)
end
```

---

## list_interactions

List customer interactions tracked in Gong.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fromDateTime` | string | no | Start of date range in ISO 8601 |
| `toDateTime` | string | no | End of date range in ISO 8601 |
| `activityTypes` | array | no | Activity types to filter by (e.g., `{"call", "email", "meeting"}`) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `limit` | integer | no | Maximum number of interactions to return (default: 100) |

### Response

Returns an object with:

| Field | Type | Description |
|-------|------|-------------|
| `interactions` | array | Array of interaction objects |
| `count` | integer | Number of interactions returned |
| `totalRecords` | integer | Total matching records (if available) |
| `cursor` | string | Cursor for the next page (if available) |

### Example

```lua
local result = app.integrations.gong.list_interactions({
  fromDateTime = "2025-01-01T00:00:00Z",
  activityTypes = {"call", "meeting"}
})

for _, interaction in ipairs(result.interactions) do
  print(interaction.type .. " — " .. interaction.startTime)
end
```

---

## get_current_user

Get the currently authenticated Gong user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.gong.get_current_user({})

print("Logged in as: " .. result.firstName .. " " .. result.lastName)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Gong accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.gong.list_calls({})

-- Explicit default (portable across setups)
app.integrations.gong.default.list_calls({})

-- Named accounts
app.integrations.gong.us_workspace.list_calls({})
app.integrations.gong.eu_workspace.list_calls({})
```

All functions are identical across accounts — only the credentials differ.
