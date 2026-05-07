# Integration: Appwrite

Appwrite integration for Laravel agents. It uses the Appwrite server REST API to manage databases, collections, documents, users, teams, storage metadata, functions, executions, messaging providers, topics, and messages.

Official API reference: https://appwrite.io/docs/references/cloud/server-rest

## Credentials

- `api_key`: Appwrite project API key.
- `project_id`: Appwrite project ID.
- `url`: Appwrite REST endpoint. Use `https://cloud.appwrite.io/v1` for Appwrite Cloud or your self-hosted `/v1` URL.

## Tool Surface

The package exposes 46 tools across:

- Databases, collections, and documents.
- Users and teams.
- Storage buckets and file metadata.
- Functions and executions.
- Messaging providers, topics, email messages, push messages.

Tool arguments use snake_case and the service maps them to Appwrite REST fields where the upstream API uses camelCase.
