# APITemplate.io Lua Reference

APITemplate.io generates PDFs and images through the REST API v2. The integration uses the `X-API-KEY` header and defaults to `https://rest.apitemplate.io`; regional hosts such as `https://rest-us.apitemplate.io` can be configured per account.

Generation tools usually return APITemplate.io response fields such as `status`, `download_url`, `download_url_png`, `template_id`, and `transaction_ref`. When `async = true`, the API returns quickly and you should track the returned `transaction_ref` or receive the configured webhook callback.

## create_pdf

Generate a PDF from a saved template.

```lua
local result = app.integrations.apitemplateio.create_pdf({
  template_id = "tpl_invoice",
  data = {
    invoice_number = "INV-001",
    company_name = "Example Corp",
    amount = "$500.00"
  },
  filename = "invoice-INV-001.pdf",
  expiration = 1440
})
```

Common query options: `export_type`, `output_format`, `output_html`, `expiration`, `filename`, `async`, `webhook_url`, `webhook_method`, and `meta`.

## create_image

Generate images from a visual image template. Prefer `overrides`; `data` is accepted as a backward-compatible full payload.

```lua
local result = app.integrations.apitemplateio.create_image({
  template_id = "tpl_social",
  output_image_type = "pngOnly",
  overrides = {
    { name = "title", text = "Launch Week" },
    { name = "hero", src = "https://example.test/hero.png" }
  }
})
```

`output_image_type` accepts `all`, `jpegOnly`, or `pngOnly`.

## create_pdf_from_html

Generate a PDF without creating a saved template first.

```lua
local result = app.integrations.apitemplateio.create_pdf_from_html({
  body = "<h1>Hello {{name}}</h1>",
  css = "<style>h1 { color: #2563eb; }</style>",
  data = { name = "World" },
  settings = {
    paper_size = "A4",
    orientation = "1",
    margin_top = "40",
    margin_right = "10",
    margin_bottom = "40",
    margin_left = "10"
  }
})
```

## create_pdf_from_url

Render a public web page into a PDF.

```lua
local result = app.integrations.apitemplateio.create_pdf_from_url({
  url = "https://example.test/report",
  settings = {
    paper_size = "A4",
    print_background = "1"
  }
})
```

## create_pdf_from_markdown

Render Markdown into a PDF.

```lua
local result = app.integrations.apitemplateio.create_pdf_from_markdown({
  body = "# {{title}}\n\nGenerated report body.",
  data = { title = "Monthly Report" },
  css = "<style>body { font-family: sans-serif; }</style>"
})
```

## merge_pdfs

Merge normal PDF URLs or PDF data URLs into a single PDF.

```lua
local result = app.integrations.apitemplateio.merge_pdfs({
  urls = {
    "https://example.test/a.pdf",
    "https://example.test/b.pdf"
  },
  export_type = "json",
  expiration = 1440
})
```

## list_objects

List generated PDFs and images.

```lua
local result = app.integrations.apitemplateio.list_objects({
  limit = 50,
  transaction_type = "PDF",
  template_id = "tpl_invoice"
})
```

Filters include `limit`, `offset`, `template_id`, `transaction_type`, and `transaction_ref`.

## delete_object

Delete a generated object from APITemplate.io CDN storage.

```lua
local result = app.integrations.apitemplateio.delete_object({
  transaction_ref = "txn_123"
})
```

## get_current_user

Get account information for the configured API key. The tool keeps the historical name but maps to the current `/v2/account-information` endpoint.

```lua
local account = app.integrations.apitemplateio.get_current_user({})
```

## list_templates

List saved templates.

```lua
local templates = app.integrations.apitemplateio.list_templates({
  limit = 100,
  format = "PDF",
  group_name = "invoices"
})
```

Filters include `limit`, `offset`, `format`, `template_id`, `group_name`, and `with_layer_info`.

## get_template

Get a saved PDF template by ID. APITemplate.io marks this endpoint experimental.

```lua
local template = app.integrations.apitemplateio.get_template({
  template_id = "tpl_invoice"
})
```

## update_template

Update a saved PDF template. APITemplate.io marks this endpoint experimental, so hosts should expect availability to depend on account/API support.

```lua
local result = app.integrations.apitemplateio.update_template({
  template_id = "tpl_invoice",
  body = "<h1>{{title}}</h1>",
  css = "<style>body { background: white; }</style>",
  settings = {
    custom_footer = "<div>Page <span class='pageNumber'></span></div>"
  }
})
```

## Multi-Account Usage

```lua
app.integrations.apitemplateio.create_pdf({...})
app.integrations.apitemplateio.default.create_pdf({...})
app.integrations.apitemplateio.production.create_pdf({...})
```
