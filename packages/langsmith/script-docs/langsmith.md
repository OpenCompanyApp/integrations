# LangSmith - JavaScript API Reference

LangSmith tools are exposed under `app.integrations.langsmith`. This package is generated from the official LangSmith OpenAPI document at `https://api.smith.langchain.com/openapi.json` and currently exposes 540 operations.

Configure `api_key` for the `x-api-key` header. Advanced deployments may also set `bearer_token`, `tenant_id` (`x-tenant-id`), `organization_id` (`x-organization-id`), and `base_url` such as `https://eu.api.smith.langchain.com`.

Every endpoint-specific tool accepts path parameters as top-level arguments, known query parameters either as top-level shortcuts or inside `query`, and JSON request bodies inside `body`. Multipart endpoints accept `body.file_path` for local file uploads. Responses are the decoded LangSmith JSON payload, or `{ success = true, status = ... }` for empty successful responses.

## Examples

```js
var sessions = app.integrations.langsmith.langsmith_read_tracer_sessions({
  query: { limit: 10 },
})

var run = app.integrations.langsmith.langsmith_create_run({
  body: {
    name: "support-agent",
    run_type: "chain",
    inputs: { question: "hello" },
    start_time: "2026-05-06T10:00:00Z",
  }
})

var feedback = app.integrations.langsmith.langsmith_create_feedback({
  body: { run_id: run.id, key: "quality", score: 1.0 },
})
```
## Multi-Account Usage

```js
app.integrations.langsmith.langsmith_read_datasets({})
app.integrations.langsmith.default.langsmith_read_datasets({})
app.integrations.langsmith.production.langsmith_read_datasets({})
```
## LangSmith

- `langsmith_get_api_v1_ok` - GET /api/v1/ok - Ok

## Organizations

- `langsmith_get_v1_platform_orgs_current_info` - GET /v1/platform/orgs/current/info - Get current organization info

## SCIM Tokens

- `langsmith_get_v1_platform_orgs_current_scim_tokens` - GET /v1/platform/orgs/current/scim/tokens - List SCIM tokens
- `langsmith_post_v1_platform_orgs_current_scim_tokens` - POST /v1/platform/orgs/current/scim/tokens - Create a SCIM token
- `langsmith_get_v1_platform_orgs_current_scim_tokens_scim_token_id` - GET /v1/platform/orgs/current/scim/tokens/{scim_token_id} - Get a SCIM token
- `langsmith_delete_v1_platform_orgs_current_scim_tokens_scim_token_id` - DELETE /v1/platform/orgs/current/scim/tokens/{scim_token_id} - Delete a SCIM token
- `langsmith_patch_v1_platform_orgs_current_scim_tokens_scim_token_id` - PATCH /v1/platform/orgs/current/scim/tokens/{scim_token_id} - Update a SCIM token

## TTL Settings

- `langsmith_get_workspaces_current_ttl_settings` - GET /workspaces/current/ttl-settings - Get workspace TTL settings
- `langsmith_put_workspaces_current_ttl_settings` - PUT /workspaces/current/ttl-settings - Update workspace TTL settings

## Access Policies

- `langsmith_get_v1_platform_orgs_current_access_policies` - GET /v1/platform/orgs/current/access-policies - List access policies
- `langsmith_post_v1_platform_orgs_current_access_policies` - POST /v1/platform/orgs/current/access-policies - Create an access policy
- `langsmith_post_v1_platform_orgs_current_access_policies_roles_role_id_access_policies` - POST /v1/platform/orgs/current/access-policies/roles/{role_id}/access-policies - Attach access policies to a role
- `langsmith_get_v1_platform_orgs_current_access_policies_access_policy_id` - GET /v1/platform/orgs/current/access-policies/{access_policy_id} - Get an access policy
- `langsmith_delete_v1_platform_orgs_current_access_policies_access_policy_id` - DELETE /v1/platform/orgs/current/access-policies/{access_policy_id} - Delete an access policy

## Ace

- `langsmith_execute` - POST /api/v1/ace/execute - Execute

## Agents

- `langsmith_get_v1_fleet_agents` - GET /v1/fleet/agents - List agents
- `langsmith_post_v1_fleet_agents` - POST /v1/fleet/agents - Create an agent
- `langsmith_get_v1_fleet_agents_agentid` - GET /v1/fleet/agents/{agentID} - Get an agent
- `langsmith_patch_v1_fleet_agents_agentid` - PATCH /v1/fleet/agents/{agentID} - Update an agent

## Alert Rules

- `langsmith_post_v1_platform_alerts_session_id` - POST /v1/platform/alerts/{session_id} - Create an alert rule
- `langsmith_post_v1_platform_alerts_session_id_test` - POST /v1/platform/alerts/{session_id}/test - Test an alert action to determine if configuration is valid
- `langsmith_get_v1_platform_alerts_session_id_alert_rule_id` - GET /v1/platform/alerts/{session_id}/{alert_rule_id} - Get an alert rule
- `langsmith_delete_v1_platform_alerts_session_id_alert_rule_id` - DELETE /v1/platform/alerts/{session_id}/{alert_rule_id} - Delete an alert rule
- `langsmith_patch_v1_platform_alerts_session_id_alert_rule_id` - PATCH /v1/platform/alerts/{session_id}/{alert_rule_id} - Update an alert rule

## Annotation Queues

- `langsmith_get_annotation_queues` - GET /api/v1/annotation-queues - Get Annotation Queues
- `langsmith_create_annotation_queue` - POST /api/v1/annotation-queues - Create Annotation Queue
- `langsmith_delete_annotation_queues` - DELETE /api/v1/annotation-queues - Delete Annotation Queues
- `langsmith_populate_annotation_queue` - POST /api/v1/annotation-queues/populate - Populate Annotation Queue
- `langsmith_delete_annotation_queue` - DELETE /api/v1/annotation-queues/{queue_id} - Delete Annotation Queue
- `langsmith_update_annotation_queue` - PATCH /api/v1/annotation-queues/{queue_id} - Update Annotation Queue
- `langsmith_get_annotation_queue` - GET /api/v1/annotation-queues/{queue_id} - Get Annotation Queue
- `langsmith_add_runs_to_annotation_queue` - POST /api/v1/annotation-queues/{queue_id}/runs - Add Runs To Annotation Queue
- `langsmith_get_runs_from_annotation_queue` - GET /api/v1/annotation-queues/{queue_id}/runs - Get Runs From Annotation Queue
- `langsmith_add_runs_to_annotation_queue_by_key` - POST /api/v1/annotation-queues/{queue_id}/runs/by-key - Add Runs To Annotation Queue By Key
- `langsmith_export_annotation_queue_archived_runs` - POST /api/v1/annotation-queues/{queue_id}/export - Export Annotation Queue Archived Runs
- `langsmith_get_run_from_annotation_queue` - GET /api/v1/annotation-queues/{queue_id}/run/{index} - Get Run From Annotation Queue
- `langsmith_get_annotation_queues_for_run` - GET /api/v1/annotation-queues/{run_id}/queues - Get Annotation Queues For Run
- `langsmith_update_run_in_annotation_queue` - PATCH /api/v1/annotation-queues/{queue_id}/runs/{queue_run_id} - Update Run In Annotation Queue
- `langsmith_delete_run_from_annotation_queue` - DELETE /api/v1/annotation-queues/{queue_id}/runs/{queue_run_id} - Delete Run From Annotation Queue
- `langsmith_delete_runs_from_annotation_queue` - POST /api/v1/annotation-queues/{queue_id}/runs/delete - Delete Runs From Annotation Queue
- `langsmith_get_total_size_from_annotation_queue` - GET /api/v1/annotation-queues/{queue_id}/total_size - Get Total Size From Annotation Queue
- `langsmith_get_total_archived_from_annotation_queue` - GET /api/v1/annotation-queues/{queue_id}/total_archived - Get Total Archived From Annotation Queue
- `langsmith_get_size_from_annotation_queue` - GET /api/v1/annotation-queues/{queue_id}/size - Get Size From Annotation Queue
- `langsmith_create_identity_annotation_queue_run_status` - POST /api/v1/annotation-queues/status/{annotation_queue_run_id} - Create Identity Annotation Queue Run Status
- `langsmith_resolve_annotation_queue_run` - GET /api/v1/annotation-queues/{queue_id}/runs/resolve/{queue_run_id} - Resolve Annotation Queue Run

## Annotation Queues

- `langsmith_post_v1_platform_annotation_queues_queue_id_reviewers` - POST /v1/platform/annotation-queues/{queue_id}/reviewers - Add a reviewer to an annotation queue
- `langsmith_delete_v1_platform_annotation_queues_queue_id_reviewers_identity_id` - DELETE /v1/platform/annotation-queues/{queue_id}/reviewers/{identity_id} - Remove a reviewer from an annotation queue

