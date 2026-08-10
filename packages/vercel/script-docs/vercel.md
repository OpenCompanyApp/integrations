# Vercel Integration

The Vercel integration provides tools to manage your Vercel projects, deployments, domains, and teams.

## Authentication

You need a **Vercel API token** (Bearer token). Generate one at [vercel.com/account/tokens](https://vercel.com/account/tokens).

The token is sent as a `Bearer` header on every request. Ensure it has the scopes required for the operations you plan to use.

---

## Projects

### List Projects

```js
var projects = app.integrations.vercel.vercel_list_projects({
    limit: 20,
    team_id: "team_xxx" // optional,
})
```
| Parameter | Type     | Required | Description                                 |
|-----------|----------|----------|---------------------------------------------|
| `limit`   | integer  | No       | Max projects to return (default 20, max 100)|
| `team_id` | string   | No       | Scope to a specific team                    |

### Get Project

```js
var project = app.integrations.vercel.vercel_get_project({
    id: "prj_xxx",
})
```
| Parameter | Type   | Required | Description                       |
|-----------|--------|----------|-----------------------------------|
| `id`      | string | Yes      | The project ID                    |
| `team_id` | string | No       | Team ID if project belongs to team|

---

## Deployments

### Create Deployment

```js
var deployment = app.integrations.vercel.vercel_create_deployment({
    name: "my-project",
    git_source: {
        type: "github",
        ref: "main",
        repoId: 12345,
    },
    target: "preview",
    team_id: "team_xxx" // optional,
})
```
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `name` | string | Yes | Project name to deploy |
| `files` | array | No | File objects for direct-upload deployments |
| `git_source` | object | No | Git source reference |
| `target` | string | No | `production` or `preview` |
| `framework` | string | No | Framework preset slug |
| `regions` | array | No | Region codes |
| `project_settings` | object | No | Deployment project settings override |
| `team_id` | string | No | Scope to a specific team |
| `slug` | string | No | Scope to a specific team slug |

### List Deployments

```js
var deployments = app.integrations.vercel.vercel_list_deployments({
    project_id: "prj_xxx", // optional,
    state: "READY", // optional: READY, ERROR, BUILDING, QUEUED,
    target: "production", // optional: production, preview, development,
    limit: 20,
    team_id: "team_xxx" // optional,
})
```
| Parameter    | Type    | Required | Description                                              |
|--------------|---------|----------|----------------------------------------------------------|
| `project_id` | string  | No       | Filter by project ID                                     |
| `state`      | string  | No       | Filter by state (READY, ERROR, BUILDING, QUEUED)         |
| `target`     | string  | No       | Filter by target (production, preview, development)      |
| `limit`      | integer | No       | Max deployments to return (default 20, max 100)          |
| `team_id`    | string  | No       | Scope to a specific team                                 |

### Get Deployment

```js
var deployment = app.integrations.vercel.vercel_get_deployment({
    id: "dpl_xxx",
})
```
| Parameter | Type   | Required | Description                            |
|-----------|--------|----------|----------------------------------------|
| `id`      | string | Yes      | The deployment ID                      |
| `team_id` | string | No       | Team ID if deployment belongs to team  |

---

## Domains

### List Domains

```js
var domains = app.integrations.vercel.vercel_list_domains({
    limit: 20,
    team_id: "team_xxx" // optional,
})
```
| Parameter | Type     | Required | Description                                |
|-----------|----------|----------|--------------------------------------------|
| `limit`   | integer  | No       | Max domains to return (default 20, max 100)|
| `team_id` | string   | No       | Scope to a specific team                   |

---

## Teams

### List Teams

```js
var teams = app.integrations.vercel.vercel_list_teams({
    limit: 20,
})
```
| Parameter | Type     | Required | Description                             |
|-----------|----------|----------|-----------------------------------------|
| `limit`   | integer  | No       | Max teams to return (default 20, max 100)|

---

## User

### Get Current User

```js
var user = app.integrations.vercel.vercel_get_current_user({})
```
Returns the authenticated user profile including username, email, and plan details. No parameters required.

---

## Pagination

List endpoints (`list_projects`, `list_deployments`, `list_domains`, `list_teams`) support a `limit` parameter. Use smaller limits for faster responses. Vercel may return a `pagination` object with `next` cursors for fetching additional pages.

---

## Notes

- All API calls use the Vercel v2 REST API (`https://api.vercel.com/v2`).
- The integration calls Vercel's versioned REST endpoints under `https://api.vercel.com`, including `/v10/projects`, `/v9/projects/{idOrName}`, `/v6/deployments`, `/v13/deployments`, `/v5/domains`, `/v2/teams`, and `/v2/user`.
- Token scopes determine which resources are accessible. A **Full Account** token provides access to all endpoints.
- The `team_id` parameter is optional for personal accounts but required when accessing team-scoped resources.

## Multi-Account Usage

You can configure multiple Vercel accounts (e.g., personal and team):

```js
// Default account
var projects = app.integrations.vercel.vercel_list_projects({})

// Named account
var projects = app.integrations.vercel.vercel_list_projects({
    account: "my-team",
})
```