# SonarQube Lua Tools

Namespace: `sonarqube`

This integration is generated from the SonarQube Server Web API registry exposed by `https://next.sonarqube.com/sonarqube/api/webservices/list`. It uses the documented bearer-token authentication scheme and sends GET parameters as query strings and POST parameters as form data, matching SonarQube Web API guidance.

Configure `api_token` with a SonarQube user token and `url` with the server base URL, for example `https://sonarqube.example.test`.

## Coverage

- Services: 42
- Tools: 271
- Read tools: 106
- Write tools: 165

Deprecated Web API actions remain exposed when the official registry still lists them, so agents can operate against older servers that have not moved to replacement API v2 endpoints.

## Usage Notes

- Tool parameters use snake_case, while requests are sent with the official SonarQube parameter names.
- POST tools send form data, not JSON bodies.
- Empty optional parameters are omitted.
- Returned payloads are parsed JSON when possible; empty responses return `{ success = true, status = <http_status> }`.

## Example Tools

- `sonarqube_alm_integrations_list_azure_projects` -> `GET /api/alm_integrations/list_azure_projects`
- `sonarqube_alm_integrations_list_bitbucketserver_projects` -> `GET /api/alm_integrations/list_bitbucketserver_projects`
- `sonarqube_alm_integrations_search_azure_repos` -> `GET /api/alm_integrations/search_azure_repos`
- `sonarqube_alm_integrations_search_bitbucketcloud_repos` -> `GET /api/alm_integrations/search_bitbucketcloud_repos`
- `sonarqube_alm_integrations_search_bitbucketserver_repos` -> `GET /api/alm_integrations/search_bitbucketserver_repos`
- `sonarqube_alm_integrations_import_azure_project` -> `POST /api/alm_integrations/import_azure_project`
- `sonarqube_alm_integrations_import_bitbucketcloud_repo` -> `POST /api/alm_integrations/import_bitbucketcloud_repo`
- `sonarqube_alm_integrations_import_bitbucketserver_project` -> `POST /api/alm_integrations/import_bitbucketserver_project`
- `sonarqube_alm_integrations_import_github_project` -> `POST /api/alm_integrations/import_github_project`
- `sonarqube_alm_integrations_import_gitlab_project` -> `POST /api/alm_integrations/import_gitlab_project`

## Example Lua

```lua
local projects = sonarqube.sonarqube_projects_search({ q = "example" })
local measures = sonarqube.sonarqube_measures_component({ component = "example-key", metric_keys = "bugs,vulnerabilities,code_smells" })
```