## Api Key

- `langsmith_get_api_v1_api_key` - GET /api/v1/api-key - Get Api Keys
- `langsmith_post_api_v1_api_key` - POST /api/v1/api-key - Generate Api Key
- `langsmith_delete` - DELETE /api/v1/api-key/{api_key_id} - Delete Api Key
- `langsmith_get_personal_access_tokens` - GET /api/v1/api-key/current - Get Personal Access Tokens
- `langsmith_generate_personal_access_token` - POST /api/v1/api-key/current - Generate Personal Access Token
- `langsmith_delete_personal_access_token` - DELETE /api/v1/api-key/current/{pat_id} - Delete Personal Access Token

## Audit Logs

- `langsmith_get_audit_logs` - GET /api/v1/audit-logs - Get Audit Logs

## Auth

- `langsmith_login` - POST /api/v1/login - Login
- `langsmith_send_sso_email_confirmation` - POST /api/v1/sso/email-verification/send - Send Sso Email Confirmation
- `langsmith_check_sso_email_verification_status` - POST /api/v1/sso/email-verification/status - Check Sso Email Verification Status
- `langsmith_confirm_sso_user_email` - POST /api/v1/sso/email-verification/confirm - Confirm Sso User Email
- `langsmith_get_sso_settings` - GET /api/v1/sso/settings/{sso_login_slug} - Get Sso Settings
- `langsmith_lookup_sso_by_email` - POST /api/v1/sso/email-lookup - Lookup Sso By Email
- `langsmith_get_auth_public` - GET /auth/public - Get public auth info

## Aws Marketplace

- `langsmith_post_aws_marketplace_register` - POST /aws-marketplace/register - AWS Marketplace fulfillment URL registration

## Backfills

- `langsmith_post_v1_platform_ops_backfills_restart` - POST /v1/platform/ops/backfills/restart - Restart a backfill job

## Beacon

- `langsmith_post_v1_beacon_usage_snapshot` - POST /v1/beacon/usage-snapshot - Submit a self-hosted usage snapshot

## Bulk Exports

- `langsmith_get_bulk_exports` - GET /api/v1/bulk-exports - Get Bulk Exports
- `langsmith_create_bulk_export` - POST /api/v1/bulk-exports - Create Bulk Export
- `langsmith_get_bulk_export_destinations` - GET /api/v1/bulk-exports/destinations - Get Bulk Export Destinations
- `langsmith_create_bulk_export_destination` - POST /api/v1/bulk-exports/destinations - Create Bulk Export Destination
- `langsmith_get_bulk_export_runs_filtered` - GET /api/v1/bulk-exports/runs - Get Bulk Export Runs Filtered
- `langsmith_get_bulk_export` - GET /api/v1/bulk-exports/{bulk_export_id} - Get Bulk Export
- `langsmith_cancel_bulk_export` - PATCH /api/v1/bulk-exports/{bulk_export_id} - Cancel Bulk Export
- `langsmith_get_bulk_export_destination` - GET /api/v1/bulk-exports/destinations/{destination_id} - Get Bulk Export Destination
- `langsmith_update_bulk_export_destination` - PATCH /api/v1/bulk-exports/destinations/{destination_id} - Update Bulk Export Destination
- `langsmith_get_bulk_export_runs` - GET /api/v1/bulk-exports/{bulk_export_id}/runs - Get Bulk Export Runs
- `langsmith_get_bulk_export_run` - GET /api/v1/bulk-exports/{bulk_export_id}/runs/{run_id} - Get Bulk Export Run

## Charts

- `langsmith_clone_section` - POST /api/v1/charts/section/clone - Clone Section
- `langsmith_read_sections` - GET /api/v1/charts/section - Read Sections
- `langsmith_create_section` - POST /api/v1/charts/section - Create Section
- `langsmith_read_charts` - POST /api/v1/charts - Read Charts
- `langsmith_read_chart_preview` - POST /api/v1/charts/preview - Read Chart Preview
- `langsmith_create_chart` - POST /api/v1/charts/create - Create Chart
- `langsmith_read_single_chart` - POST /api/v1/charts/{chart_id} - Read Single Chart
- `langsmith_update_chart` - PATCH /api/v1/charts/{chart_id} - Update Chart
- `langsmith_delete_chart` - DELETE /api/v1/charts/{chart_id} - Delete Chart
- `langsmith_read_single_section` - POST /api/v1/charts/section/{section_id} - Read Single Section
- `langsmith_update_section` - PATCH /api/v1/charts/section/{section_id} - Update Section
- `langsmith_delete_section` - DELETE /api/v1/charts/section/{section_id} - Delete Section
- `langsmith_org_read_sections` - GET /api/v1/org-charts/section - Org Read Sections
- `langsmith_org_create_section` - POST /api/v1/org-charts/section - Org Create Section
- `langsmith_org_read_charts` - POST /api/v1/org-charts - Org Read Charts
- `langsmith_org_read_chart_preview` - POST /api/v1/org-charts/preview - Org Read Chart Preview
- `langsmith_org_create_chart` - POST /api/v1/org-charts/create - Org Create Chart
- `langsmith_org_read_single_chart` - POST /api/v1/org-charts/{chart_id} - Org Read Single Chart
- `langsmith_org_update_chart` - PATCH /api/v1/org-charts/{chart_id} - Org Update Chart
- `langsmith_org_delete_chart` - DELETE /api/v1/org-charts/{chart_id} - Org Delete Chart
- `langsmith_org_read_single_section` - POST /api/v1/org-charts/section/{section_id} - Org Read Single Section
- `langsmith_org_update_section` - PATCH /api/v1/org-charts/section/{section_id} - Org Update Section
- `langsmith_org_delete_section` - DELETE /api/v1/org-charts/section/{section_id} - Org Delete Section

## Comments

- `langsmith_create_comment` - POST /api/v1/comments/{owner}/{repo} - Create Comment
- `langsmith_get_comments` - GET /api/v1/comments/{owner}/{repo} - Get Comments
- `langsmith_get_sub_comments` - GET /api/v1/comments/{owner}/{repo}/{parent_comment_id} - Get Sub Comments
- `langsmith_create_sub_comment` - POST /api/v1/comments/{owner}/{repo}/{parent_comment_id} - Create Sub Comment
- `langsmith_like_comment` - POST /api/v1/comments/{owner}/{repo}/{parent_comment_id}/like - Like Comment
- `langsmith_unlike_comment` - DELETE /api/v1/comments/{owner}/{repo}/{parent_comment_id}/like - Unlike Comment

## Commits

- `langsmith_get_commits_owner_repo` - GET /commits/{owner}/{repo} - List commits
- `langsmith_post_commits_owner_repo` - POST /commits/{owner}/{repo} - Create a commit
- `langsmith_get_commits_owner_repo_commit` - GET /commits/{owner}/{repo}/{commit} - Get a commit

## Data Planes

- `langsmith_get_v1_platform_orgs_current_data_planes` - GET /v1/platform/orgs/current/data-planes - List data planes for the current organization

## Datasets

