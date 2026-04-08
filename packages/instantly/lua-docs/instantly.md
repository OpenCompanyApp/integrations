# Instantly Integration

>This integration provides comprehensive coverage of the Instantly.ai cold email outreach platform API v2.

> ## Authentication
> 
> Authenticate your Instantly API v2 using a Bearer token. Provide your API key in workspace settings → Integration > API Keys.
> 
> ## Tools Overview
> 
> The Instantly integration provides **167 tools** covering all major API endpoints:
> 
> | Category | Tools | Count |
> | --- | --- | --- |
> | Accounts | list, get, create, update, delete, pause, resume, mark_account_fixed, warmup_enable, warmup_disable, test_vitals, ctd_status | get_account_mappings |
> | Account Mappings | get_account_mappings |
> | Campaigns | list, get, create, update, delete, activate, pause, duplicate, count_launched, search_by_contact, sending_status |
> | Leads | list, get, create, update, delete, bulk_add, bulk_delete, bulk_assign, move, merge, remove_from_subsequence, subsequence_move |
> | Lead Lists | list, get, create, update, delete, verification_stats |
> | Lead Labels | list, get, create, update, delete, test_ai_label |
> | Analytics | campaign, campaign_overview, campaign_steps, daily_campaign, daily_account, warmup |
> | Emails | list, get, reply, forward, delete, mark_read, unread_count, update |
> | Email Verification | verify, get_status |
> | Email Templates | list, get, create, update, delete |
> | Enrichment | get, create, run, enrich_leads, count_leads, preview_leads, ai_enrichment, ai_progress, history, update_settings |
> | Blocklist | list, get, create, update, delete |
> | Subsequences | list, create, update, delete, duplicate, pause, resume, sending_status |
> | Webhooks | list, get, create, update, delete, test, resume, event_types |
> | Webhook Events | list, get, summary, summary_by_date |
> | API Keys | list, create, delete |
> | Workspace | get, update, change_owner |
> | Workspace Members | list, get, create, update, delete |
> | Workspace Group Members | list, get, admin, create, delete |
> | Workspace Billing | plan_details, subscription_details |
> | Audit Logs | list |
> | Background Jobs | list, get |
> | Inbox Placement | list, get, create, update, delete, esp_options |
> | Inbox Placement Analytics | list, get, deliverability_insights, stats_by_date, stats_by_test |
> | Inbox Placement Reports | list, get |
> | Custom Tags | list, get, create, update, delete, toggle |
> | Custom Tag Mappings | list |
> | Custom Prompt Templates | list, get, create, update, delete |
> | DFY Orders | list, create, list_accounts, cancel_accounts, check_domains, pre_warmed_domains, similar_domains |
> | CRM Actions | list_phone_numbers, delete_phone_number |
> | Sales Flow | list, get, create, update, delete |
> 
> ## Common Parameters
> 
> - **Pagination**: Most list endpoints support `limit` (default 10) and `starting_after` (cursor-based). Use both for paginated results.
> - **Comma-separated values**: Parameters like `account_ids`, `emails`, `lead_ids`, `scopes` accept comma-separated strings and convert to arrays internally.
> - **JSON strings**: Complex parameters like `search_filters`, `sequences`, `campaign_schedule` accept JSON strings. Parse with `json_decode()` before sending.
> 
> ## Rate Limits
> 
> - Default page size: 10 results per page
> - Max 100 results per page for most endpoints
> 
> ## Lead Management
> 
> - Use `list_leads` with `campaign_id` or `list_id` + filter
 - Use `create_lead` with minimal fields: then `bulk_add_leads` for bulk import
 - Leads support interest status values: 1=interested, -1=not_interested" etc. for numeric mapping
> - Use `merge_leads` to combine duplicate leads records
 preserving data from the destination lead
> 
> ## Campaign Schedules
> 
> Define sending schedule including days of the week, time windows, and per-campaign schedule gap.
 - `sequences` is a JSON array of step objects containing email body, HTML subject, template variables, etc.
 
> ## AI Enrichment
> 
> - Use `create_ai_enrichment` to set up AI-powered custom columns on lead data
> - Supports `preview` before committing via `enrichment_preview_leads`
> 
> ## Email Accounts
> 
> - SMTP/IMAP credentials required for creating accounts
> - Warmup can be enabled/disabled per account and starts automatically with daily limit increase
> - Use `test_vitals` to check DNS, SMTP, and IMAP connectivity
> - Tracking domains via `ctd_status` to verify custom tracking domain setup
> 
> ## Inbox Placement Tests
> 
> - Used to test email deliverability across different ESPs ( - Create tests with type 0=one-time or 1=automated
> - Use sending methods 0=from Instantly or 1=external
> - `emails` accepts comma-separated seed email addresses
> 
> ## Sales Flows
> 
> - Automate outreach sequences across multiple steps ( conditions, schedules, and sequences)
> - Full JSON definition required for create/update operations
