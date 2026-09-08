# Daily.co

Namespace: `app.integrations["daily-co"]`

Daily.co tools use the Daily REST API at `https://api.daily.co/v1`. Configure
`api_key`; set `url` only for a test proxy or custom endpoint. Tool descriptions
include the official REST endpoint and the matching method name from Daily's
generated Ruby SDK.

## Rooms

```ruby
rooms = app.call("integrations.daily-co.list_rooms", limit: 10)
room = app.call("integrations.daily-co.create_room", payload: {name: "team-sync", privacy: "public", properties: {max_participants: 25, enable_recording: "cloud"}})
config = app.call("integrations.daily-co.get_room", room_name: "team-sync")
```
Room tools also cover deletion, room presence, session data, ejection,
permissions, app messages, SIP call transfer, dial-out, live streaming,
recording, and transcription actions.

## Meeting Tokens And Meetings

```ruby
token = app.call("integrations.daily-co.create_meeting_token", payload: {properties: {room_name: "team-sync", user_name: "Ada", is_owner: true}})
valid = app.call("integrations.daily-co.validate_meeting_token", meeting_token: token.token)
meetings = app.call("integrations.daily-co.list_meetings", limit: 20, room: "team-sync")
participants = app.call("integrations.daily-co.get_meeting_participants", meeting: "meeting-id")
```
## Recordings And Transcripts

```ruby
recordings = app.call("integrations.daily-co.list_recordings", limit: 20, room: "team-sync")
recording = app.call("integrations.daily-co.get_recording_info", recording_id: "recording-id")
link = app.call("integrations.daily-co.get_recording_link", recording_id: "recording-id")
transcripts = app.call("integrations.daily-co.list_transcripts", limit: 20)
```
## Domain, Logs, Presence, Phone Numbers, And Webhooks

```ruby
domain = app.call("integrations.daily-co.get_domain_config")
logs = app.call("integrations.daily-co.list_api_logs", limit: 20, source: "api")
presence = app.call("integrations.daily-co.get_presence")
webhooks = app.call("integrations.daily-co.list_webhooks")
```
The package also exposes batch room create/delete, domain config updates,
available/purchased phone number operations, and webhook CRUD.

## Argument Shape

Path parameters are top-level snake_case arguments. For example,
`/rooms/{room_name}` uses `room_name`.

Write operations accept a `payload` object for the JSON body. Tools also accept:

- `query`: extra documented query parameters
- top-level extra arguments: sent to the JSON body for writes and query string
  for reads

Responses are parsed Daily JSON. Empty responses return
`{ success = true, status = 204 }`.

## Multi-Account Usage

```ruby
app.call("integrations.daily-co.list_rooms", limit: 10)
app.call("integrations.daily-co.default.list_rooms", limit: 10)
app.call("integrations.daily-co.production.list_rooms", limit: 10)
```
All account namespaces expose the same tool names. Only credentials differ.