- `langsmith_read_datasets` - GET /api/v1/datasets - Read Datasets
- `langsmith_create_dataset` - POST /api/v1/datasets - Create Dataset
- `langsmith_delete_datasets` - DELETE /api/v1/datasets - Delete Datasets
- `langsmith_read_datasets_stream` - GET /api/v1/datasets/stream - Read Datasets Stream
- `langsmith_read_dataset` - GET /api/v1/datasets/{dataset_id} - Read Dataset
- `langsmith_delete_dataset` - DELETE /api/v1/datasets/{dataset_id} - Delete Dataset
- `langsmith_update_dataset` - PATCH /api/v1/datasets/{dataset_id} - Update Dataset
- `langsmith_upload_csv_dataset` - POST /api/v1/datasets/upload - Upload Csv Dataset
- `langsmith_upload_experiment` - POST /api/v1/datasets/upload-experiment - Upload Experiment
- `langsmith_get_dataset_versions` - GET /api/v1/datasets/{dataset_id}/versions - Get Dataset Versions
- `langsmith_diff_dataset_versions` - GET /api/v1/datasets/{dataset_id}/versions/diff - Diff Dataset Versions
- `langsmith_get_dataset_version` - GET /api/v1/datasets/{dataset_id}/version - Get Dataset Version
- `langsmith_update_dataset_version` - PUT /api/v1/datasets/{dataset_id}/tags - Update Dataset Version
- `langsmith_download_dataset_openai` - GET /api/v1/datasets/{dataset_id}/openai - Download Dataset Openai
- `langsmith_download_dataset_openai_ft` - GET /api/v1/datasets/{dataset_id}/openai_ft - Download Dataset Openai Ft
- `langsmith_download_dataset_csv` - GET /api/v1/datasets/{dataset_id}/csv - Download Dataset Csv
- `langsmith_download_dataset_jsonl` - GET /api/v1/datasets/{dataset_id}/jsonl - Download Dataset Jsonl
- `langsmith_read_examples_with_runs` - POST /api/v1/datasets/{dataset_id}/runs - Read Examples With Runs
- `langsmith_read_examples_with_runs_grouped` - POST /api/v1/datasets/{dataset_id}/group/runs - Read Examples With Runs Grouped
- `langsmith_read_delta` - POST /api/v1/datasets/{dataset_id}/runs/delta - Read Delta
- `langsmith_read_delta_stream` - POST /api/v1/datasets/{dataset_id}/runs/delta/stream - Read Delta Stream
- `langsmith_read_grouped_experiments` - POST /api/v1/datasets/{dataset_id}/experiments/grouped - Read Grouped Experiments
- `langsmith_read_dataset_share_state` - GET /api/v1/datasets/{dataset_id}/share - Read Dataset Share State
- `langsmith_share_dataset` - PUT /api/v1/datasets/{dataset_id}/share - Share Dataset
- `langsmith_unshare_dataset` - DELETE /api/v1/datasets/{dataset_id}/share - Unshare Dataset
- `langsmith_read_comparative_experiments` - GET /api/v1/datasets/{dataset_id}/comparative - Read Comparative Experiments
- `langsmith_create_comparative_experiment` - POST /api/v1/datasets/comparative - Create Comparative Experiment
- `langsmith_delete_comparative_experiment` - DELETE /api/v1/datasets/comparative/{comparative_experiment_id} - Delete Comparative Experiment
- `langsmith_clone_dataset` - POST /api/v1/datasets/clone - Clone Dataset
- `langsmith_get_dataset_splits` - GET /api/v1/datasets/{dataset_id}/splits - Get Dataset Splits
- `langsmith_update_dataset_splits` - PUT /api/v1/datasets/{dataset_id}/splits - Update Dataset Splits
- `langsmith_generate` - POST /api/v1/datasets/{dataset_id}/generate - Generate
- `langsmith_dataset_handler` - POST /api/v1/datasets/playground_experiment/batch - Dataset Handler
- `langsmith_stream_dataset_handler` - POST /api/v1/datasets/playground_experiment/stream - Stream Dataset Handler
- `langsmith_studio_experiment` - POST /api/v1/datasets/studio_experiment - Studio Experiment

## Directories

- `langsmith_get_v1_platform_hub_repos_owner_repo_directories` - GET /v1/platform/hub/repos/{owner}/{repo}/directories - Get directory contents
- `langsmith_delete_v1_platform_hub_repos_owner_repo_directories` - DELETE /v1/platform/hub/repos/{owner}/{repo}/directories - Delete directory repository
- `langsmith_post_v1_platform_hub_repos_owner_repo_directories_commits` - POST /v1/platform/hub/repos/{owner}/{repo}/directories/commits - Create directory commit

## Evaluators

- `langsmith_get_v1_platform_evaluators` - GET /v1/platform/evaluators - List evaluators
- `langsmith_post_v1_platform_evaluators` - POST /v1/platform/evaluators - Create evaluator
- `langsmith_delete_v1_platform_evaluators` - DELETE /v1/platform/evaluators - Bulk delete evaluators
- `langsmith_get_v1_platform_evaluators_evaluator_id` - GET /v1/platform/evaluators/{evaluator_id} - Get evaluator
- `langsmith_delete_v1_platform_evaluators_evaluator_id` - DELETE /v1/platform/evaluators/{evaluator_id} - Delete evaluator
- `langsmith_patch_v1_platform_evaluators_evaluator_id` - PATCH /v1/platform/evaluators/{evaluator_id} - Update evaluator

## Examples

- `langsmith_count_examples` - GET /api/v1/examples/count - Count Examples
- `langsmith_read_example` - GET /api/v1/examples/{example_id} - Read Example
- `langsmith_update_example` - PATCH /api/v1/examples/{example_id} - Update Example
- `langsmith_delete_example` - DELETE /api/v1/examples/{example_id} - Delete Example
- `langsmith_read_examples` - GET /api/v1/examples - Read Examples
- `langsmith_create_example` - POST /api/v1/examples - Create Example
- `langsmith_delete_examples` - DELETE /api/v1/examples - Delete Examples
- `langsmith_create_examples` - POST /api/v1/examples/bulk - Create Examples
- `langsmith_legacy_update_examples` - PATCH /api/v1/examples/bulk - Legacy Update Examples
- `langsmith_upload_examples_from_csv` - POST /api/v1/examples/upload/{dataset_id} - Upload Examples From Csv
- `langsmith_validate_example` - POST /api/v1/examples/validate - Validate Example
- `langsmith_validate_examples` - POST /api/v1/examples/validate/bulk - Validate Examples
- `langsmith_post_v1_platform_datasets_examples` - POST /v1/platform/datasets/examples/delete - Hard Delete Examples
- `langsmith_post_v1_platform_datasets_dataset_id_examples` - POST /v1/platform/datasets/{dataset_id}/examples - Upload Examples
- `langsmith_patch_v1_platform_datasets_dataset_id_examples` - PATCH /v1/platform/datasets/{dataset_id}/examples - Update Examples

## Experiment View Overrides

- `langsmith_get_datasets_dataset_id_experiment_view_overrides` - GET /datasets/{dataset_id}/experiment-view-overrides - Get experiment view override configurations for a dataset
- `langsmith_post_datasets_dataset_id_experiment_view_overrides` - POST /datasets/{dataset_id}/experiment-view-overrides - Create new experiment view override configuration for a dataset
- `langsmith_get_datasets_dataset_id_experiment_view_overrides_id` - GET /datasets/{dataset_id}/experiment-view-overrides/{id} - Get experiment view override configuration by specific ID
- `langsmith_delete_datasets_dataset_id_experiment_view_overrides_id` - DELETE /datasets/{dataset_id}/experiment-view-overrides/{id} - Delete experiment view override configuration
- `langsmith_patch_datasets_dataset_id_experiment_view_overrides_id` - PATCH /datasets/{dataset_id}/experiment-view-overrides/{id} - Update existing experiment view override configuration

## Experiments

- `langsmith_evaluate_experiment_adhoc` - POST /api/v1/runs/experiments/{experiment_id}/evaluate - Evaluate Experiment Adhoc

## Features

- `langsmith_get_v1_platform_features` - GET /v1/platform/features - List feature configurations
- `langsmith_put_v1_platform_features_feature_default_model` - PUT /v1/platform/features/{feature}/default-model - Set default model for a feature
- `langsmith_delete_v1_platform_features_feature_default_model` - DELETE /v1/platform/features/{feature}/default-model - Delete default model for a feature
- `langsmith_put_v1_platform_features_feature_disabled_models` - PUT /v1/platform/features/{feature}/disabled-models - Disable a model for a feature
- `langsmith_delete_v1_platform_features_feature_disabled_models_model` - DELETE /v1/platform/features/{feature}/disabled-models/{model} - Re-enable a disabled model for a feature

## Feedback

- `langsmith_create_feedback_formula_ep` - POST /api/v1/feedback/formulas - Create Feedback Formula Ep
- `langsmith_list_feedback_formula_ep` - GET /api/v1/feedback/formulas - List Feedback Formula Ep
- `langsmith_get_feedback_formula_ep` - GET /api/v1/feedback/formulas/{feedback_formula_id} - Get Feedback Formula Ep
- `langsmith_update_feedback_formula_ep` - PUT /api/v1/feedback/formulas/{feedback_formula_id} - Update Feedback Formula Ep
- `langsmith_delete_feedback_formula_endpoint` - DELETE /api/v1/feedback/formulas/{feedback_formula_id} - Delete Feedback Formula Endpoint
- `langsmith_read_feedback` - GET /api/v1/feedback/{feedback_id} - Read Feedback
- `langsmith_update_feedback` - PATCH /api/v1/feedback/{feedback_id} - Update Feedback
- `langsmith_delete_feedback` - DELETE /api/v1/feedback/{feedback_id} - Delete Feedback
- `langsmith_read_feedbacks` - GET /api/v1/feedback - Read Feedbacks
- `langsmith_create_feedback` - POST /api/v1/feedback - Create Feedback
- `langsmith_eagerly_create_feedback` - POST /api/v1/feedback/eager - Eagerly Create Feedback
- `langsmith_create_feedback_ingest_token` - POST /api/v1/feedback/tokens - Create Feedback Ingest Token
- `langsmith_list_feedback_ingest_tokens` - GET /api/v1/feedback/tokens - List Feedback Ingest Tokens
- `langsmith_create_feedback_with_token_get` - GET /api/v1/feedback/tokens/{token} - Create Feedback With Token Get
- `langsmith_create_feedback_with_token_post` - POST /api/v1/feedback/tokens/{token} - Create Feedback With Token Post

