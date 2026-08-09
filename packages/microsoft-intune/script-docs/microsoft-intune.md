# Microsoft Intune

Namespace: `microsoft-intune`

This integration exposes Microsoft Intune operations from Microsoft Graph v1.0 for agents that need to inspect or manage devices, mobile apps, compliance policies, configuration profiles, enrollment state, remote actions, troubleshooting events, and Intune RBAC resources.

## Source Coverage

- Source OpenAPI: `https://raw.githubusercontent.com/microsoftgraph/msgraph-metadata/master/openapi/v1.0/openapi.yaml`
- Documentation: `https://learn.microsoft.com/en-us/graph/api/resources/intune-graph-overview?view=graph-rest-1.0`
- Generated operations: `1470`
- Included path families: `/deviceManagement, /deviceAppManagement, /me, /users`

## Authentication

Configure `access_token` with a Microsoft Graph OAuth token. Use least-privilege permissions for the operation being called, such as `DeviceManagementManagedDevices.ReadWrite.All`, `DeviceManagementApps.ReadWrite.All`, `DeviceManagementConfiguration.ReadWrite.All`, `DeviceManagementRBAC.ReadWrite.All`, or related Microsoft Graph scopes.

## Usage Notes

- Tool parameters use snake_case. For example, Graph path parameter `user-id` becomes `user_id`.
- OData options are exposed as `top`, `skip`, `search`, `filter`, `orderby`, `select`, `expand`, and `count`.
- Advanced queries may require `consistency_level = "eventual"` and may also require `count = true`.
- Conditional update and delete operations can pass `if_match` for the Microsoft Graph `If-Match` header.
- Request bodies are passed as `body` objects and should match the official Microsoft Graph schema for the endpoint.

## Example

```js
var devices = tools.microsoft_intune_device_management_managed_devices_list_managed_device({
  top: 10,
  select: "id,deviceName,operatingSystem,complianceState",
  consistency_level: "eventual",
})
```