# Gong — Ruby API Reference

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

```ruby
result = app.integrations.gong.list_calls(from_date_time: "2025-01-01T00:00:00Z", to_date_time: "2025-01-31T23:59:59Z")
result.calls.each do |call|
  puts((call.title).to_s + " — " + (call.duration).to_s + "s")
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

```ruby
result = app.integrations.gong.get_call(call_id: "1234567890")
puts("Title: " + (result.title).to_s)
puts("Duration: " + (result.duration).to_s + " seconds")
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

```ruby
result = app.integrations.gong.list_users()
result.users.each do |user|
  puts((user.firstName).to_s + " " + (user.lastName).to_s + " — " + (user.email).to_s)
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

```ruby
result = app.integrations.gong.list_deals(from_date_time: "2025-01-01T00:00:00Z", to_date_time: "2025-03-31T23:59:59Z")
result.deals.each do |deal|
  puts((deal.name).to_s + " — Stage: " + (deal.stage).to_s + " — Amount: " + (deal.amount).to_s)
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

```ruby
result = app.integrations.gong.list_interactions(from_date_time: "2025-01-01T00:00:00Z", activity_types: ["call", "meeting"])
result.interactions.each do |interaction|
  puts((interaction.type).to_s + " — " + (interaction.startTime).to_s)
end
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

```ruby
result = app.integrations.gong.list_transcripts(download_date: "2025-01-15", status: "completed")
result.transcripts.each do |transcript|
  puts((transcript.callId).to_s + " — " + (transcript.status).to_s)
end
```
---

## get_transcript

Get the full transcript of a specific call in Gong.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `transcript_id` | string | yes | The unique transcript identifier |

### Example

```ruby
result = app.integrations.gong.get_transcript(transcript_id: "1234567890")
puts("Call ID: " + (result.callId).to_s)
result.transcript.each do |turn|
  puts((turn.speaker).to_s + ": " + (turn.text).to_s)
end
```
---

## get_current_user

Get the currently authenticated Gong user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.gong.get_current_user()
puts("Logged in as: " + (result.firstName).to_s + " " + (result.lastName).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Gong accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.gong.list_calls()
# Explicit default (portable across setups)
app.integrations.gong.default.list_calls()
# Named accounts
app.integrations.gong.us_workspace.list_calls()
app.integrations.gong.eu_workspace.list_calls()
```
All functions are identical across accounts — only the credentials differ.
