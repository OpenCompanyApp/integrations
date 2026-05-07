# Microsoft Reports

Namespace: `microsoft-reports`

This integration exposes Microsoft Reports operations from Microsoft Graph v1.0 for agents that need Microsoft 365 usage, activity, authentication methods, print usage, partner billing, and security report data.

## Source Coverage

- Source OpenAPI: `https://raw.githubusercontent.com/microsoftgraph/msgraph-metadata/master/openapi/v1.0/openapi.yaml`
- Documentation: `https://learn.microsoft.com/en-us/graph/api/resources/reportroot?view=graph-rest-1.0`
- Generated operations: `187`
- Included path families: `/reports`

## Authentication

Configure `access_token` with a Microsoft Graph OAuth token. Use least-privilege permissions for the operation being called, such as `Reports.Read.All`, `AuditLog.Read.All`, `Directory.Read.All`, `PartnerBilling.Read.All`, or related Microsoft Graph scopes.

## Usage Notes

- Tool parameters use snake_case. For example, Graph path parameter `user-id` becomes `user_id`.
- OData options are exposed as `top`, `skip`, `search`, `filter`, `orderby`, `select`, `expand`, and `count`.
- Advanced queries may require `consistency_level = "eventual"` and may also require `count = true`.
- Conditional update and delete operations can pass `if_match` for the Microsoft Graph `If-Match` header.
- Request bodies are passed as `body` objects and should match the official Microsoft Graph schema for the endpoint.
- Many Microsoft 365 usage report endpoints return `302` redirects to preauthenticated CSV downloads; these are returned as a successful status with the redirect `location` header.

## Example

```lua
local registrations = tools.microsoft_reports_reports_authentication_methods_list_user_registration_details({
  top = 10,
  select = "id,userPrincipalName,isMfaRegistered",
  consistency_level = "eventual"
})
```
