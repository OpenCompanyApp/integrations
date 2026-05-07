# Integration: Replicate

Replicate HTTP API integration for OpenCompany and KosmoKrator agents. The package maps to the official OpenAPI schema and covers models, predictions, deployments, files, trainings, search, collections, hardware, account, and webhook signing-secret operations.

## Authentication

Configure:

- `api_key`: Replicate API token.
- `url`: API base URL. Defaults to `https://api.replicate.com/v1`.

## Coverage

This package is generated from:

- OpenAPI schema: https://api.replicate.com/openapi.json
- HTTP API docs: https://replicate.com/docs/reference/http

It currently exposes 37 operations from the schema.

## Notes

File uploads use multipart form data. The `content` field can be raw string content or a local file path. Search models uses Replicate's documented `QUERY /models` operation with a plain-text body.
