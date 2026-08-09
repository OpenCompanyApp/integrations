# Google Keep

Google Keep tools are exposed under `app.integrations.google_keep`. This package is generated from Google's official Keep v1 Discovery document and exposes 7 REST methods.

Use it for note workflows: list notes, get notes, create notes, delete notes, create or delete note permissions in batches, and download attachment media.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. Resource path parameters preserve `/`, so pass full names like `notes/example` or `notes/example/permissions/permission-id`.

## Examples

```js
var notes = app.integrations.google_keep.google_keep_notes_list({
  pageSize: 10,
  filter: "trashed = false",
})

var note = app.integrations.google_keep.google_keep_notes_create({
  body: {
    title: "Agent checklist",
    body: { text: { text: "Review queued tasks" } },
  }
})

var shared = app.integrations.google_keep.google_keep_notes_permissions_batch_create({
  parent: "notes/example",
  body: {
    requests: [
      { permission: { role: "WRITER", email: "person@example.test" } }
    ]
  }
})
```
Returned data is the parsed JSON response from the Keep API. Empty successful responses return `{ success = true, status = <http_status> }`. Media downloads that do not return JSON are returned as `{ body = <string>, status = <http_status>, content_type = <header> }`.

Use `https://www.googleapis.com/auth/keep.readonly` for read-only note access and `https://www.googleapis.com/auth/keep` for create, delete, sharing, and media workflows.