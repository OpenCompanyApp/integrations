# SmartRecruiters

Namespace: `smartrecruiters`

SmartRecruiters tools map one-to-one to the official OpenAPI specs listed in the SmartRecruiters Developer Hub API Reference. The package combines the public registry specs for jobs, candidates, applications, configuration, interviews, reporting, users, webhooks, assessments, approvals, offers, and marketplace/partner APIs.

Authentication depends on the endpoint family. Customer APIs generally accept `x-smarttoken`; marketplace and partner flows may require OAuth bearer tokens. Configure either `api_key`, `access_token`, or client credentials. When only client credentials are configured, the service requests an OAuth token from `token_url`.

## Request Shape

- Path and query parameters use snake_case tool keys while preserving SmartRecruiters' official HTTP parameter names internally.
- JSON, JSON Patch, form, and multipart endpoints accept a `body` object. Multipart file-like values should be supplied as scalar or JSON-serializable body fields; hosts that need binary upload streams can extend the service layer without changing tool names.
- Array query parameters follow the OpenAPI serialization hints from the official spec.
- Returned data is the decoded JSON response when JSON is returned. Empty successful responses return `{ success, status }`; CSV or other text responses return `{ body, status, content_type }`.

## Common Tools

- `smartrecruiters_apply_create_candidate`: Create a New Candidate Application (`POST /postings/{uuid}/candidates` from `apply-api.json`)
- `smartrecruiters_apply_get_apply_configuration_for_posting`: Get application configuration for posting (`GET /postings/{uuid}/configuration` from `apply-api.json`)
- `smartrecruiters_apply_get_application_status`: Get candidate status (`GET /postings/{uuid}/candidates/{candidateId}/status` from `apply-api.json`)
- `smartrecruiters_approvals_approvals_get_by_id`: Get approval request by id (`GET /approvals/{approvalRequestId}` from `approvals-api.json`)
- `smartrecruiters_approvals_approvals_comments_get`: Get comments for given approval request (`GET /approvals/{approvalRequestId}/comments` from `approvals-api.json`)
- `smartrecruiters_approvals_approvals_comments_create`: Add comment to given approval request (`POST /approvals/{approvalRequestId}/comments` from `approvals-api.json`)
- `smartrecruiters_approvals_approvals_get`: Get pending approvals requests where you are an approver. (`GET /approvals` from `approvals-api.json`)
- `smartrecruiters_approvals_approvals_create`: Create approval request (`POST /approvals` from `approvals-api.json`)
- `smartrecruiters_approvals_approvals_approve`: Approve the approval request by id (`POST /approvals/{approvalRequestId}/approve-decisions` from `approvals-api.json`)
- `smartrecruiters_approvals_approvals_reject`: Reject the approval request by id (`POST /approvals/{approvalRequestId}/reject-decisions` from `approvals-api.json`)
- `smartrecruiters_assessments_orders_get_list`: Retrieves all assessment orders for specified application (`GET /assessment-orders` from `assessments-api.json`)
- `smartrecruiters_audit_audit_get`: List audit events (`GET /audit-events` from `audit-api.json`)
- `smartrecruiters_configuration_configuration_access_group_create`: Create access group (`POST /configuration/access-groups` from `configuration-api.json`)
- `smartrecruiters_configuration_configuration_access_group_list`: List access groups (`GET /configuration/access-groups` from `configuration-api.json`)
- `smartrecruiters_configuration_configuration_access_group_get`: Get access group (`GET /configuration/access-groups/{accessGroupId}` from `configuration-api.json`)
- `smartrecruiters_configuration_configuration_access_group_update`: Update access group (`PUT /configuration/access-groups/{accessGroupId}` from `configuration-api.json`)
- `smartrecruiters_configuration_configuration_access_group_delete`: Delete access group (`DELETE /configuration/access-groups/{accessGroupId}` from `configuration-api.json`)
- `smartrecruiters_configuration_configuration_company_my`: Get company information (`GET /configuration/company` from `configuration-api.json`)

## Examples

```js
var jobs = smartrecruiters.smartrecruiters_jobs_search_jobs({ limit: 10 })

var candidate = smartrecruiters.smartrecruiters_candidates_get_candidate({
  candidate_id: "candidate-123",
})

var webhook = smartrecruiters.smartrecruiters_webhooks_create_webhook_subscription({
  body: {
    callbackUrl: "https://example.test/webhooks/smartrecruiters",
    events: [ "candidate.created" ],
  }
})
```
Some operations are partner-only, deprecated, or scope-gated by SmartRecruiters. Prefer least-privilege OAuth scopes or a dedicated API key for automation accounts.
