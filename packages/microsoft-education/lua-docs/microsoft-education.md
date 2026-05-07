# Microsoft Education

Namespace: `microsoft-education`

This integration exposes Microsoft Education operations from Microsoft Graph v1.0 for agents that need to inspect or manage schools, classes, education users, assignments, submissions, rubrics, assignment categories, outcomes, and learning resources.

## Source Coverage

- Source OpenAPI: `https://raw.githubusercontent.com/microsoftgraph/msgraph-metadata/master/openapi/v1.0/openapi.yaml`
- Documentation: `https://learn.microsoft.com/en-us/graph/api/resources/education-overview?view=graph-rest-1.0`
- Generated operations: `414`
- Included path families: `/education`

## Authentication

Configure `access_token` with a Microsoft Graph OAuth token. Use least-privilege permissions for the operation being called, such as `EduRoster.ReadWrite.All`, `EduAssignments.ReadWrite.All`, `EduAdministration.ReadWrite.All`, or related Microsoft Graph scopes.

## Usage Notes

- Tool parameters use snake_case. For example, Graph path parameter `user-id` becomes `user_id`.
- OData options are exposed as `top`, `skip`, `search`, `filter`, `orderby`, `select`, `expand`, and `count`.
- Advanced queries may require `consistency_level = "eventual"` and may also require `count = true`.
- Conditional update and delete operations can pass `if_match` for the Microsoft Graph `If-Match` header.
- Request bodies are passed as `body` objects and should match the official Microsoft Graph schema for the endpoint.

## Example

```lua
local classes = tools.microsoft_education_education_list_classes({
  top = 10,
  select = "id,displayName,mailNickname",
  consistency_level = "eventual"
})
```
