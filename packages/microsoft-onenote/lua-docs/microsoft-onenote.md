# Microsoft OneNote

Namespace: `microsoft-onenote`

This integration exposes Microsoft OneNote through the official Microsoft Graph v1.0 OpenAPI metadata. It covers notebooks, section groups, sections, pages, page content, resources, operations, copy actions, recent notebook lookup, and owner-scoped `/me`, `/users`, `/groups`, and site-backed OneNote surfaces.

## Authentication

Provide a Microsoft Graph OAuth access token with the OneNote permissions required by the operation, such as `Notes.Read.All`, `Notes.ReadWrite.All`, `Notes.Create`, or related group/site permissions.

## Usage notes

- Start with `microsoft_onenote_me_onenote_list_notebooks` or owner-scoped notebook tools to discover notebook IDs.
- OData parameters are normalized without the `$` prefix: `select`, `expand`, `filter`, `orderby`, `top`, `skip`, `search`, and `count`.
- JSON write/action endpoints accept `body` matching the official Microsoft Graph request schema.
- Raw content operations, such as page/resource `/content` updates, require `body.content` and optionally `body.content_type`; the default content type is `application/octet-stream`.
- Content downloads return decoded JSON when possible, otherwise `body`, `status`, and `content_type`.

## Example

```lua
local notebooks = microsoft_onenote_me_onenote_list_notebooks({ top = 10 })
local pages = microsoft_onenote_me_onenote_list_pages({ top = 25, select = "id,title,createdDateTime" })
local updated = microsoft_onenote_me_onenote_update_pages_content({
  onenote_page_id = "page-id",
  body = { content = "<html><body>Updated</body></html>", content_type = "text/html" }
})
```
