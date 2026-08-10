# Pulumi JavaScript Docs

Pulumi tools are exposed under `app.integrations.pulumi`. This package is generated from Pulumi Cloud's live OpenAPI specification and exposes all 581 operations found in that spec.

Configure `api_token` and optionally `url`. The default URL is `https://api.pulumi.com`; self-hosted Pulumi Cloud can use its API component URL.

Pass path, query, and header parameters as top-level snake_case arguments. Pass JSON request bodies under `body`.

```js
var caps = app.integrations.pulumi.pulumi_miscellaneous_capabilities({})
var gate = app.integrations.pulumi.pulumi_organizations_read_gate({ org_name: 'acme', gate_id: 'gate-id' })
```
## Coverage Notes

The manifest `pulumi-openapi-manifest.json` records source URL, operation IDs, methods, paths, tool slugs, and classes. Tool names are prefixed with the OpenAPI tag to keep generic operations discoverable.

## Representative Tools

- `pulumi_ai_aitemplate` - POST `/api/ai/template`
- `pulumi_miscellaneous_capabilities` - GET `/api/capabilities`
- `pulumi_organizations_list_gates` - GET `/api/change-gates/{orgName}`
- `pulumi_organizations_create_gate` - POST `/api/change-gates/{orgName}`
- `pulumi_organizations_delete_gate` - DELETE `/api/change-gates/{orgName}/{gateID}`
- `pulumi_organizations_read_gate` - GET `/api/change-gates/{orgName}/{gateID}`
- `pulumi_organizations_update_gate` - PUT `/api/change-gates/{orgName}/{gateID}`
- `pulumi_organizations_list_change_requests` - GET `/api/change-requests/{orgName}`
- `pulumi_organizations_get` - GET `/api/change-requests/{orgName}/{changeRequestID}`
- `pulumi_organizations_update` - PATCH `/api/change-requests/{orgName}/{changeRequestID}`
- `pulumi_organizations_apply` - POST `/api/change-requests/{orgName}/{changeRequestID}/apply`
- `pulumi_organizations_unapprove` - DELETE `/api/change-requests/{orgName}/{changeRequestID}/approve`
- `pulumi_organizations_approve` - POST `/api/change-requests/{orgName}/{changeRequestID}/approve`
- `pulumi_organizations_close` - POST `/api/change-requests/{orgName}/{changeRequestID}/close`
- `pulumi_organizations_add_comment` - POST `/api/change-requests/{orgName}/{changeRequestID}/comments`
- `pulumi_organizations_list_events` - GET `/api/change-requests/{orgName}/{changeRequestID}/events`
- `pulumi_organizations_submit` - POST `/api/change-requests/{orgName}/{changeRequestID}/submit`
- `pulumi_miscellaneous_version` - GET `/api/cli/version`
- `pulumi_vcs_integrations_list_all_vcsintegrations` - GET `/api/console/orgs/{orgName}/integrations`
- `pulumi_vcs_integrations_list_azure_dev_ops_integrations` - GET `/api/console/orgs/{orgName}/integrations/azure-devops`
