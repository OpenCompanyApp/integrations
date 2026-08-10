# Daily.co

Namespace: `app.integrations["daily-co"]`

Daily.co tools use the Daily REST API at `https://api.daily.co/v1`. Configure
`api_key`; set `url` only for a test proxy or custom endpoint. Tool descriptions
include the official REST endpoint and the matching method name from Daily's
generated Ruby SDK.

## Rooms

```js
var rooms = app.integrations["daily-co"].list_rooms({
  limit: 10,
})

var room = app.integrations["daily-co"].create_room({
  payload: {
    name: "team-sync",
    privacy: "public",
    properties: {
      max_participants: 25,
      enable_recording: "cloud",
    }
  }
})

var config = app.integrations["daily-co"].get_room({
  room_name: "team-sync",
})
```
Room tools also cover deletion, room presence, session data, ejection,
permissions, app messages, SIP call transfer, dial-out, live streaming,
recording, and transcription actions.

## Meeting Tokens And Meetings

```js
var token = app.integrations["daily-co"].create_meeting_token({
  payload: {
    properties: {
      room_name: "team-sync",
      user_name: "Ada",
      is_owner: true,
    }
  }
})

var valid = app.integrations["daily-co"].validate_meeting_token({
  meeting_token: token.token,
})

var meetings = app.integrations["daily-co"].list_meetings({
  limit: 20,
  room: "team-sync",
})

var participants = app.integrations["daily-co"].get_meeting_participants({
  meeting: "meeting-id",
})
```
## Recordings And Transcripts

```js
var recordings = app.integrations["daily-co"].list_recordings({
  limit: 20,
  room: "team-sync",
})

var recording = app.integrations["daily-co"].get_recording_info({
  recording_id: "recording-id",
})

var link = app.integrations["daily-co"].get_recording_link({
  recording_id: "recording-id",
})

var transcripts = app.integrations["daily-co"].list_transcripts({
  limit: 20,
})
```
## Domain, Logs, Presence, Phone Numbers, And Webhooks

```js
var domain = app.integrations["daily-co"].get_domain_config({})

var logs = app.integrations["daily-co"].list_api_logs({
  limit: 20,
  source: "api",
})

var presence = app.integrations["daily-co"].get_presence({})

var webhooks = app.integrations["daily-co"].list_webhooks({})
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

```js
app.integrations["daily-co"].list_rooms({ limit: 10 })
app.integrations["daily-co"].default.list_rooms({ limit: 10 })
app.integrations["daily-co"].production.list_rooms({ limit: 10 })
```
All account namespaces expose the same tool names. Only credentials differ.