## Feedback Configs

- `langsmith_list_feedback_configs_endpoint` - GET /api/v1/feedback-configs - List Feedback Configs Endpoint
- `langsmith_create_feedback_config_endpoint` - POST /api/v1/feedback-configs - Create Feedback Config Endpoint
- `langsmith_update_feedback_config_endpoint` - PATCH /api/v1/feedback-configs - Update Feedback Config Endpoint
- `langsmith_delete_feedback_config_endpoint` - DELETE /api/v1/feedback-configs - Delete Feedback Config Endpoint

## Fleet Auth

- `langsmith_get_v1_fleet_auth_providers` - GET /v1/fleet/auth-providers - List OAuth providers
- `langsmith_post_v1_fleet_auth_providers` - POST /v1/fleet/auth-providers - Register an OAuth provider
- `langsmith_post_v1_fleet_auth_providers_discover` - POST /v1/fleet/auth-providers/discover - Discover and register an OAuth provider
- `langsmith_get_v1_fleet_auth_providers_provider_id` - GET /v1/fleet/auth-providers/{provider_id} - Get an OAuth provider
- `langsmith_delete_v1_fleet_auth_providers_provider_id` - DELETE /v1/fleet/auth-providers/{provider_id} - Delete an OAuth provider
- `langsmith_patch_v1_fleet_auth_providers_provider_id` - PATCH /v1/fleet/auth-providers/{provider_id} - Update an OAuth provider
- `langsmith_post_v1_fleet_auth_sessions` - POST /v1/fleet/auth-sessions - Start an authorization session
- `langsmith_get_v1_fleet_auth_sessions_session_id` - GET /v1/fleet/auth-sessions/{session_id} - Get an authorization session
- `langsmith_get_v1_fleet_auth_tokens` - GET /v1/fleet/auth-tokens - List your connection tokens
- `langsmith_post_v1_fleet_auth_tokens_revoke` - POST /v1/fleet/auth-tokens/revoke - Revoke connection tokens by filter
- `langsmith_delete_v1_fleet_auth_tokens_token_id` - DELETE /v1/fleet/auth-tokens/{token_id} - Revoke a connection token
- `langsmith_patch_v1_fleet_auth_tokens_token_id` - PATCH /v1/fleet/auth-tokens/{token_id} - Update a connection token

## Fleet Github App

- `langsmith_post_v1_platform_fleet_providers_github_app_auth` - POST /v1/platform/fleet/providers/github-app/auth - Get GitHub OAuth authorization link
- `langsmith_get_v1_platform_fleet_providers_github_app_connection` - GET /v1/platform/fleet/providers/github-app/connection - Get GitHub user connection status
- `langsmith_delete_v1_platform_fleet_providers_github_app_connection` - DELETE /v1/platform/fleet/providers/github-app/connection - Delete GitHub user connection
- `langsmith_patch_v1_platform_fleet_providers_github_app_connection` - PATCH /v1/platform/fleet/providers/github-app/connection - Update GitHub user connection
- `langsmith_post_v1_platform_fleet_providers_github_app_install` - POST /v1/platform/fleet/providers/github-app/install - Get GitHub App install link
- `langsmith_get_v1_platform_fleet_providers_github_app_installations` - GET /v1/platform/fleet/providers/github-app/installations - List GitHub App installations
- `langsmith_post_v1_platform_fleet_providers_github_app_installations_refresh` - POST /v1/platform/fleet/providers/github-app/installations/refresh - Refresh GitHub App installations
- `langsmith_delete_v1_platform_fleet_providers_github_app_installations_id` - DELETE /v1/platform/fleet/providers/github-app/installations/{id} - Delete a GitHub App installation
- `langsmith_get_v1_platform_fleet_providers_github_app_installations_id_repos` - GET /v1/platform/fleet/providers/github-app/installations/{id}/repos - List repositories for a GitHub App installation
- `langsmith_post_v1_platform_fleet_providers_github_app_tokens` - POST /v1/platform/fleet/providers/github-app/tokens - Request a GitHub access token
- `langsmith_post_v1_platform_fleet_providers_github_app_webhooks` - POST /v1/platform/fleet/providers/github-app/webhooks - Handle GitHub App webhook events

## Fleet Integrations

- `langsmith_get_v1_fleet_integrations` - GET /v1/fleet/integrations - List integrations
- `langsmith_post_v1_fleet_integrations` - POST /v1/fleet/integrations - Create a custom integration
- `langsmith_get_v1_fleet_integrations_id` - GET /v1/fleet/integrations/{id} - Get an integration
- `langsmith_delete_v1_fleet_integrations_id` - DELETE /v1/fleet/integrations/{id} - Delete a custom integration
- `langsmith_patch_v1_fleet_integrations_id` - PATCH /v1/fleet/integrations/{id} - Update a custom integration
- `langsmith_put_v1_fleet_integrations_id_auth_methods` - PUT /v1/fleet/integrations/{id}/auth-methods - Replace integration auth methods

## Fleet Mcp

- `langsmith_get_v1_fleet_mcp_servers` - GET /v1/fleet/mcp-servers - List MCP servers
- `langsmith_post_v1_fleet_mcp_servers` - POST /v1/fleet/mcp-servers - Create MCP server
- `langsmith_get_v1_fleet_mcp_servers_mcp_server_id` - GET /v1/fleet/mcp-servers/{mcp_server_id} - Get MCP server
- `langsmith_delete_v1_fleet_mcp_servers_mcp_server_id` - DELETE /v1/fleet/mcp-servers/{mcp_server_id} - Delete MCP server
- `langsmith_patch_v1_fleet_mcp_servers_mcp_server_id` - PATCH /v1/fleet/mcp-servers/{mcp_server_id} - Update MCP server
- `langsmith_post_v1_fleet_mcp_servers_mcp_server_id_oauth_provider` - POST /v1/fleet/mcp-servers/{mcp_server_id}/oauth-provider - Register per-user MCP OAuth provider
- `langsmith_get_v1_fleet_mcp_tools` - GET /v1/fleet/mcp/tools - List MCP tools
- `langsmith_get_v1_platform_fleet_mcp_servers` - GET /v1/platform/fleet/mcp-servers - List MCP servers
- `langsmith_post_v1_platform_fleet_mcp_servers` - POST /v1/platform/fleet/mcp-servers - Create MCP server
- `langsmith_get_v1_platform_fleet_mcp_servers_mcp_server_id` - GET /v1/platform/fleet/mcp-servers/{mcp_server_id} - Get MCP server
- `langsmith_delete_v1_platform_fleet_mcp_servers_mcp_server_id` - DELETE /v1/platform/fleet/mcp-servers/{mcp_server_id} - Delete MCP server
- `langsmith_patch_v1_platform_fleet_mcp_servers_mcp_server_id` - PATCH /v1/platform/fleet/mcp-servers/{mcp_server_id} - Update MCP server
- `langsmith_post_v1_platform_fleet_mcp_servers_mcp_server_id_oauth_provider` - POST /v1/platform/fleet/mcp-servers/{mcp_server_id}/oauth-provider - Register per-user MCP OAuth provider

## Fleet Threads

- `langsmith_post_v1_fleet_threads` - POST /v1/fleet/threads - Create thread
- `langsmith_get_v1_fleet_threads_threadid` - GET /v1/fleet/threads/{threadID} - Get thread
- `langsmith_post_v1_fleet_threads_threadid_resolve_interrupt` - POST /v1/fleet/threads/{threadID}/resolve-interrupt - Resolve an interrupted thread
- `langsmith_post_v1_fleet_threads_threadid_runs` - POST /v1/fleet/threads/{threadID}/runs - Create thread run

## Fleet Usage

- `langsmith_get_v1_platform_fleet_usage_agents` - GET /v1/platform/fleet/usage/agents - List fleet agents with usage
- `langsmith_get_v1_platform_fleet_usage_models` - GET /v1/platform/fleet/usage/models - List fleet models with usage
- `langsmith_get_v1_platform_fleet_usage_tools` - GET /v1/platform/fleet/usage/tools - List fleet tools with usage
- `langsmith_get_v1_platform_fleet_usage_users` - GET /v1/platform/fleet/usage/users - List fleet users with usage

## Fleet Webhooks

- `langsmith_post_v1_platform_fleet_webhooks_webhook_id_run` - POST /v1/platform/fleet-webhooks/{webhook_id}/run - Run a fleet webhook

## Hub Environments

- `langsmith_get_api_v1_hub_environments` - GET /api/v1/hub/environments - List hub environments
- `langsmith_post` - POST /api/v1/hub/environments - Create hub environments model
- `langsmith_delete_api_v1_hub_environments_id` - DELETE /api/v1/hub/environments/{id} - Delete hub environments model
- `langsmith_patch` - PATCH /api/v1/hub/environments/{id} - Update hub environments model

