# Neon Lua Docs

Namespace: `neon`

Neon tools call the official Neon API. Configure a Neon API key and use the default base URL `https://console.neon.tech/api/v2` unless targeting a compatible endpoint. The API reference is documented at `https://neon.com/docs/reference/api-reference`.

This integration mirrors the official Neon OpenAPI document, including tools for API keys, projects, shared projects, operations, permissions, preload libraries, transfer requests, JWKS, Neon Auth, branches, Data API, databases, roles, compute endpoints, VPC endpoint restrictions, consumption history, organizations, billing spending limits, current user, and organization/project transfers.

Common tools:

```lua
local projects = neon.neon_list_projects({})

local project = neon.neon_get_project({
  project_id = "example-project-id"
})

local branches = neon.neon_list_branches({
  project_id = "example-project-id"
})
```

Request bodies can be passed as a `body` object. For JSON endpoints, loose arguments that are not path, query, or header parameters are also sent as the request body.

The generated tools preserve older common slugs such as `neon_list_projects`, `neon_get_project`, `neon_create_project`, `neon_list_branches`, `neon_get_branch`, `neon_list_databases`, and `neon_get_current_user`.

Use fake project ids, branch ids, organization ids, and API keys in examples and tests. Do not store real Neon API keys or private project identifiers in committed fixtures.
