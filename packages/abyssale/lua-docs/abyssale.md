# Abyssale Lua API Reference

Namespace: `app.integrations.abyssale`

Use Abyssale to inspect creative designs, generate static or async media, retrieve generated files, manage projects, duplicate workspace templates, create dynamic image URLs, and request ZIP exports. Responses are decoded Abyssale JSON with no heavy reshaping.

## Designs

```lua
local designs = app.integrations.abyssale.list_designs({})

local design = app.integrations.abyssale.get_design({
  design_id = "38cb7df3-1160-4824-8531-2bacde2b6517"
})

local format = app.integrations.abyssale.get_design_format({
  design_id = "38cb7df3-1160-4824-8531-2bacde2b6517",
  format_specifier = "facebook-feed"
})
```

Read design details before generating assets. Abyssale generation payloads reference layer names and format names from the design.

## Generation

Synchronous generation is for a single static image:

```lua
local image = app.integrations.abyssale.generate_image({
  design_id = "38cb7df3-1160-4824-8531-2bacde2b6517",
  template_format_name = "facebook-feed",
  elements = {
    title = { text = "Spring launch" },
    background = { background_color = "#FF0000" }
  }
})
```

Asynchronous generation supports multiple formats and media types:

```lua
local request = app.integrations.abyssale.generate_multi_format_media({
  design_id = "38cb7df3-1160-4824-8531-2bacde2b6517",
  template_format_names = { "facebook-feed", "instagram-post" },
  callback_url = "https://example.test/abyssale/files",
  elements = {
    title = { text = "Spring launch" }
  }
})

print(request.generation_request_id)
```

Omit `template_format_names` or pass an empty array to generate every format for the design.

## Fonts, Files, And Exports

```lua
local fonts = app.integrations.abyssale.list_fonts({})

local file = app.integrations.abyssale.get_file({
  banner_id = "64238d01-d402-474b-8c2d-fbc957e9d290"
})

local export = app.integrations.abyssale.create_banner_export({
  ids = { "64238d01-d402-474b-8c2d-fbc957e9d290" },
  callback_url = "https://example.test/abyssale/export"
})
```

Exports are asynchronous. Abyssale posts the completed archive payload to your callback URL.

## Projects And Workspace Templates

```lua
local projects = app.integrations.abyssale.list_projects({})

local project = app.integrations.abyssale.create_project({
  name = "Summer Campaign"
})

local duplicate = app.integrations.abyssale.duplicate_workspace_template({
  company_template_id = "0c967bd0-4137-4690-ad70-249aa021c68b",
  project_id = project.id,
  name = "Localized banner"
})

local status = app.integrations.abyssale.get_duplication_request({
  duplicate_request_id = duplicate.duplication_request_id
})
```

Duplication is asynchronous; poll the request status before trying to use the duplicated design.

## Dynamic Images And Multi-Page PDFs

```lua
local dynamic = app.integrations.abyssale.create_dynamic_image_url({
  design_id = "38cb7df3-1160-4824-8531-2bacde2b6517",
  enable_rate_limit = true,
  enable_production_mode = true
})

local pdf = app.integrations.abyssale.generate_multi_page_pdf({
  design_id = "38cb7df3-1160-4824-8531-2bacde2b6517",
  callback_url = "https://example.test/abyssale/pdf",
  pages = {
    page_1 = {
      title = { text = "Page one" }
    }
  }
})
```

Dynamic image URLs allow query-based image customization. Multi-page PDF generation is asynchronous and returns a generation request ID.

## Generic API Tools

```lua
local raw = app.integrations.abyssale.api_get({
  path = "/designs"
})

local posted = app.integrations.abyssale.api_post({
  path = "/projects",
  payload = { name = "Campaign" }
})
```

Use generic API tools only for documented Abyssale endpoints that do not yet have a named helper. Prefer named tools because they validate required IDs and use agent-friendly parameter names.

## Webhook Payloads

Abyssale posts file and export completion events to the callback URLs you provide. Common payloads include generated file data with `file.url`, `file.cdn_url`, `format`, and `template`, or export data with `export_id` and `archive_url`.

## Multi-Account Usage

```lua
app.integrations.abyssale.list_designs({})
app.integrations.abyssale.default.list_designs({})
app.integrations.abyssale.production.list_designs({})
```

All account namespaces expose the same tools; only stored API keys differ.
