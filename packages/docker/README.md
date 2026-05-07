# Integration: Docker Hub

Docker Hub integration package for OpenCompany and KosmoKrator agents.

This package exposes generated tools from Docker's official Hub API OpenAPI document. It covers repositories, tags, access tokens, audit logs, organization settings, organization access tokens, members, groups, invites, immutable tags, repository groups, and SCIM users/groups/schemas.

## Configuration

Required credentials:

- `access_token`: Docker Hub personal access token or bearer token.
- `url`: API root URL. Defaults to `https://hub.docker.com`.

Legacy configs using `https://hub.docker.com/v2` still work for `/v2` endpoints.

## Tool Coverage

The generated tool catalog is built from:

```text
https://docs.docker.com/reference/api/hub/latest.yaml
```

Compatibility slugs that still map to official operations are preserved:

- `docker_list_repositories`
- `docker_get_repository`
- `docker_create_repository`
- `docker_list_tags`
- `docker_get_tag`

The previous `docker_list_organizations` and `docker_get_current_user` helpers were removed because the current official spec does not expose those operations.

## Notes

Generated tools accept OpenAPI parameter names and snake_case aliases. JSON request bodies go in `body`; if `body` is omitted, loose non-path/query/header arguments become the body.
