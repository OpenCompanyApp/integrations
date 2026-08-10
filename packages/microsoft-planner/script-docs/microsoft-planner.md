# Microsoft Planner

Namespace: `microsoft-planner`

This integration exposes Microsoft Planner through the official Microsoft Graph v1.0 OpenAPI metadata. It covers Planner plans, buckets, tasks, task details, assigned-to board formats, bucket board formats, progress board formats, and group/user/me Planner navigation surfaces.

## Authentication

Provide a Microsoft Graph OAuth access token. The token must include the delegated or application permissions required by the operation, such as `Planner.Read.All`, `Planner.ReadWrite.All`, `Group.Read.All`, `Group.ReadWrite.All`, `Tasks.Read`, or `Tasks.ReadWrite`.

## Usage notes

- Start with `microsoft_planner_list_tasks`, `microsoft_planner_list_plans`, or the group/user scoped list tools depending on whether you already know the owner context.
- OData parameters are normalized without the `$` prefix: `select`, `expand`, `filter`, `orderby`, `top`, `skip`, `search`, and `count`.
- Planner PATCH and DELETE operations often require an ETag. Pass it as `if_match`, which maps to the `If-Match` header.
- Pass `prefer` when a Graph Planner endpoint supports a `Prefer` header.
- Write endpoints accept a `body` object matching the official Microsoft Graph request schema.

## Example

```js
var tasks = microsoft_planner_list_tasks({ top: 10 })
var task = microsoft_planner_get_tasks({ planner_task_id: "task-id", select: "id,title,percentComplete" })
var updated = microsoft_planner_update_tasks({
  planner_task_id: "task-id",
  if_match: 'W/"etag"',
  body: { percentComplete: 100 },
})
```