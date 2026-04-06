# Google Slides — Lua API Reference

## list_presentations

List Google Slides presentations from the user's Drive.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Max presentations per page (default: 20, max: 100) |
| `pageToken` | string | no | Token for the next page of results |

### Example

```lua
local result = app.integrations.google-slides.list_presentations({
  pageSize = 10
})

for _, file in ipairs(result.files) do
  print(file.name .. " (" .. file.id .. ")")
end
```

---

## get_presentation

Get full details of a specific presentation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The presentation ID |

### Example

```lua
local result = app.integrations.google-slides.get_presentation({
  id = "PRESENTATION_ID"
})

print("Title: " .. result.title)
print("Slides: " .. #result.slides)
```

---

## create_presentation

Create a new, blank Google Slides presentation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Title for the new presentation |

### Example

```lua
local result = app.integrations.google-slides.create_presentation({
  title = "Q1 Review"
})

print("Created: " .. result.presentationId)
```

---

## list_slides

List all slides in a presentation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The presentation ID |
| `pageSize` | integer | no | Max slides per page |
| `pageToken` | string | no | Token for the next page of results |

### Example

```lua
local result = app.integrations.google-slides.list_slides({
  id = "PRESENTATION_ID"
})

for _, slide in ipairs(result.slides) do
  print("Slide: " .. slide.objectId)
end
```

---

## get_slide

Get details of a specific slide in a presentation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The presentation ID |
| `page` | string | yes | The slide (page) object ID |
| `objectIdField` | string | no | Field to use for object ID resolution |

### Example

```lua
local result = app.integrations.google-slides.get_slide({
  id = "PRESENTATION_ID",
  page = "SLIDE_OBJECT_ID"
})

print("Slide has " .. #result.pageElements .. " elements")
```

---

## create_slide

Add a new slide to an existing presentation. Optionally add text boxes and shapes.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The presentation ID |
| `pageObjectId` | string | no | Custom object ID for the new slide |
| `createObject` | boolean | no | Whether to create the slide object (default: true) |
| `elements` | array | no | Elements to add to the slide (see below) |

### Element Structure

Each element in the `elements` array is an object with:

| Field | Type | Description |
|-------|------|-------------|
| `type` | string | `"text"` or `"shape"` |
| `shape` | string | Shape type (e.g., `"RECTANGLE"`). Used when `type` is `"shape"`. |
| `text` | string | Text content for the element |
| `style` | object | Size, transform, and font properties |

### Example

```lua
local result = app.integrations.google-slides.create_slide({
  id = "PRESENTATION_ID",
  elements = {
    {
      type = "text",
      text = "Welcome to the presentation!"
    },
    {
      type = "shape",
      shape = "RECTANGLE",
      text = "Key Finding"
    }
  }
})

print("Slide created")
```

---

## get_current_user

Get the authenticated Google user's profile information.

### Parameters

None.

### Example

```lua
local result = app.integrations.google-slides.get_current_user({})
print("User: " .. result.user.displayName)
print("Email: " .. result.user.emailAddress)
```

---

## Multi-Account Usage

If you have multiple Google accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.google-slides.list_presentations({})

-- Explicit default (portable across setups)
app.integrations.google-slides.default.list_presentations({})

-- Named accounts
app.integrations.google-slides.work.list_presentations({})
app.integrations.google-slides.personal.list_presentations({})
```

All functions are identical across accounts — only the credentials differ.
