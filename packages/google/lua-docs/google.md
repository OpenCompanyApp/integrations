# Google Integration — Lua API Supplement

Google services are registered as separate namespaces: `integrations.gmail`, `integrations.google_sheets`, `integrations.google_calendar`, `integrations.google_drive`, etc. All share the same OAuth credentials.

## Gmail

Send email with CC/BCC:

```lua
app.integrations.gmail.send_email({
    to = "alice@example.com",
    subject = "Q1 Report",
    body = "Please find the report attached.",
    cc = "bob@example.com, carol@example.com",
    bcc = "manager@example.com",
})
```

Search, read, then reply workflow:

```lua
-- Step 1: Search for messages
local results = app.integrations.gmail.search_emails({
    query = "from:alice subject:meeting is:unread",
    max_results = 5,
})

-- Step 2: Read the full message
local msg = app.integrations.gmail.read_email({ message_id = results.messages[1].id })

-- Step 3: Reply in the same thread
app.integrations.gmail.reply({
    message_id = msg.id,
    thread_id = msg.threadId,
    body = "Thanks, I'll be there.",
    cc = "team@example.com",
})
```

Draft vs direct send -- use `create_draft` to stage an email without sending, then `send_draft` to send it later:

```lua
-- Create a draft (not sent)
local draft = app.integrations.gmail.create_draft({
    to = "client@example.com",
    subject = "Proposal",
    body = "Draft content here...",
})

-- Send it later using the draft ID
app.integrations.gmail.send_draft({ draft_id = draft.draftId })
```

## Google Sheets

Values use 2D Lua tables -- each inner table is one row:

```lua
local values = {
    {"Name", "Age", "City"},
    {"Alice", 30, "NYC"},
    {"Bob", 25, "LA"},
}
```

A1 notation examples:

- `"Sheet1!A1:D10"` -- specific range
- `"Sheet1!A:A"` -- entire column
- `"Sheet1"` -- entire sheet
- `"'My Sheet'!A1:B2"` -- sheet names with spaces need quotes

Input modes: `"user_entered"` (default) parses formulas and dates, `"raw"` stores literal strings.

Create a spreadsheet, add a sheet, write data:

```lua
-- Create a new spreadsheet
local ss = app.integrations.google_sheets.create_spreadsheet({ title = "Q1 Sales" })
local id = ss.spreadsheetId

-- Add a second sheet/tab
app.integrations.google_sheets.add({
    spreadsheet_id = id,
    title = "By Region",
})

-- Write data with headers
app.integrations.google_sheets.write_range({
    spreadsheet_id = id,
    range = "Sheet1!A1:C3",
    values = {
        {"Region", "Revenue", "Growth"},
        {"North", 50000, "=B2/50000-1"},
        {"South", 42000, "=B3/42000-1"},
    },
    input = "user_entered",  -- parses the formulas
})
```

Read data back:

```lua
local data = app.integrations.google_sheets.read_range({
    spreadsheet_id = id,
    range = "Sheet1!A1:C3",
    render = "formatted",  -- "formatted" (default), "unformatted", or "formula"
})
-- data.values is a 2D table: {{"Region","Revenue","Growth"}, {"North","50000","0%"}, ...}
```

Append vs write -- `append_rows` auto-detects the last row and adds below it:

```lua
app.integrations.google_sheets.append_rows({
    spreadsheet_id = id,
    range = "Sheet1",
    values = {
        {"East", 38000, "=B4/38000-1"},
    },
    input = "user_entered",
})
```

## Google Calendar

Create a timed event with attendees:

```lua
app.integrations.google_calendar.create_event({
    summary = "Sprint Planning",
    description = "Bi-weekly sprint planning session",
    location = "Conference Room B",
    start_date_time = "2026-04-01T10:00:00-05:00",
    end_date_time = "2026-04-01T11:00:00-05:00",
    time_zone = "America/New_York",
    attendees = "alice@example.com, bob@example.com",
    recurrence = "RRULE:FREQ=WEEKLY;INTERVAL=2;COUNT=10",
})
```

Create an all-day event:

```lua
app.integrations.google_calendar.create_event({
    summary = "Company Holiday",
    start_date = "2026-07-04",
    end_date = "2026-07-05",
})
```

Date/time format: ISO 8601 with timezone offset for timed events (`2026-04-01T10:00:00-05:00`), plain `YYYY-MM-DD` for all-day events. Use `time_zone` for IANA names like `"America/New_York"`.

## Google Drive

Search for files, then get details:

```lua
-- Search by name and type
local results = app.integrations.google_drive.search({
    query = "name contains 'report' and mimeType = 'application/vnd.google-apps.spreadsheet'",
    max_results = 10,
    order_by = "modifiedTime desc",
})

-- Get full file info (and optionally export content)
local file = app.integrations.google_drive.get_file({
    file_id = results.files[1].id,
    export_as = "csv",  -- "text", "csv", or "markdown" (Google Workspace files only)
})
```

Common Drive query patterns:

- `"name contains 'budget'"` -- by name
- `"mimeType = 'application/vnd.google-apps.spreadsheet'"` -- Sheets
- `"mimeType = 'application/vnd.google-apps.document'"` -- Docs
- `"mimeType = 'application/vnd.google-apps.folder'"` -- folders
- `"modifiedTime > '2026-01-01'"` -- recently modified
- `"sharedWithMe = true"` -- shared files
- `"'FOLDER_ID' in parents"` -- files in a folder

Share a file:

```lua
-- Share with a specific user
app.integrations.google_drive.share_file({
    file_id = "abc123",
    role = "writer",       -- "reader", "writer", or "commenter"
    email = "alice@example.com",
    notify = "true",
})

-- Share with anyone via link
app.integrations.google_drive.share_file({
    file_id = "abc123",
    role = "reader",
    type = "anyone",
})
```

## Tips

- All Google APIs share the same OAuth token -- if Gmail is connected, the same credentials work for Sheets, Drive, Calendar, etc.
- Use `input = "user_entered"` when writing Sheets data that contains formulas (e.g., `"=SUM(A1:A10)"`) or dates. Use `"raw"` for literal strings.
- Sheet names with spaces must be quoted in A1 notation: `"'My Sheet'!A1:B2"`.
- `append_rows` is better than `write_range` when adding rows to an existing table -- it auto-detects where the data ends.
- Calendar event times use ISO 8601 with timezone offset. Always include the offset or set `time_zone` explicitly.
- Drive search excludes trashed files by default.

---

## Multi-Account Usage

If you have multiple google accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.google.function_name({...})

-- Explicit default (portable across setups)
app.integrations.google.default.function_name({...})

-- Named accounts
app.integrations.google.work.function_name({...})
app.integrations.google.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