## Info

- `langsmith_get_server_info` - GET /api/v1/info - Get Server Info
- `langsmith_get_health_info` - GET /api/v1/info/health - Get Health Info

## Integrations

- `langsmith_get_v1_agent_builder_integrations` - GET /v1/agent-builder/integrations - Get Agent Builder integrations settings
- `langsmith_put_v1_agent_builder_integrations` - PUT /v1/agent-builder/integrations - Update Agent Builder integrations settings

## Likes

- `langsmith_like_repo` - POST /api/v1/likes/{owner}/{repo} - Like Repo

## Mcp

- `langsmith_get_tools` - GET /api/v1/mcp/tools - Get Tools
- `langsmith_invalidate_tools_cache` - DELETE /api/v1/mcp/tools - Invalidate Tools Cache
- `langsmith_proxy_get` - GET /api/v1/mcp/proxy - Proxy Get
- `langsmith_proxy` - POST /api/v1/mcp/proxy - Proxy

## Mcp Vendors

- `langsmith_get_v1_platform_mcp_vendors` - GET /v1/platform/mcp-vendors - List MCP vendors
- `langsmith_get_v1_platform_mcp_vendors_vendor_slug` - GET /v1/platform/mcp-vendors/{vendor_slug} - Get MCP vendor
- `langsmith_get_v1_platform_mcp_vendors_vendor_slug_account` - GET /v1/platform/mcp-vendors/{vendor_slug}/account - Get vendor account
- `langsmith_get_v1_platform_mcp_vendors_vendor_slug_mcp_servers` - GET /v1/platform/mcp-vendors/{vendor_slug}/mcp-servers - List MCP servers for a vendor
- `langsmith_get_v1_platform_mcp_vendors_vendor_slug_settings` - GET /v1/platform/mcp-vendors/{vendor_slug}/settings - Get vendor settings
- `langsmith_put_v1_platform_mcp_vendors_vendor_slug_settings` - PUT /v1/platform/mcp-vendors/{vendor_slug}/settings - Replace vendor settings
- `langsmith_post_v1_platform_mcp_vendors_vendor_slug_settings` - POST /v1/platform/mcp-vendors/{vendor_slug}/settings - Create vendor settings
- `langsmith_delete_v1_platform_mcp_vendors_vendor_slug_settings` - DELETE /v1/platform/mcp-vendors/{vendor_slug}/settings - Delete vendor settings
- `langsmith_get_v1_platform_mcp_vendors_vendor_slug_tools` - GET /v1/platform/mcp-vendors/{vendor_slug}/tools - List tools for a vendor

## Me

- `langsmith_get_onboarding_state` - GET /api/v1/me/onboarding_state - Get Onboarding State
- `langsmith_create_onboarding_state` - POST /api/v1/me/onboarding_state - Create Onboarding State
- `langsmith_update_onboarding_state_field` - PUT /api/v1/me/onboarding_state/{field} - Update Onboarding State Field
- `langsmith_get_ls_user_id` - GET /api/v1/me/ls_user_id - Get Ls User Id
- `langsmith_get_me_providers_providertype` - GET /me/providers/{providerType} - Get the authenticated user's provider user ID

## Metrics

- `langsmith_get_queue_metrics` - GET /api/v1/metrics/queue/{queue_name} - Get Queue Metrics

## Model Price Map

- `langsmith_read_model_price_map` - GET /api/v1/model-price-map - Read Model Price Map
- `langsmith_create_new_model_price` - POST /api/v1/model-price-map - Create New Model Price
- `langsmith_update_model_price` - PUT /api/v1/model-price-map/{id} - Update Model Price
- `langsmith_delete_model_price` - DELETE /api/v1/model-price-map/{id} - Delete Model Price

## Nps

- `langsmith_post_v1_platform_nps_response` - POST /v1/platform/nps/response - Submit an NPS response

## Oauth

- `langsmith_get_well_known_oauth_authorization_server` - GET /.well-known/oauth-authorization-server - Get OAuth2 authorization server metadata
- `langsmith_get_oauth_authorize` - GET /oauth/authorize - Initiate OAuth2 authorization
- `langsmith_post_oauth_authorize_approve` - POST /oauth/authorize/approve - Approve OAuth2 authorization request
- `langsmith_post_oauth_device_authorize` - POST /oauth/device/authorize - Authorize a device code
- `langsmith_post_oauth_device_code` - POST /oauth/device/code - Request OAuth2 device authorization
- `langsmith_post_oauth_revoke` - POST /oauth/revoke - Revoke an OAuth2 token
- `langsmith_post_oauth_token` - POST /oauth/token - Exchange grant for OAuth2 tokens

## Optimization Jobs

- `langsmith_list_jobs` - GET /api/v1/repos/{owner}/{repo}/optimization-jobs - List Jobs
- `langsmith_create_job` - POST /api/v1/repos/{owner}/{repo}/optimization-jobs - Create Job
- `langsmith_get_job` - GET /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id} - Get Job
- `langsmith_update_job` - PATCH /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id} - Update Job
- `langsmith_delete_job` - DELETE /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id} - Delete Job
- `langsmith_list_job_logs` - GET /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs - List Job Logs
- `langsmith_create_log` - POST /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs - Create Log
- `langsmith_get_log` - GET /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs/{log_id} - Get Log
- `langsmith_delete_log` - DELETE /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs/{log_id} - Delete Log

## Orgs

- `langsmith_get_api_v1_orgs_ttl_settings` - GET /api/v1/orgs/ttl-settings - List Ttl Settings
- `langsmith_put_api_v1_orgs_ttl_settings` - PUT /api/v1/orgs/ttl-settings - Upsert Ttl Settings
- `langsmith_list_organizations` - GET /api/v1/orgs - List Organizations
- `langsmith_create_organization` - POST /api/v1/orgs - Create Organization
- `langsmith_create_customers_and_get_stripe_setup_intent` - POST /api/v1/orgs/current/setup - Create Customers And Get Stripe Setup Intent
- `langsmith_get_organization_info` - GET /api/v1/orgs/current - Get Organization Info
- `langsmith_get_current_organization_info` - GET /api/v1/orgs/current/info - Get Current Organization Info
- `langsmith_update_current_organization_info` - PATCH /api/v1/orgs/current/info - Update Current Organization Info
- `langsmith_get_organization_billing_info` - GET /api/v1/orgs/current/billing - Get Organization Billing Info
- `langsmith_get_dashboard` - GET /api/v1/orgs/current/dashboard - Get Dashboard
- `langsmith_on_payment_method_created` - POST /api/v1/orgs/current/payment-method - On Payment Method Created
- `langsmith_get_company_info` - GET /api/v1/orgs/current/business-info - Get Company Info
- `langsmith_set_company_info` - POST /api/v1/orgs/current/business-info - Set Company Info
- `langsmith_change_payment_plan` - POST /api/v1/orgs/current/plan - Change Payment Plan
- `langsmith_list_organization_roles` - GET /api/v1/orgs/current/roles - List Organization Roles
- `langsmith_create_organization_roles` - POST /api/v1/orgs/current/roles - Create Organization Roles
- `langsmith_delete_organization_roles` - DELETE /api/v1/orgs/current/roles/{role_id} - Delete Organization Roles
- `langsmith_update_organization_roles` - PATCH /api/v1/orgs/current/roles/{role_id} - Update Organization Roles
- `langsmith_list_permissions` - GET /api/v1/orgs/permissions - List Permissions
- `langsmith_list_pending_organization_invites` - GET /api/v1/orgs/pending - List Pending Organization Invites
- `langsmith_get_current_org_members` - GET /api/v1/orgs/current/members - Get Current Org Members
- `langsmith_add_member_to_current_org` - POST /api/v1/orgs/current/members - Add Member To Current Org
- `langsmith_get_current_active_org_members` - GET /api/v1/orgs/current/members/active - Get Current Active Org Members
- `langsmith_get_current_pending_org_members` - GET /api/v1/orgs/current/members/pending - Get Current Pending Org Members
- `langsmith_add_members_to_current_org_batch` - POST /api/v1/orgs/current/members/batch - Add Members To Current Org Batch
- `langsmith_add_basic_auth_members_to_current_org` - POST /api/v1/orgs/current/members/basic/batch - Add Basic Auth Members To Current Org
- `langsmith_delete_current_org_pending_member` - DELETE /api/v1/orgs/current/members/{identity_id}/pending - Delete Current Org Pending Member
- `langsmith_delete_pending_organization_invite` - DELETE /api/v1/orgs/pending/{organization_id} - Delete Pending Organization Invite
- `langsmith_claim_pending_organization_invite` - POST /api/v1/orgs/pending/{organization_id}/claim - Claim Pending Organization Invite
- `langsmith_remove_member_from_current_org` - DELETE /api/v1/orgs/current/members/{identity_id} - Remove Member From Current Org
- `langsmith_update_current_org_member` - PATCH /api/v1/orgs/current/members/{identity_id} - Update Current Org Member
- `langsmith_update_current_user` - PATCH /api/v1/orgs/members/basic - Update Current User
- `langsmith_get_current_sso_settings` - GET /api/v1/orgs/current/sso-settings - Get Current Sso Settings
- `langsmith_create_sso_settings` - POST /api/v1/orgs/current/sso-settings - Create Sso Settings
- `langsmith_update_sso_settings` - PATCH /api/v1/orgs/current/sso-settings/{id} - Update Sso Settings
- `langsmith_delete_sso_settings` - DELETE /api/v1/orgs/current/sso-settings/{id} - Delete Sso Settings
- `langsmith_update_allowed_login_methods` - PATCH /api/v1/orgs/current/login-methods - Update Allowed Login Methods
- `langsmith_get_org_usage` - GET /api/v1/orgs/current/billing/usage - Get Org Usage
- `langsmith_get_granular_usage` - GET /api/v1/orgs/current/billing/granular-usage - Get Granular Usage
- `langsmith_export_granular_usage_csv` - GET /api/v1/orgs/current/billing/granular-usage/export - Export Granular Usage Csv
- `langsmith_get_current_user_login_methods` - GET /api/v1/orgs/current/user/login-methods - Get Current User Login Methods
- `langsmith_create_stripe_checkout_sessions_endpoint` - POST /api/v1/orgs/current/stripe_checkout_session - Create Stripe Checkout Sessions Endpoint
- `langsmith_create_stripe_account_links_endpoint` - POST /api/v1/orgs/current/stripe_account_links - Create Stripe Account Links Endpoint
- `langsmith_list_org_service_keys` - GET /api/v1/orgs/current/service-keys - List Org Service Keys
- `langsmith_create_org_service_key` - POST /api/v1/orgs/current/service-keys - Create Org Service Key
- `langsmith_delete_org_service_key` - DELETE /api/v1/orgs/current/service-keys/{api_key_id} - Delete Org Service Key
- `langsmith_list_org_personal_access_tokens` - GET /api/v1/orgs/current/personal-access-tokens - List Org Personal Access Tokens
- `langsmith_create_org_personal_access_token` - POST /api/v1/orgs/current/personal-access-tokens - Create Org Personal Access Token
- `langsmith_delete_org_personal_access_token` - DELETE /api/v1/orgs/current/personal-access-tokens/{pat_id} - Delete Org Personal Access Token
- `langsmith_set_default_sso_provision` - POST /api/v1/orgs/current/set-default-sso-provision - Set Default Sso Provision
- `langsmith_get_v1_platform_orgs_current_members` - GET /v1/platform/orgs/current/members - List org members with workspace roles

