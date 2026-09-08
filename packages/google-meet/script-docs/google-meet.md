# Google Meet

Google Meet tools are exposed under `app.integrations.google_meet`. This package is generated from Google's official Meet v2 Discovery document and exposes 18 REST methods.

Use it for meeting workflows: create and inspect meeting spaces, end active conferences, list conference records, inspect participants and participant sessions, list recordings, list transcripts and transcript entries, and read smart notes.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. Resource path parameters preserve `/`, so pass full names like `spaces/example`, `conferenceRecords/abc`, or `conferenceRecords/abc/transcripts/xyz`.

## Examples

```ruby
space = app.call("integrations.google-meet.spaces_create", body: {config: {accessType: "TRUSTED"}})
records = app.call("integrations.google-meet.conference_records_list", page_size: 10, filter: "space.name = \"spaces/example\"")
participants = app.call("integrations.google-meet.conference_records_participants_list", parent: "conferenceRecords/example", page_size: 20)
```
Returned data is the parsed JSON response from the Meet API. Empty successful responses return `{ success = true, status = <http_status> }`.

Use read-only Meet scopes for conference inspection and `https://www.googleapis.com/auth/meetings.space.created` or settings scopes for creating or changing meeting spaces.