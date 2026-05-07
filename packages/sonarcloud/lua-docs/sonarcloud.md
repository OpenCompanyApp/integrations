# SonarCloud Lua Tools

Namespace: `sonarcloud`

This integration is generated from the SonarCloud Web API registry exposed by `https://sonarcloud.io/api/webservices/list`. It uses bearer-token authentication and sends GET parameters as query strings and POST parameters as form data.

Configure `api_token` with a SonarCloud token and `url` with the Cloud base URL. The default EU instance is `https://sonarcloud.io`; SonarSource also documents a US instance at `https://sonarqube.us`.

## Coverage

- Services: 33
- Tools: 156
- Read tools: 69
- Write tools: 87

## Usage Notes

- Tool parameters use snake_case, while requests are sent with official parameter names.
- POST tools send form data, not JSON bodies.
- Empty optional parameters are omitted.
- Cloud and Server have different API surfaces; use `sonarcloud` for SonarQube Cloud and `sonarqube` for self-hosted/server instances.

## Example Tools

- `sonarcloud_authentication_logout` -> `POST /api/authentication/logout`
- `sonarcloud_authentication_validate` -> `GET /api/authentication/validate`
- `sonarcloud_ce_activity` -> `GET /api/ce/activity`
- `sonarcloud_ce_activity_status` -> `GET /api/ce/activity_status`
- `sonarcloud_ce_component` -> `GET /api/ce/component`

## Example Lua

```lua
local projects = sonarcloud.sonarcloud_projects_search({ organization = "example-org" })
local measures = sonarcloud.sonarcloud_measures_component({ component = "example-key", metric_keys = "bugs,vulnerabilities,code_smells" })
```