## Ownerships

- `langsmith_list_repo_owners` - GET /api/v1/repos/{owner}/{repo}/owners - List Repo Owners
- `langsmith_add_repo_owner` - POST /api/v1/repos/{owner}/{repo}/owners - Add Repo Owner
- `langsmith_remove_repo_owner` - DELETE /api/v1/repos/{owner}/{repo}/owners - Remove Repo Owner

## Playground Settings

- `langsmith_list_playground_settings` - GET /api/v1/playground-settings - List Playground Settings
- `langsmith_create_playground_settings` - POST /api/v1/playground-settings - Create Playground Settings
- `langsmith_get_playground_settings` - GET /api/v1/playground-settings/{playground_settings_id} - Get Playground Settings
- `langsmith_update_playground_settings` - PATCH /api/v1/playground-settings/{playground_settings_id} - Update Playground Settings
- `langsmith_delete_playground_settings` - DELETE /api/v1/playground-settings/{playground_settings_id} - Delete Playground Settings

## Prompt Webhooks

- `langsmith_list_prompt_webhooks` - GET /api/v1/prompt-webhooks - List Prompt Webhooks
- `langsmith_create_prompt_webhook` - POST /api/v1/prompt-webhooks - Create Prompt Webhook
- `langsmith_get_prompt_webhook` - GET /api/v1/prompt-webhooks/{webhook_id} - Get Prompt Webhook
- `langsmith_update_prompt_webhook` - PATCH /api/v1/prompt-webhooks/{webhook_id} - Update Prompt Webhook
- `langsmith_delete_prompt_webhook` - DELETE /api/v1/prompt-webhooks/{webhook_id} - Delete Prompt Webhook
- `langsmith_test_prompt_webhook` - POST /api/v1/prompt-webhooks/test - Test Prompt Webhook

## Prompts

- `langsmith_invoke_prompt` - POST /api/v1/prompts/invoke_prompt - Invoke Prompt
- `langsmith_prompt_canvas` - POST /api/v1/prompts/canvas - Prompt Canvas

## Public

- `langsmith_get_shared_run` - GET /api/v1/public/{share_token}/run - Get Shared Run
- `langsmith_get_shared_run_by_id` - GET /api/v1/public/{share_token}/run/{id} - Get Shared Run By Id
- `langsmith_query_shared_runs` - POST /api/v1/public/{share_token}/runs/query - Query Shared Runs
- `langsmith_read_shared_feedbacks` - GET /api/v1/public/{share_token}/feedbacks - Read Shared Feedbacks
- `langsmith_read_shared_dataset` - GET /api/v1/public/{share_token}/datasets - Read Shared Dataset
- `langsmith_count_shared_examples` - GET /api/v1/public/{share_token}/examples/count - Count Shared Examples
- `langsmith_read_shared_examples` - GET /api/v1/public/{share_token}/examples - Read Shared Examples
- `langsmith_read_shared_dataset_tracer_sessions` - GET /api/v1/public/{share_token}/datasets/sessions - Read Shared Dataset Tracer Sessions
- `langsmith_read_shared_dataset_tracer_sessions_bulk` - GET /api/v1/public/datasets/sessions-bulk - Read Shared Dataset Tracer Sessions Bulk
- `langsmith_read_shared_dataset_examples_with_runs` - POST /api/v1/public/{share_token}/examples/runs - Read Shared Dataset Examples With Runs
- `langsmith_read_shared_delta` - POST /api/v1/public/{share_token}/datasets/runs/delta - Read Shared Delta
- `langsmith_read_shared_delta_stream` - POST /api/v1/public/{share_token}/datasets/runs/delta/stream - Read Shared Delta Stream
- `langsmith_query_shared_dataset_runs` - POST /api/v1/public/{share_token}/datasets/runs/query - Query Shared Dataset Runs
- `langsmith_generate_query_for_shared_dataset_runs` - POST /api/v1/public/{share_token}/datasets/runs/generate-query - Generate Query For Shared Dataset Runs
- `langsmith_stats_shared_dataset_runs` - POST /api/v1/public/{share_token}/datasets/runs/stats - Stats Shared Dataset Runs
- `langsmith_read_shared_dataset_run` - GET /api/v1/public/{share_token}/datasets/runs/{run_id} - Read Shared Dataset Run
- `langsmith_read_shared_dataset_feedback` - GET /api/v1/public/{share_token}/datasets/feedback - Read Shared Dataset Feedback
- `langsmith_read_shared_comparative_experiments` - GET /api/v1/public/{share_token}/datasets/comparative - Read Shared Comparative Experiments
- `langsmith_get_message_json_schema` - GET /api/v1/public/schemas/{version}/message.json - Get Message Json Schema
- `langsmith_get_tool_def_json_schema` - GET /api/v1/public/schemas/{version}/tooldef.json - Get Tool Def Json Schema

## Repos

- `langsmith_list_repos` - GET /api/v1/repos - List Repos
- `langsmith_create_repo` - POST /api/v1/repos - Create Repo
- `langsmith_delete_repos` - DELETE /api/v1/repos - Delete Repos
- `langsmith_get_repo` - GET /api/v1/repos/{owner}/{repo} - Get Repo
- `langsmith_update_repo` - PATCH /api/v1/repos/{owner}/{repo} - Update Repo
- `langsmith_delete_repo` - DELETE /api/v1/repos/{owner}/{repo} - Delete Repo
- `langsmith_fork_repo` - POST /api/v1/repos/{owner}/{repo}/fork - Fork Repo
- `langsmith_list_repo_tags` - GET /api/v1/repos/tags - List Repo Tags
- `langsmith_optimize_prompt_job` - POST /api/v1/repos/optimize-job - Optimize Prompt Job

## Run

