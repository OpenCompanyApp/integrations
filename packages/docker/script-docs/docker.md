# Docker Hub Ruby API Reference

Namespace: `docker`

This integration exposes generated coverage for Docker Hub's official OpenAPI document at `https://docs.docker.com/reference/api/hub/latest.yaml`.

Configure `url` as the API root, usually `https://hub.docker.com`. Existing configs that use `https://hub.docker.com/v2` continue to work for `/v2` tools.

Authentication uses a Docker Hub bearer token or personal access token. Endpoint access depends on the token and organization permissions.

## Common Tools

- `docker_list_repositories` maps to `GET /v2/namespaces/{namespace}/repositories`.
- `docker_get_repository` maps to `GET /v2/namespaces/{namespace}/repositories/{repository}`.
- `docker_create_repository` maps to `POST /v2/namespaces/{namespace}/repositories`.
- `docker_list_tags` maps to `GET /v2/namespaces/{namespace}/repositories/{repository}/tags`.
- `docker_get_tag` maps to `GET /v2/namespaces/{namespace}/repositories/{repository}/tags/{tag}`.

The generated catalog also covers user login/token endpoints, access tokens, audit logs, organization settings, organization access tokens, members, groups, invites, immutable tags, repository groups, and SCIM users/groups/schemas.

## Arguments

Path and query parameters use names from Docker's OpenAPI document. Snake-case aliases are also accepted. JSON request bodies go in `body`; if `body` is omitted, non-path/query/header arguments are collected into the body.

## Examples

```ruby
repos = app.integrations.docker.list_repositories_namespace(namespace: "example-org", page_size: 25, page: 1)
```
```ruby
repo = app.integrations.docker.get_repository_namespace(namespace: "example-org", repository: "api")
```
```ruby
tags = app.integrations.docker.list_repository_tags(namespace: "example-org", repository: "api", page_size: 50)
```
```ruby
created = app.integrations.docker.create_new_repository(namespace: "example-org", body: {name: "agent-demo", description: "Demo repository", is_private: true})
```
## Return Shapes

Responses are Docker Hub's parsed JSON responses. Paginated endpoints usually include `count`, `next`, `previous`, and `results` fields.

Non-JSON responses return:

```ruby
example = {body: "...", content_type: "text/plain"}
```
The previous `docker_list_organizations` and `docker_get_current_user` helpers are intentionally not part of the generated catalog because the current official Hub OpenAPI document does not expose those operations.
