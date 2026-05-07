# Argo CD Lua Docs

Namespace: `argocd`

Argo CD tools call the official server API exposed under `/api/v1` plus the version endpoint under `/api/version`. Configure the Argo CD server root URL and a bearer token before using protected endpoints.

This integration mirrors the official Argo CD Swagger document, including tools for accounts, applications, application sets, certificates, clusters, GPG keys, notifications, projects, repository credentials, repositories, sessions, settings, streams, write repositories, and server version.

Common tools:

```lua
local apps = argocd.argocd_list_applications({
  project = "default"
})

local app = argocd.argocd_get_application({
  name = "guestbook",
  project = "default"
})

local user = argocd.argocd_get_current_user({})
```

Request bodies can be passed as a `body` object. For JSON endpoints, loose arguments that are not path, query, or header parameters are also sent as the request body.

The generated tools preserve the older common slugs such as `argocd_list_applications`, `argocd_get_application`, `argocd_create_application`, `argocd_list_projects`, `argocd_get_project`, `argocd_list_repositories`, and `argocd_get_current_user`.

Several Argo CD path parameters use upstream names such as `application.metadata.name`, `repo.repo`, or `id.value`. You may pass those exact names or snake_case equivalents such as `application_metadata_name`, `repo_repo`, or `id_value`.

Use fake server URLs, project names, repository URLs, and tokens in examples and tests. Do not store real Argo CD tokens or private cluster URLs in committed fixtures.