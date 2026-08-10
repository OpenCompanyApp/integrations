# Microsoft Entra ID

Namespace: `microsoft-entra-id`

This integration exposes Microsoft Entra ID directory operations from Microsoft Graph v1.0 for agents that need to inspect or manage users, groups, applications, service principals, roles, policies, identity governance, conditional access, and tenant directory metadata.

## Source Coverage

- Source OpenAPI: `https://raw.githubusercontent.com/microsoftgraph/msgraph-metadata/master/openapi/v1.0/openapi.yaml`
- Documentation: `https://learn.microsoft.com/en-us/graph/api/resources/azure-ad-overview?view=graph-rest-1.0`
- Generated operations: `2906`
- Included path families: `/administrativeUnits, /applications, /appRoleAssignments, /contacts, /contracts, /devices, /directory, /directoryObjects, /directoryRoles, /domains, /groups, /identity/conditionalAccess, /identityGovernance, /identityProtection, /invitations, /oauth2PermissionGrants, /organization, /policies, /roleManagement/directory, /servicePrincipals, /subscribedSkus, /tenantRelationships, /users`

## Authentication

Configure `access_token` with a Microsoft Graph OAuth token. Use least-privilege permissions for the operation being called, such as `Directory.Read.All`, `User.ReadWrite.All`, `Group.ReadWrite.All`, `Application.ReadWrite.All`, `RoleManagement.ReadWrite.Directory`, or related Microsoft Graph scopes.

## Usage Notes

- Tool parameters use snake_case. For example, Graph path parameter `user-id` becomes `user_id`.
- OData options are exposed as `top`, `skip`, `search`, `filter`, `orderby`, `select`, `expand`, and `count`.
- Advanced directory queries often require `consistency_level = "eventual"` and may also require `count = true`.
- Conditional update and delete operations can pass `if_match` for the Microsoft Graph `If-Match` header.
- Request bodies are passed as `body` objects and should match the official Microsoft Graph schema for the endpoint.

## Example

```js
var users = tools.microsoft_entra_id_users_list_user({
  top: 10,
  select: "id,displayName,userPrincipalName",
  consistency_level: "eventual",
})
```