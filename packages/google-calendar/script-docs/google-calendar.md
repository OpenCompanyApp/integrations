# Google Calendar

Google Calendar tools are exposed under `app.integrations.google_calendar`. This package is generated from Google's official Calendar API v3 Discovery document and exposes 37 REST methods.

## Coverage

- Source: `https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest`
- Read tools: 11
- Write tools: 26
- Base URL: `https://www.googleapis.com/calendar/v3`

## Usage Notes

Pass path parameters such as `calendarId`, `eventId`, `ruleId`, or `setting` as top-level arguments. Query parameters can be passed either as top-level shortcut arguments or inside `query`. Methods that create, update, patch, watch, import, or query resources accept the official JSON request object inside `body`.

Google Calendar supports special calendar IDs such as `primary`, user email addresses, and opaque calendar IDs. Event methods use the official event ID from Calendar, not an iCal UID unless the upstream method explicitly documents that behavior. Repeated query parameters such as `eventTypes` can be passed as arrays.

## Tools

- `google_calendar_settings_get` - GET /users/me/settings/{setting}
- `google_calendar_settings_list` - GET /users/me/settings
- `google_calendar_settings_watch` - POST /users/me/settings/watch
- `google_calendar_calendars_insert` - POST /calendars
- `google_calendar_calendars_get` - GET /calendars/{calendarId}
- `google_calendar_calendars_patch` - PATCH /calendars/{calendarId}
- `google_calendar_calendars_update` - PUT /calendars/{calendarId}
- `google_calendar_calendars_delete` - DELETE /calendars/{calendarId}
- `google_calendar_calendars_clear` - POST /calendars/{calendarId}/clear
- `google_calendar_colors_get` - GET /colors
- `google_calendar_calendar_list_get` - GET /users/me/calendarList/{calendarId}
- `google_calendar_calendar_list_watch` - POST /users/me/calendarList/watch
- `google_calendar_calendar_list_insert` - POST /users/me/calendarList
- `google_calendar_calendar_list_list` - GET /users/me/calendarList
- `google_calendar_calendar_list_delete` - DELETE /users/me/calendarList/{calendarId}
- `google_calendar_calendar_list_update` - PUT /users/me/calendarList/{calendarId}
- `google_calendar_calendar_list_patch` - PATCH /users/me/calendarList/{calendarId}
- `google_calendar_channels_stop` - POST /channels/stop
- `google_calendar_events_move` - POST /calendars/{calendarId}/events/{eventId}/move
- `google_calendar_events_watch` - POST /calendars/{calendarId}/events/watch
- `google_calendar_events_delete` - DELETE /calendars/{calendarId}/events/{eventId}
- `google_calendar_events_import` - POST /calendars/{calendarId}/events/import
- `google_calendar_events_insert` - POST /calendars/{calendarId}/events
- `google_calendar_events_quick_add` - POST /calendars/{calendarId}/events/quickAdd
- `google_calendar_events_get` - GET /calendars/{calendarId}/events/{eventId}
- `google_calendar_events_patch` - PATCH /calendars/{calendarId}/events/{eventId}
- `google_calendar_events_instances` - GET /calendars/{calendarId}/events/{eventId}/instances
- `google_calendar_events_update` - PUT /calendars/{calendarId}/events/{eventId}
- `google_calendar_events_list` - GET /calendars/{calendarId}/events
- `google_calendar_acl_delete` - DELETE /calendars/{calendarId}/acl/{ruleId}
- `google_calendar_acl_list` - GET /calendars/{calendarId}/acl
- `google_calendar_acl_patch` - PATCH /calendars/{calendarId}/acl/{ruleId}
- `google_calendar_acl_update` - PUT /calendars/{calendarId}/acl/{ruleId}
- `google_calendar_acl_get` - GET /calendars/{calendarId}/acl/{ruleId}
- `google_calendar_acl_watch` - POST /calendars/{calendarId}/acl/watch
- `google_calendar_acl_insert` - POST /calendars/{calendarId}/acl
- `google_calendar_freebusy_query` - POST /freeBusy

## Examples

```js
var events = app.integrations.google_calendar.google_calendar_events_list({
  calendarId: "primary",
  timeMin: "2026-05-01T00:00:00Z",
  singleEvents: true,
  orderBy: "startTime",
})

var created = app.integrations.google_calendar.google_calendar_events_insert({
  calendarId: "primary",
  body: {
    summary: "Planning session",
    start: { dateTime: "2026-05-06T14:00:00Z" },
    end: { dateTime: "2026-05-06T14:30:00Z" },
  }
})
```
Responses are decoded Google Calendar JSON responses, or `{ success = true, status = ... }` for successful empty responses such as deletes and clears.
