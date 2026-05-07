# Airtop Integration

Generated Laravel integration for the official Airtop OpenAPI specification.

## Coverage

This package exposes the operations published at `https://docs.airtop.ai/openapi.json`, including:

- sessions
- browser windows
- sync and async automation
- form filling
- page querying and content extraction
- screenshots
- profiles
- automations
- files
- async request status

## Configuration

Requests use `Authorization: Bearer <api_key>`.

| Key | Default | Notes |
|-----|---------|-------|
| `api_key` | none | Required Airtop API key. |
| `url` | `https://api.airtop.ai/api` | Override only for a custom Airtop-compatible endpoint. |

See `lua-docs/airtop.md` for tool naming, arguments, and return-shape notes.
