# Semgrep Lua API

Generated from Semgrep's official Web API OpenAPI document at `https://semgrep.dev/api/v1/public_v1.openapi.yaml`. The namespace is `app.integrations.semgrep`.

This package exposes 27 endpoint-specific tools: 11 read tools and 16 write tools. Use a Semgrep API token with Web API access enabled.

## Usage

```lua
local ping = app.integrations.semgrep.misc_service_ping({})

local findings = app.integrations.semgrep.findings_service_list_findings({
  deployment_slug = "example-deployment"
})
```

## Request Bodies

Tools that create, update, search, link, or triage resources may accept a `body` table. The table is passed as the JSON body expected by the Semgrep Web API schema. Path and query arguments use snake_case names and are mapped back to the official parameter names.

## Tools

| `semgrep_misc_service_get_bootstrap_sms_vpc` | read | GET `/api/v1/bootstrap-sms-vpc` |
| `semgrep_deployments_service_list_deployments` | read | GET `/api/v1/deployments` |
| `semgrep_supply_chain_service_list_dependencies` | write | POST `/api/v1/deployments/{deploymentId}/dependencies` |
| `semgrep_supply_chain_service_list_repositories_for_dependencies` | write | POST `/api/v1/deployments/{deploymentId}/dependencies/repositories` |
| `semgrep_supply_chain_service_list_lockfiles_for_dependencies` | write | POST `/api/v1/deployments/{deploymentId}/dependencies/repositories/{repositoryId}/lockfiles` |
| `semgrep_policies_service_list_policies` | read | GET `/api/v1/deployments/{deploymentId}/policies` |
| `semgrep_policies_service_list_policy_rules` | read | GET `/api/v1/deployments/{deploymentId}/policies/{policyId}` |
| `semgrep_policies_service_update_policy` | write | PUT `/api/v1/deployments/{deploymentId}/policies/{policyId}` |
| `semgrep_supply_chain_service_create_sbom_export` | write | POST `/api/v1/deployments/{deploymentId}/sbom/export` |
| `semgrep_supply_chain_service_get_sbom_export` | read | GET `/api/v1/deployments/{deploymentId}/sbom/export/{taskToken}` |
| `semgrep_scans_service_get_scan` | read | GET `/api/v1/deployments/{deploymentId}/scan/{scanId}` |
| `semgrep_scans_service_search_scans` | write | POST `/api/v1/deployments/{deploymentId}/scans/search` |
| `semgrep_secrets_service_list_secrets_path` | read | GET `/api/v1/deployments/{deploymentId}/secrets` |
| `semgrep_ticketing_service_delete_ticket` | write | DELETE `/api/v1/deployments/{deploymentId}/ticketing/v2/tickets/{externalTicketId}` |
| `semgrep_ticketing_service_link_ticket` | write | POST `/api/v1/deployments/{deploymentId}/tickets/link` |
| `semgrep_ticketing_service_unlink_ticket` | write | POST `/api/v1/deployments/{deploymentId}/tickets/unlink` |
| `semgrep_findings_service_list_findings` | read | GET `/api/v1/deployments/{deploymentSlug}/findings` |
| `semgrep_projects_service_list_projects` | read | GET `/api/v1/deployments/{deploymentSlug}/projects` |
| `semgrep_projects_service_get_project` | read | GET `/api/v1/deployments/{deploymentSlug}/projects/{projectName}` |
| `semgrep_projects_service_update_project` | write | PATCH `/api/v1/deployments/{deploymentSlug}/projects/{projectName}` |
| `semgrep_projects_service_delete_project` | write | DELETE `/api/v1/deployments/{deploymentSlug}/projects/{projectName}` |
| `semgrep_projects_service_toggle_project_managed_scan` | write | PATCH `/api/v1/deployments/{deploymentSlug}/projects/{projectName}/managed-scan` |
| `semgrep_projects_service_add_project_tags` | write | PUT `/api/v1/deployments/{deploymentSlug}/projects/{projectName}/tags` |
| `semgrep_projects_service_delete_project_tags` | write | DELETE `/api/v1/deployments/{deploymentSlug}/projects/{projectName}/tags` |
| `semgrep_ticketing_service_create_ticket` | write | POST `/api/v1/deployments/{deploymentSlug}/tickets` |
| `semgrep_triage_service_bulk_triage` | write | POST `/api/v1/deployments/{deploymentSlug}/triage` |
| `semgrep_misc_service_ping` | read | GET `/api/v1/ping` |


## Notes

- The base URL defaults to `https://semgrep.dev`.
- Authentication uses `Authorization: Bearer <token>`.
- Returned data is the parsed JSON response from Semgrep.
