# Instantly Integration

This integration targets the Instantly API v2 at `https://api.instantly.ai/api/v2` and uses Bearer token authentication.

## Coverage

The package exposes 181 tools. It covers the current official API v2 resource groups plus a small set of Instantly surfaces that remain present in this package for host compatibility:

- Accounts, OAuth account connection, account-campaign mappings
- Campaigns, campaign sharing/export/import, campaign variables, campaign analytics
- Leads, lead lists, lead labels, interest status updates, subsequences
- Emails, test email send, email verification, email templates
- Block list entries, including bulk create/delete, delete-all, and CSV download
- Webhooks and webhook events
- Workspace, workspace members, workspace group members, workspace billing
- Inbox placement tests, analytics, and reports
- SuperSearch enrichment, custom tags, custom tag mappings
- API keys, audit logs, background jobs, DFY email account orders, CRM phone-number actions
- Compatibility tools for custom prompt templates and sales flows where host catalogs already expose them

## Authentication

Create an Instantly API v2 key in Instantly workspace settings and store it as `api_key`.

Some endpoints require specific API scopes. OAuth account initialization, account movement, API key management, workspace group member operations, and destructive block list operations often require elevated scopes or an admin workspace API key.

## Pagination

Most list tools accept:

- `limit`
- `starting_after`

Pass the returned cursor from one page into `starting_after` to continue pagination. Keep page sizes modest when an agent will inspect the output directly.

## Common Input Formats

Tools prefer Instantly's current snake_case field names. Several tools also accept comma-separated strings for convenience where the official API expects arrays, such as `emails`, `ids`, `bl_values`, `account_ids`, and `variables`.

Complex objects such as campaign `sequences`, `campaign_schedule`, enrichment filters, and sales flow payloads may be passed as JSON strings or native objects depending on the tool parameter.

## Important Workflows

### OAuth Account Connection

Use `instantly_initialize_google_oauth` or `instantly_initialize_microsoft_oauth` to get an `auth_url` and `session_id`. Send the user to `auth_url`, then poll `instantly_get_oauth_session_status` with the session ID until it returns `success`, `error`, or `expired`.

### Test Email

Use `instantly_send_test_email` for preview sends. It requires:

- `eaccount`
- `to_address_email_list`
- `subject`
- `html`

The endpoint sends a test email and does not create an Unibox email entity.

### Lead Interest Status

Use `instantly_update_lead_interest_status` with `lead_email` and `interest_value`. Add `campaign_id` or `list_id` when the workspace may contain the same lead in multiple places. Instantly submits this as a background job.

### Block List Safety

Use bulk block list tools for large changes:

- `instantly_bulk_create_blocklist_entries` with `bl_values`
- `instantly_bulk_delete_blocklist_entries` with `ids`
- `instantly_download_blocklist_entries` for CSV export

`instantly_delete_all_blocklist_entries` requires `confirm=true`. Use `search` or `domains_only` whenever possible to avoid broad workspace deletion.

### Campaign Portability

Use:

- `instantly_share_campaign` to enable sharing for a campaign
- `instantly_export_campaign` to retrieve JSON campaign data
- `instantly_create_campaign_from_export` to clone from a shared/exported campaign
- `instantly_add_campaign_variables` to register variables on an existing campaign

## Normalized Behavior

Analytics tools accept older aliases `campaign_id`, `from`, and `to`, but the service normalizes them to Instantly's current query parameters `id`, `start_date`, and `end_date` before sending requests.

`instantly_test_vitals` sends the current `accounts` array payload. The older `email` shortcut remains available for compatibility and is converted to a one-item `accounts` array.

The block list CSV download returns raw CSV text, not JSON.
