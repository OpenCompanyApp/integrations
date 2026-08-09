# Supabase JavaScript Reference

Namespace: `supabase`

Supabase tools call the official Management API at `https://api.supabase.com/v1` with `Authorization: Bearer <access_token>`. Use a personal access token for internal automation or an OAuth access token for third-party user authorization.

These tools manage Supabase account resources such as projects, organizations, members, and project API keys. They do not call a project's generated Data REST API at `https://<project_ref>.supabase.co/rest/v1/`.

## Common Patterns

List projects:

```js
var projects = app.integrations.supabase.list_projects({})
```
Get a project:

```js
var project = app.integrations.supabase.get_project({
  project_ref: "abcdefghijklmnopqrst",
})
```
Create a project:

```js
var project = app.integrations.supabase.create_project({
  name: "Example App",
  db_pass: "use-a-secret-from-your-host",
  organization_slug: "example-org",
})
```
List organizations:

```js
var organizations = app.integrations.supabase.list_organizations({})
```
List organization projects:

```js
var projects = app.integrations.supabase.list_organization_projects({
  slug: "example-org",
  limit: 20,
})
```
Get project API keys:

```js
var keys = app.integrations.supabase.get_project_api_keys({
  project_ref: "abcdefghijklmnopqrst",
})
```
## Tool Families

- Account: `get_current_user`
- Projects: `list_projects`, `get_project`, `create_project`, `delete_project`, `get_project_api_keys`
- Organizations: `list_organizations`, `get_organization`, `list_organization_members`, `list_organization_projects`

For `create_project`, pass either the documented fields directly (`name`, `db_pass`, `organization_slug`, plus optional fields such as `region`) or a full `body` object if you need a newer Management API field before this package adds a first-class parameter.

Use fake project refs, organization slugs, database passwords, and API keys in examples and tests. Do not store real Supabase access tokens, project refs, organization slugs, or project API keys in committed fixtures.