- `langsmith_list_rules` - GET /api/v1/runs/rules - List Rules
- `langsmith_create_rule` - POST /api/v1/runs/rules - Create Rule
- `langsmith_validate_rule` - POST /api/v1/runs/rules/validate - Validate Rule
- `langsmith_update_rule` - PATCH /api/v1/runs/rules/{rule_id} - Update Rule
- `langsmith_delete_rule` - DELETE /api/v1/runs/rules/{rule_id} - Delete Rule
- `langsmith_thread_preview` - GET /api/v1/runs/threads/{thread_id} - Thread Preview
- `langsmith_list_rule_logs` - GET /api/v1/runs/rules/{rule_id}/logs - List Rule Logs
- `langsmith_list_rule_logs_v2` - GET /api/v1/runs/rules/{rule_id}/logs/v2 - List Rule Logs V2
- `langsmith_get_last_applied_rule` - GET /api/v1/runs/rules/{rule_id}/last_applied - Get Last Applied Rule
- `langsmith_trigger_rule` - POST /api/v1/runs/rules/{rule_id}/trigger - Trigger Rule
- `langsmith_trigger_rules` - POST /api/v1/runs/rules/trigger - Trigger Rules
- `langsmith_read_run` - GET /api/v1/runs/{run_id} - Read Run
- `langsmith_update_run` - PATCH /api/v1/runs/{run_id} - Update Run
- `langsmith_read_run_share_state` - GET /api/v1/runs/{run_id}/share - Read Run Share State
- `langsmith_share_run` - PUT /api/v1/runs/{run_id}/share - Share Run
- `langsmith_unshare_run` - DELETE /api/v1/runs/{run_id}/share - Unshare Run
- `langsmith_validate_runs_query` - POST /api/v1/runs/query/validate - Validate Runs Query
- `langsmith_query_runs` - POST /api/v1/runs/query - Query Runs
- `langsmith_generate_query_for_runs` - POST /api/v1/runs/generate-query - Generate Query For Runs
- `langsmith_stats_runs` - POST /api/v1/runs/stats - Stats Runs
- `langsmith_group_runs` - POST /api/v1/runs/group - Group Runs
- `langsmith_stats_group_runs` - POST /api/v1/runs/group/stats - Stats Group Runs
- `langsmith_delete_runs_abac` - POST /api/v1/runs/delete/traces - Delete Runs Abac
- `langsmith_delete_runs` - POST /api/v1/runs/delete - Delete Runs

## Runs

- `langsmith_post_runs` - POST /runs - Create a Run
- `langsmith_post_runs_batch` - POST /runs/batch - Ingest Runs (Batch JSON)
- `langsmith_post_runs_multipart` - POST /runs/multipart - Ingest Runs (Multipart)
- `langsmith_patch_runs_run_id` - PATCH /runs/{run_id} - Update a Run
- `langsmith_post_v2_runs_query` - POST /v2/runs/query - Query runs
- `langsmith_get_v2_runs_run_id` - GET /v2/runs/{run_id} - Get a single run
- `langsmith_get_v2_traces_trace_id_runs` - GET /v2/traces/{trace_id}/runs - List runs in a trace

## Sandboxes

- `langsmith_get_v2_sandboxes_boxes` - GET /v2/sandboxes/boxes - List sandbox claims
- `langsmith_post_v2_sandboxes_boxes` - POST /v2/sandboxes/boxes - Create a sandbox claim
- `langsmith_post_v2_sandboxes_boxes_batch` - POST /v2/sandboxes/boxes/batch-delete - Batch delete sandbox claims
- `langsmith_get_v2_sandboxes_boxes_name` - GET /v2/sandboxes/boxes/{name} - Get a sandbox claim
- `langsmith_delete_v2_sandboxes_boxes_name` - DELETE /v2/sandboxes/boxes/{name} - Delete a sandbox claim
- `langsmith_patch_v2_sandboxes_boxes_name` - PATCH /v2/sandboxes/boxes/{name} - Update a sandbox claim
- `langsmith_post_v2_sandboxes_boxes_name_service_url` - POST /v2/sandboxes/boxes/{name}/service-url - Generate a service access token
- `langsmith_post_v2_sandboxes_boxes_name_snapshot` - POST /v2/sandboxes/boxes/{name}/snapshot - Capture a snapshot from a sandbox
- `langsmith_post_v2_sandboxes_boxes_name_start` - POST /v2/sandboxes/boxes/{name}/start - Start a sandbox
- `langsmith_get_v2_sandboxes_boxes_name_status` - GET /v2/sandboxes/boxes/{name}/status - Get sandbox claim status
- `langsmith_post_v2_sandboxes_boxes_name_stop` - POST /v2/sandboxes/boxes/{name}/stop - Stop a sandbox
- `langsmith_get_v2_sandboxes_snapshots` - GET /v2/sandboxes/snapshots - List snapshots
- `langsmith_post_v2_sandboxes_snapshots` - POST /v2/sandboxes/snapshots - Create a snapshot
- `langsmith_get_v2_sandboxes_snapshots_snapshot_id` - GET /v2/sandboxes/snapshots/{snapshot_id} - Get a snapshot
- `langsmith_delete_v2_sandboxes_snapshots_snapshot_id` - DELETE /v2/sandboxes/snapshots/{snapshot_id} - Delete a snapshot
- `langsmith_get_v2_sandboxes_usage` - GET /v2/sandboxes/usage - Get sandbox resource usage

## Sandboxes Internal

- `langsmith_post_v2_sandboxes_internal_start_name` - POST /v2/sandboxes/internal/start/{name} - Internal: start a stopped sandbox (service-to-service)

## Service Accounts

- `langsmith_get_service_accounts` - GET /api/v1/service-accounts - Get Service Accounts
- `langsmith_create_service_account` - POST /api/v1/service-accounts - Create Service Account
- `langsmith_delete_service_account` - DELETE /api/v1/service-accounts/{service_account_id} - Delete Service Account

## Sessions

- `langsmith_get_v1_platform_sessions_sessionid_agent_versions` - GET /v1/platform/sessions/{sessionID}/agent-versions - List agent versions for a project

## Settings

- `langsmith_get_settings` - GET /api/v1/settings - Get Settings
- `langsmith_set_tenant_handle` - POST /api/v1/settings/handle - Set Tenant Handle

## Skills

- `langsmith_get_v1_fleet_skills` - GET /v1/fleet/skills - List skills
- `langsmith_post_v1_fleet_skills` - POST /v1/fleet/skills - Create a skill
- `langsmith_get_v1_fleet_skills_skillid` - GET /v1/fleet/skills/{skillID} - Get a skill
- `langsmith_put_v1_fleet_skills_skillid` - PUT /v1/fleet/skills/{skillID} - Replace a skill
- `langsmith_delete_v1_fleet_skills_skillid` - DELETE /v1/fleet/skills/{skillID} - Delete a skill

## Tag Transitions

- `langsmith_get_repos_owner_repo_tags_tag_name_history` - GET /repos/{owner}/{repo}/tags/{tag_name}/history - Get tag transition history

## Tags

- `langsmith_get_tags` - GET /api/v1/repos/{owner}/{repo}/tags - Get Tags
- `langsmith_create_tag` - POST /api/v1/repos/{owner}/{repo}/tags - Create Tag
- `langsmith_get_tag` - GET /api/v1/repos/{owner}/{repo}/tags/{tag_name} - Get Tag
- `langsmith_update_tag` - PATCH /api/v1/repos/{owner}/{repo}/tags/{tag_name} - Update Tag
- `langsmith_delete_tag` - DELETE /api/v1/repos/{owner}/{repo}/tags/{tag_name} - Delete Tag

## Tenant

- `langsmith_list_tenants` - GET /api/v1/tenants - List Tenants
- `langsmith_create_tenant` - POST /api/v1/tenants - Create Tenant

## Threads

- `langsmith_post_v2_threads_query` - POST /v2/threads/query - Query Threads
- `langsmith_get_v2_threads_thread_id_traces` - GET /v2/threads/{thread_id}/traces - Query Thread Traces

## Tools

- `langsmith_get_v1_platform_tools` - GET /v1/platform/tools - List tools
- `langsmith_post_v1_platform_tools` - POST /v1/platform/tools - Create a tool
- `langsmith_get_v1_platform_tools_id_id` - GET /v1/platform/tools/id/{id} - Get a tool by ID
- `langsmith_delete_v1_platform_tools_id_id` - DELETE /v1/platform/tools/id/{id} - Delete a tool by ID
- `langsmith_patch_v1_platform_tools_id_id` - PATCH /v1/platform/tools/id/{id} - Update a tool by ID
- `langsmith_get_v1_platform_tools_handle` - GET /v1/platform/tools/{handle} - Get a tool by handle
- `langsmith_delete_v1_platform_tools_handle` - DELETE /v1/platform/tools/{handle} - Delete a tool by handle
- `langsmith_patch_v1_platform_tools_handle` - PATCH /v1/platform/tools/{handle} - Update a tool by handle

## Tracer Sessions

