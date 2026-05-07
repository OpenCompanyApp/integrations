# Langfuse Integration

Langfuse Public API tools for OpenCompany agents.

## Credentials

- `public_key`: Langfuse project public key, used as Basic Auth username.
- `secret_key`: Langfuse project secret key, used as Basic Auth password.
- `url`: Langfuse host or full `/api/public` URL. Defaults to `https://cloud.langfuse.com`.

## Covered Surfaces

This package currently covers high-value project API operations for health, ingestion, traces, observations, scores, sessions, datasets, dataset items, dataset run items, prompts, comments, metrics, and model definitions.
