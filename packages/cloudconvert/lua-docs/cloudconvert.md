# CloudConvert — Lua API Reference

## create_job

Create a new CloudConvert job. A job groups one or more tasks (import, convert, export) into a single workflow.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `tasks` | array | yes | Array of task definitions (see below) |
| `tag` | string | no | Optional tag to identify and filter the job |
| `webhook_url` | string | no | Optional webhook URL called when the job finishes |

### Task Definition

Each task in the `tasks` array is an object with:

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `operation` | string | yes | Task operation (see list below) |
| `name` | string | no | Name for the task (used to chain tasks) |
| `input` | string | no | Name of a previous task to use as input |
| + operation-specific fields | varies | varies | Depends on the operation |

### Common Operations

| Operation | Description |
|-----------|-------------|
| `import/url` | Import a file from a URL |
| `import/upload` | Import via upload (returns upload URL) |
| `import/base64` | Import from base64-encoded data |
| `convert` | Convert between file formats |
| `export/url` | Export and get a download URL |
| `export/aws-s3` | Export to Amazon S3 |
| `export/google-drive` | Export to Google Drive |
| `merge` | Merge multiple files (PDFs, images) |
| `optimize` | Optimize images or PDFs |
| `thumbnail` | Generate thumbnails |
| `capture-website` | Capture a website as image or PDF |
| `metadata` | Extract file metadata |
| `archive` | Create or extract archives |

### Examples

#### Convert a PDF to PNG

```lua
local result = app.integrations.cloudconvert.create_job({
  tasks = {
    {
      operation = "import/url",
      url = "https://example.com/document.pdf",
      filename = "document.pdf"
    },
    {
      operation = "convert",
      input = "import",
      output_format = "png"
    },
    {
      operation = "export/url",
      input = "convert"
    }
  }
})

local jobId = result.id
print("Job created: " .. jobId)
```

#### Capture a website

```lua
local result = app.integrations.cloudconvert.create_job({
  tasks = {
    {
      operation = "capture-website",
      url = "https://example.com",
      output_format = "png",
      options = {
        width = 1280,
        height = 800
      }
    },
    {
      operation = "export/url",
      input = "capture-website"
    }
  }
})
```

#### Merge PDFs

```lua
local result = app.integrations.cloudconvert.create_job({
  tasks = {
    {
      operation = "import/url",
      url = "https://example.com/page1.pdf",
      filename = "page1.pdf"
    },
    {
      operation = "import/url",
      url = "https://example.com/page2.pdf",
      filename = "page2.pdf"
    },
    {
      operation = "merge",
      input = ["import-1", "import-2"],
      output_format = "pdf"
    },
    {
      operation = "export/url",
      input = "merge"
    }
  }
})
```

---

## get_job

Get details and status of a CloudConvert job by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_id` | string | yes | The CloudConvert job ID |

### Example

```lua
local job = app.integrations.cloudconvert.get_job({
  job_id = "bf2d7ls9o63e6o6klql3be6syo"
})

print("Status: " .. job.data.status)
for _, task in ipairs(job.data.tasks) do
  print(task.name .. " (" .. task.operation .. "): " .. task.status)
end
```

---

## list_jobs

List CloudConvert jobs with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Results per page (default: 20, max: 100) |
| `page` | integer | no | Page number (default: 1) |
| `status` | string | no | Filter by: `waiting`, `processing`, `finished`, `error` |
| `tag` | string | no | Filter by job tag |

### Example

```lua
local result = app.integrations.cloudconvert.list_jobs({
  status = "finished",
  per_page = 10
})

for _, job in ipairs(result.data) do
  print(job.id .. " - " .. job.status)
end
```

---

## create_task

Create a standalone CloudConvert task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `operation` | string | yes | Task operation (e.g., "convert", "import/url") |
| `payload` | object | no | Operation-specific parameters |
| `name` | string | no | Task name (for chaining) |
| `input` | string | no | Name of previous task to chain from |

### Example

```lua
local task = app.integrations.cloudconvert.create_task({
  operation = "convert",
  payload = {
    output_format = "pdf",
    input_format = "docx",
    options = {
      quality = 90
    }
  },
  name = "my-conversion"
})

print("Task ID: " .. task.data.id)
```

---

## get_task

Get details and status of a CloudConvert task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `task_id` | string | yes | The CloudConvert task ID |

### Example

```lua
local task = app.integrations.cloudconvert.get_task({
  task_id = "bf2d7ls9o63e6o6klql3be6syo"
})

if task.data.status == "finished" then
  print("Download: " .. task.data.result.files[1].url)
end
```

---

## list_tasks

List CloudConvert tasks with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Results per page (default: 20, max: 100) |
| `page` | integer | no | Page number (default: 1) |
| `status` | string | no | Filter by: `waiting`, `processing`, `finished`, `error` |
| `operation` | string | no | Filter by operation type |
| `job_id` | string | no | Filter by job ID |

### Example

```lua
local result = app.integrations.cloudconvert.list_tasks({
  status = "finished",
  operation = "convert",
  per_page = 10
})

for _, task in ipairs(result.data) do
  print(task.id .. " (" .. task.operation .. "): " .. task.status)
end
```

---

## get_current_user

Get the authenticated CloudConvert user profile and credits.

### Parameters

None.

### Example

```lua
local user = app.integrations.cloudconvert.get_current_user({})

print("User: " .. user.data.name)
print("Credits: " .. user.data.credits)
```

---

## Multi-Account Usage

If you have multiple CloudConvert accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.cloudconvert.function_name({...})

-- Explicit default (portable across setups)
app.integrations.cloudconvert.default.function_name({...})

-- Named accounts
app.integrations.cloudconvert.production.function_name({...})
app.integrations.cloudconvert.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
