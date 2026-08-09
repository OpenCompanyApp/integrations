# Apify Integration

Generated Laravel integration for the official Apify API OpenAPI specification.

## Coverage

This package exposes the operations published at `https://docs.apify.com/api/openapi.json`, including:

- actors
- actor versions, builds, and runs
- actor tasks
- datasets
- key-value stores
- request queues and request locks
- logs
- schedules
- tools
- users
- webhooks and webhook dispatches

## Configuration

Requests use `Authorization: Bearer <api_token>`.

| Key | Default | Notes |
|-----|---------|-------|
| `api_token` | none | Required Apify API token. |
| `url` | `https://api.apify.com` | Existing `https://api.apify.com/v2` values remain supported. |

See `script-docs/apify.md` for tool naming, argument, and return-shape notes.
