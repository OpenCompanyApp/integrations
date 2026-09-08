# Microsoft SharePoint

Namespace: `microsoft-sharepoint`

This integration exposes Microsoft SharePoint through the official Microsoft Graph v1.0 OpenAPI metadata. It focuses on stable `/sites`, `/drives`, and `/shares` operations for sites, lists, document libraries, drive items, permissions, versions, pages, subscriptions, and shared links.

## Authentication

Provide a Microsoft Graph OAuth access token. The token must include the delegated or application permissions required by the operation you call, commonly `Sites.Read.All`, `Sites.ReadWrite.All`, `Files.Read.All`, or `Files.ReadWrite.All`.

## Usage notes

- Call the full generated tool slug shown by discovery. Do not shorten a collision-prone display name into a guessed operation path.
- Use `microsoft_sharepoint_sites_site_list_site` to discover site IDs.
- Use site drive/list tools to navigate document libraries and Microsoft Lists.
- OData parameters are normalized without the `$` prefix: `select`, `expand`, `filter`, `orderby`, `top`, `skip`, `search`, and `count`.
- For endpoints that upload raw `/content`, pass `body.content` and optionally `body.content_type`.
- Responses are normalized decoded JSON when Graph returns JSON. File/content downloads return `body`, `status`, and `content_type` when the response is not JSON.
- List operations return Graph's decoded collection envelope: use `result["value"]` for rows and `result["@odata.nextLink"]` when a later page is available. Empty `202` or `204` responses are `{"success" => true, "status" => status}`.

## Example

```ruby
sites = app.call('integrations.microsoft-sharepoint.microsoft_sharepoint_sites_site_list_site', search: "Engineering")
site_rows = sites["value"] || []
lists = app.call('integrations.microsoft-sharepoint.microsoft_sharepoint_sites_list_lists', site_id: "contoso.sharepoint.com,site-id,web-id", top: 25)
list_rows = lists["value"] || []
items = app.call('integrations.microsoft-sharepoint.microsoft_sharepoint_sites_lists_list_items', site_id: "contoso.sharepoint.com,site-id,web-id", list_id: "list-id", expand: "fields")
item_rows = items["value"] || []
```
