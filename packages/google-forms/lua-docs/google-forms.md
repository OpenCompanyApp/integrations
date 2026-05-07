# Google Forms

Google Forms tools are exposed under `app.integrations.google_forms`. This package is generated from Google's official Forms API v1 Discovery document and exposes 10 REST methods.

## Coverage

- Source: `https://forms.googleapis.com/$discovery/rest?version=v1`
- Read tools: 4
- Write tools: 6
- Base URL: `https://forms.googleapis.com`

## Usage Notes

Pass `formId`, `responseId`, and `watchId` path parameters as top-level arguments. Query parameters can be passed as top-level shortcuts or inside `query`. Create, batch update, publish settings, watch create, and watch renew methods accept the official JSON request object inside `body`.

## Tools

- `google_forms_forms_create` - POST /v1/forms
- `google_forms_forms_get` - GET /v1/forms/{formId}
- `google_forms_forms_set_publish_settings` - POST /v1/forms/{formId}:setPublishSettings
- `google_forms_forms_batch_update` - POST /v1/forms/{formId}:batchUpdate
- `google_forms_forms_responses_list` - GET /v1/forms/{formId}/responses
- `google_forms_forms_responses_get` - GET /v1/forms/{formId}/responses/{responseId}
- `google_forms_forms_watches_renew` - POST /v1/forms/{formId}/watches/{watchId}:renew
- `google_forms_forms_watches_create` - POST /v1/forms/{formId}/watches
- `google_forms_forms_watches_list` - GET /v1/forms/{formId}/watches
- `google_forms_forms_watches_delete` - DELETE /v1/forms/{formId}/watches/{watchId}

## Examples

```lua
local form = app.integrations.google_forms.google_forms_forms_get({ formId = "1FAIpQL..." })

local responses = app.integrations.google_forms.google_forms_forms_responses_list({ formId = "1FAIpQL...", pageSize = 10 })
```

Responses are decoded Google Forms JSON responses, or `{ success = true, status = ... }` for successful empty responses such as watch deletes.