- `langsmith_get_tracing_project_prebuilt_dashboard` - POST /api/v1/sessions/{session_id}/dashboard - Get Tracing Project Prebuilt Dashboard
- `langsmith_read_tracer_session` - GET /api/v1/sessions/{session_id} - Read Tracer Session
- `langsmith_update_tracer_session` - PATCH /api/v1/sessions/{session_id} - Update Tracer Session
- `langsmith_delete_tracer_session` - DELETE /api/v1/sessions/{session_id} - Delete Tracer Session
- `langsmith_read_tracer_sessions` - GET /api/v1/sessions - Read Tracer Sessions
- `langsmith_create_tracer_session` - POST /api/v1/sessions - Create Tracer Session
- `langsmith_delete_tracer_sessions` - DELETE /api/v1/sessions - Delete Tracer Sessions
- `langsmith_read_tracer_sessions_runs_metadata` - GET /api/v1/sessions/{session_id}/metadata - Read Tracer Sessions Runs Metadata
- `langsmith_read_filter_views` - GET /api/v1/sessions/{session_id}/views - Read Filter Views
- `langsmith_create_filter_view` - POST /api/v1/sessions/{session_id}/views - Create Filter View
- `langsmith_read_filter_view` - GET /api/v1/sessions/{session_id}/views/{view_id} - Read Filter View
- `langsmith_update_filter_view` - PATCH /api/v1/sessions/{session_id}/views/{view_id} - Update Filter View
- `langsmith_delete_filter_view` - DELETE /api/v1/sessions/{session_id}/views/{view_id} - Delete Filter View
- `langsmith_rename_filter_view` - PATCH /api/v1/sessions/{session_id}/views/{view_id}/rename - Rename Filter View
- `langsmith_beta_get_insights_jobs` - GET /api/v1/sessions/{session_id}/insights - [Beta] Get Insights Jobs
- `langsmith_beta_create_insights_job` - POST /api/v1/sessions/{session_id}/insights - [Beta] Create Insights Job
- `langsmith_beta_get_insights_job_configs` - GET /api/v1/sessions/{session_id}/insights/configs - [Beta] Get Insights Job Configs
- `langsmith_beta_create_insights_job_config` - POST /api/v1/sessions/{session_id}/insights/configs - [Beta] Create Insights Job Config
- `langsmith_beta_auto_generate_insights_job_config` - POST /api/v1/sessions/{session_id}/insights/configs/generate - [Beta] Auto-Generate Insights Job Config
- `langsmith_beta_update_insights_job_config` - PATCH /api/v1/sessions/{session_id}/insights/configs/{config_id} - [Beta] Update Insights Job Config
- `langsmith_beta_delete_insights_job_config` - DELETE /api/v1/sessions/{session_id}/insights/configs/{config_id} - [Beta] Delete Insights Job Config
- `langsmith_beta_get_insights_job` - GET /api/v1/sessions/{session_id}/insights/{job_id} - [Beta] Get Insights Job
- `langsmith_beta_update_insights_job` - PATCH /api/v1/sessions/{session_id}/insights/{job_id} - [Beta] Update Insights Job
- `langsmith_beta_delete_insights_job` - DELETE /api/v1/sessions/{session_id}/insights/{job_id} - [Beta] Delete Insights Job
- `langsmith_beta_get_run_cluster_from_insights_job` - GET /api/v1/sessions/{session_id}/insights/{job_id}/clusters/{cluster_id} - [Beta] Get Run Cluster From Insights Job
- `langsmith_beta_get_runs_from_insights_job` - GET /api/v1/sessions/{session_id}/insights/{job_id}/runs - [Beta] Get Runs From Insights Job

## Ttl Settings

- `langsmith_list_ttl_settings` - GET /api/v1/ttl-settings - List Ttl Settings
- `langsmith_upsert_ttl_settings` - PUT /api/v1/ttl-settings - Upsert Ttl Settings

## Usage Limits

- `langsmith_list_usage_limits` - GET /api/v1/usage-limits - List Usage Limits
- `langsmith_upsert_usage_limit` - PUT /api/v1/usage-limits - Upsert Usage Limit
- `langsmith_list_org_usage_limits` - GET /api/v1/usage-limits/org - List Org Usage Limits
- `langsmith_delete_usage_limit` - DELETE /api/v1/usage-limits/{usage_limit_id} - Delete Usage Limit

## Workspaces

- `langsmith_create_workspace` - POST /api/v1/workspaces - Create Workspace
- `langsmith_list_workspaces` - GET /api/v1/workspaces - List Workspaces
- `langsmith_patch_workspace` - PATCH /api/v1/workspaces/{workspace_id} - Patch Workspace
- `langsmith_delete_workspace` - DELETE /api/v1/workspaces/{workspace_id} - Delete Workspace
- `langsmith_get_current_workspace_stats` - GET /api/v1/workspaces/current/stats - Get Current Workspace Stats
- `langsmith_get_current_workspace_usage_limits_info` - GET /api/v1/workspaces/current/usage_limits - Get Current Workspace Usage Limits Info
- `langsmith_get_shared_tokens` - GET /api/v1/workspaces/current/shared - Get Shared Tokens
- `langsmith_bulk_unshare_entities` - DELETE /api/v1/workspaces/current/shared - Bulk Unshare Entities
- `langsmith_list_current_workspace_secrets` - GET /api/v1/workspaces/current/secrets - List Current Workspace Secrets
- `langsmith_upsert_current_workspace_secrets` - POST /api/v1/workspaces/current/secrets - Upsert Current Workspace Secrets
- `langsmith_get_current_workspace_encrypted_secrets` - GET /api/v1/workspaces/current/secrets/encrypted - Get Current Workspace Encrypted Secrets
- `langsmith_list_tag_keys` - GET /api/v1/workspaces/current/tag-keys - List Tag Keys
- `langsmith_create_tag_key` - POST /api/v1/workspaces/current/tag-keys - Create Tag Key
- `langsmith_update_tag_key` - PATCH /api/v1/workspaces/current/tag-keys/{tag_key_id} - Update Tag Key
- `langsmith_get_tag_key` - GET /api/v1/workspaces/current/tag-keys/{tag_key_id} - Get Tag Key
- `langsmith_delete_tag_key` - DELETE /api/v1/workspaces/current/tag-keys/{tag_key_id} - Delete Tag Key
- `langsmith_create_tag_value` - POST /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values - Create Tag Value
- `langsmith_list_tag_values` - GET /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values - List Tag Values
- `langsmith_get_tag_value` - GET /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values/{tag_value_id} - Get Tag Value
- `langsmith_update_tag_value` - PATCH /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values/{tag_value_id} - Update Tag Value
- `langsmith_delete_tag_value` - DELETE /api/v1/workspaces/current/tag-keys/{tag_key_id}/tag-values/{tag_value_id} - Delete Tag Value
- `langsmith_create_tagging` - POST /api/v1/workspaces/current/taggings - Create Tagging
- `langsmith_list_taggings` - GET /api/v1/workspaces/current/taggings - List Taggings
- `langsmith_delete_tagging` - DELETE /api/v1/workspaces/current/taggings/{tagging_id} - Delete Tagging
- `langsmith_list_tags` - GET /api/v1/workspaces/current/tags - List Tags
- `langsmith_list_tags_for_resource` - GET /api/v1/workspaces/current/tags/resource - List Tags For Resource
- `langsmith_list_tags_for_resources` - POST /api/v1/workspaces/current/tags/resources - List Tags For Resources
- `langsmith_list_pending_workspace_invites` - GET /api/v1/workspaces/pending - List Pending Workspace Invites
- `langsmith_delete_pending_workspace_invite` - DELETE /api/v1/workspaces/pending/{id} - Delete Pending Workspace Invite
- `langsmith_claim_pending_workspace_invite` - POST /api/v1/workspaces/pending/{workspace_id}/claim - Claim Pending Workspace Invite
- `langsmith_get_current_workspace_members` - GET /api/v1/workspaces/current/members - Get Current Workspace Members
- `langsmith_add_member_to_current_workspace` - POST /api/v1/workspaces/current/members - Add Member To Current Workspace
- `langsmith_get_current_active_workspace_members` - GET /api/v1/workspaces/current/members/active - Get Current Active Workspace Members
- `langsmith_get_current_pending_workspace_members` - GET /api/v1/workspaces/current/members/pending - Get Current Pending Workspace Members
- `langsmith_add_members_to_current_workspace_batch` - POST /api/v1/workspaces/current/members/batch - Add Members To Current Workspace Batch
- `langsmith_delete_current_workspace_member` - DELETE /api/v1/workspaces/current/members/{identity_id} - Delete Current Workspace Member
- `langsmith_patch_current_workspace_member` - PATCH /api/v1/workspaces/current/members/{identity_id} - Patch Current Workspace Member
- `langsmith_delete_current_workspace_pending_member` - DELETE /api/v1/workspaces/current/members/{identity_id}/pending - Delete Current Workspace Pending Member
