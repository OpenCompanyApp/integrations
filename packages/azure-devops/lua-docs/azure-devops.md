# Azure DevOps

Namespace: `azure-devops`

This integration exposes Azure DevOps Services REST API 7.2 operations generated from the official MicrosoftDocs Swagger specifications. It covers projects, Git repositories and pull requests, work item tracking, builds, releases, pipelines, artifacts and package feeds, test plans/results, service hooks, security, Graph identities, notifications, dashboards, environments, and organization APIs.

## Authentication

Provide either an Azure DevOps personal access token (`personal_access_token`) or a Microsoft Entra access token (`access_token`). PAT credentials are sent using Basic authentication with an empty username, matching Azure DevOps REST API guidance.

## Usage notes

- Most tools require `organization`; many also require `project`.
- API versions default to the version declared by the official 7.2 Swagger operation. Override with `api_version` only when you know the host supports it.
- Query and path parameters use snake_case names. For example, `repositoryId` becomes `repository_id`.
- Raw upload endpoints use `body.content` and optional `body.content_type`.
- Different endpoint families target different Azure DevOps hosts, including `dev.azure.com`, `vssps.dev.azure.com`, `pkgs.dev.azure.com`, `vsrm.dev.azure.com`, and service-specific hosts. The generated tools keep the official host for each operation.

## Example

```lua
local projects = azure_devops_core_projects_list({ organization = "contoso" })
local repos = azure_devops_git_repositories_list({ organization = "contoso", project = "Website" })
local work_items = azure_devops_wit_work_items_get_work_items_batch({
  organization = "contoso",
  project = "Website",
  body = { ids = { 1, 2, 3 }, fields = { "System.Title", "System.State" } }
})
```
