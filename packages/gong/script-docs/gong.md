# Gong — JavaScript API Reference

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

```js
var result = app.integrations.gong.list_calls({
  fromDateTime: "2025-01-01T00:00:00Z",
  toDateTime: "2025-01-31T23:59:59Z",
})

for (const call of (result.calls)) {
  console.log(call.title + " — " + call.duration + "s")
}
```
---

## get_call

Get detailed information about a specific call.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `callId` | string | yes | The unique call identifier |

### Example

```js
var result = app.integrations.gong.get_call({
  callId: "1234567890",
})

console.log("Title: " + result.title)
console.log("Duration: " + result.duration + " seconds")
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

```js
var result = app.integrations.gong.list_users({})

for (const user of (result.users)) {
  console.log(user.firstName + " " + user.lastName + " — " + user.email)
}
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

```js
var result = app.integrations.gong.list_deals({
  fromDateTime: "2025-01-01T00:00:00Z",
  toDateTime: "2025-03-31T23:59:59Z",
})

for (const deal of (result.deals)) {
  console.log(deal.name + " — Stage: " + deal.stage + " — Amount: " + deal.amount)
}
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

```js
var result = app.integrations.gong.list_interactions({
  fromDateTime: "2025-01-01T00:00:00Z",
  activityTypes: ["call", "meeting"],
})

for (const interaction of (result.interactions)) {
  console.log(interaction.type + " — " + interaction.startTime)
}
```
---

## list_transcripts

List call transcripts from Gong.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (starting from 1) |
| `limit` | integer | no | Maximum number of transcripts to return per page |
| `download_date` | string | no | Filter by download date in ISO 8601 (e.g., `"2025-01-15"`) |
| `call_type` | string | no | Filter by call type (e.g., `"conference"`, `"webinar"`, `"phone"`) |
| `status` | string | no | Filter by processing status (e.g., `"completed"`, `"processing"`, `"failed"`) |

### Response

Returns an object with:

| Field | Type | Description |
|-------|------|-------------|
| `transcripts` | array | Array of transcript objects |
| `count` | integer | Number of transcripts returned |
| `totalRecords` | integer | Total matching records (if available) |
| `cursor` | string | Cursor for the next page (if available) |

### Example

```js
var result = app.integrations.gong.list_transcripts({
  download_date: "2025-01-15",
  status: "completed",
})

for (const transcript of (result.transcripts)) {
  console.log(transcript.callId + " — " + transcript.status)
}
```
---

## get_transcript

Get the full transcript of a specific call in Gong.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `transcript_id` | string | yes | The unique transcript identifier |

### Example

```js
var result = app.integrations.gong.get_transcript({
  transcript_id: "1234567890",
})

console.log("Call ID: " + result.callId)
for (const turn of (result.transcript)) {
  console.log(turn.speaker + ": " + turn.text)
}
```
---

## get_current_user

Get the currently authenticated Gong user profile.

### Parameters

None.

### Example

```js
var result = app.integrations.gong.get_current_user({})

console.log("Logged in as: " + result.firstName + " " + result.lastName)
console.log("Email: " + result.email)
```
---

## Multi-Account Usage

If you have multiple Gong accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.gong.list_calls({})

// Explicit default (portable across setups)
app.integrations.gong.default.list_calls({})

// Named accounts
app.integrations.gong.us_workspace.list_calls({})
app.integrations.gong.eu_workspace.list_calls({})
```
All functions are identical across accounts — only the credentials differ.
