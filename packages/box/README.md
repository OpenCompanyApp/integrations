# Box Integration

Generated Laravel integration for the official Box Platform API OpenAPI specification.

## Coverage

This package exposes the operations published at `https://raw.githubusercontent.com/box/box-openapi/main/openapi.json`, including:

- files and folders
- uploads and downloads
- users and groups
- collaborations and comments
- metadata templates and instances
- tasks
- retention policies and legal holds
- file requests
- sign requests
- webhooks and events
- collections, shared links, and search

## Configuration

Requests use `Authorization: Bearer <access_token>`.

| Key | Default | Notes |
|-----|---------|-------|
| `access_token` | none | Required Box OAuth2 access token or developer token. |
| `url` | `https://api.box.com/2.0` | Box API base URL. |
| `upload_url` | `https://upload.box.com/api/2.0` | Box upload API base URL for multipart upload endpoints. |

See `script-docs/box.md` for tool naming, argument, and return-shape notes.
