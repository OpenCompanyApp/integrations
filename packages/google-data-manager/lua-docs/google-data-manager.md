# Google Data Manager

Namespace: `google_data_manager`

Google Data Manager API integration for first-party data ingestion into Google advertising destinations. Use this package for conversion event ingestion, audience member ingestion/removal, and asynchronous request status polling.

Official references:

- Overview: https://developers.google.com/data-manager/api
- REST reference: https://developers.google.com/data-manager/api/reference/rest
- OAuth scope: `https://www.googleapis.com/auth/datamanager`
- Events ingest endpoint: `/v1/events:ingest`
- Audience members ingest endpoint: `/v1/audienceMembers:ingest`
- Audience members remove endpoint: `/v1/audienceMembers:remove`
- Request status endpoint: `/v1/requestStatus:retrieve`

## Authentication

Required credential shape:

- `access_token`: OAuth token with the `datamanager` scope, or a refresh-token credential set.

Recommended:

- `refresh_token`
- `client_id`
- `client_secret`
- `expires_at`

CLI hosts such as KosmoKrator can run with manually generated refresh tokens and no pre-seeded access token when `client_id`, `client_secret`, and `refresh_token` are configured. Web hosts should expose an OAuth redirect flow for self-service connection.

## Safety model

Live ingestion and removal tools require `confirm_execute=true`. If an endpoint supports validation, pass `validate_only=true` to request validation behavior.

## Tools

`google_data_manager_diagnostics()`

Returns safe configuration metadata, scope, and CLI support status.

`google_data_manager_ingest_events({ destinations, events, consent, encoding, encryption_info, confirm_execute })`

Uploads conversion event resources. Maximum 2,000 events per request.

Example:

```lua
google_data_manager_ingest_events({
  confirm_execute = true,
  destinations = {
    {
      operatingAccount = { product = "GOOGLE_ADS", accountId = "1234567890" }
    }
  },
  consent = {
    adUserData = "GRANTED",
    adPersonalization = "GRANTED"
  },
  events = {
    {
      eventTimestamp = "2026-06-01T10:00:00Z",
      transactionId = "order-example-1",
      currencyCode = "USD",
      conversionValue = 125.50
    }
  }
})
```

`google_data_manager_ingest_audience_members({ destinations, audience_members, consent, encoding, encryption_info, terms_of_service, confirm_execute })`

Uploads audience member resources. Maximum 10,000 audience members per request.

`google_data_manager_remove_audience_members({ destinations, audience_members, consent, confirm_execute })`

Removes audience members from destinations. Maximum 10,000 audience members per request.

`google_data_manager_retrieve_request_status({ request_id })`

Polls async processing status for an ingestion or removal request.

`google_data_manager_raw_request({ method, path, body, query, confirm_execute })`

Low-level API escape hatch. Non-GET raw requests require `confirm_execute=true`.

## Production notes

- Data Manager payload shapes are destination-specific. Keep destination and consent fields explicit in the calling workflow.
- Do not log raw PII in prompts, tests, or fixtures. Hash or encrypt user data when required by the endpoint and your contract with Google.
- Store OAuth credentials only in the host credential resolver.
- Poll request status after large uploads and surface partial failures to operators.
