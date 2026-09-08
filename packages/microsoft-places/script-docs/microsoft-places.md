# Microsoft Places

Namespace: `microsoft-places`

This integration exposes Microsoft Places operations from Microsoft Graph v1.0 for agents that need to inspect or manage rooms, room lists, workspaces, desks, buildings, floors, sections, maps, and check-ins.

## Source Coverage

- Source OpenAPI: `https://raw.githubusercontent.com/microsoftgraph/msgraph-metadata/master/openapi/v1.0/openapi.yaml`
- Documentation: `https://learn.microsoft.com/en-us/graph/api/resources/place?view=graph-rest-1.0`
- Generated operations: `131`
- Included path families: `/places`

## Authentication

Configure `access_token` with a Microsoft Graph OAuth token. Use least-privilege permissions for the operation being called, such as `Place.Read.All`, `Place.ReadWrite.All`, or related Microsoft Graph scopes.

## Usage Notes

- Use the exact generated slug from discovery. In particular, the room collection is exposed by the `place_list_place_as_room` tool, not a derived `graph_room` name.
- Tool parameters use snake_case. For example, Graph path parameter `user-id` becomes `user_id`.
- OData options are exposed as `top`, `skip`, `search`, `filter`, `orderby`, `select`, `expand`, and `count`.
- Advanced queries may require `consistency_level = "eventual"` and may also require `count = true`.
- Conditional update and delete operations can pass `if_match` for the Microsoft Graph `If-Match` header.
- Request bodies are passed as `body` objects and should match the official Microsoft Graph schema for the endpoint.
- Room collections are decoded Graph envelopes, so read `rooms["value"]` and use `rooms["@odata.nextLink"]` for paging. Empty `202` or `204` responses contain `success` and `status` (and Places also retains `location` when Graph supplies it).

## Example

```ruby
rooms = app.call('integrations.microsoft-places.microsoft_places_places_place_list_place_as_room', top: 10, select: "id,displayName,emailAddress", consistency_level: "eventual")
room_rows = rooms["value"] || []
```
