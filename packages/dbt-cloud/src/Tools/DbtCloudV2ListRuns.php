<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Runs.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/runs/.
 */
class DbtCloudV2ListRuns extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_list_runs';
    protected const DESCRIPTION = 'List Runs

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/runs/

List runs for an account.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'created_at_range' =>
  array (
    'type' => 'array',
    'description' => 'created_at__range parameter.',
  ),
  'dbt_version' =>
  array (
    'type' => 'string',
    'description' => 'dbt_version parameter.',
  ),
  'dbt_version_in' =>
  array (
    'type' => 'array',
    'description' => 'dbt_version__in parameter.',
  ),
  'deferring_run_id' =>
  array (
    'type' => 'integer',
    'description' => 'deferring_run_id parameter.',
  ),
  'environment_id' =>
  array (
    'type' => 'integer',
    'description' => 'environment_id parameter.',
  ),
  'finished_at_range' =>
  array (
    'type' => 'array',
    'description' => 'finished_at__range parameter.',
  ),
  'has_docs_generated' =>
  array (
    'type' => 'boolean',
    'description' => 'has_docs_generated parameter.',
  ),
  'has_sources_generated' =>
  array (
    'type' => 'boolean',
    'description' => 'has_sources_generated parameter.',
  ),
  'id_gt' =>
  array (
    'type' => 'integer',
    'description' => 'id__gt parameter.',
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'A list of related objects to include in the response. Valid values are `trigger`, `job`, `audit`, and `debug_logs`. If `debug_logs` is not provided, then the included debug logs will be truncated to the last 1,000 lines of the debug log output file.',
  ),
  'job_definition_id' =>
  array (
    'type' => 'integer',
    'description' => 'Filters the results to a specific Job',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'Pagination limit',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'Pagination offset',
  ),
  'order_by' =>
  array (
    'type' => 'string',
    'description' => 'Field to order the results by. Use `-` to reverse the order. Options are `id`, `created_at`, and `finished_at`',
  ),
  'pk' =>
  array (
    'type' => 'integer',
    'description' => 'pk parameter.',
  ),
  'pk_in' =>
  array (
    'type' => 'array',
    'description' => 'pk__in parameter.',
  ),
  'project_id' =>
  array (
    'type' => 'integer',
    'description' => 'Filters the results to a specific Project',
  ),
  'project_id_in' =>
  array (
    'type' => 'array',
    'description' => 'project_id__in parameter.',
  ),
  'state' =>
  array (
    'type' => 'string',
    'description' => 'state parameter.',
  ),
  'status' =>
  array (
    'type' => 'integer',
    'description' => 'Filters the results to a specific run status',
  ),
  'status_in' =>
  array (
    'type' => 'array',
    'description' => 'Filters the results to a specific set of run statuses. `1: Queued`, `2: Starting`, `3: Running`, `10: Success`, `20: Error`, `30: Cancelled`',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/accounts/{account_id}/runs/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'created_at__range' => 'created_at_range',
  'dbt_version' => 'dbt_version',
  'dbt_version__in' => 'dbt_version_in',
  'deferring_run_id' => 'deferring_run_id',
  'environment_id' => 'environment_id',
  'finished_at__range' => 'finished_at_range',
  'has_docs_generated' => 'has_docs_generated',
  'has_sources_generated' => 'has_sources_generated',
  'id__gt' => 'id_gt',
  'include_related' => 'include_related',
  'job_definition_id' => 'job_definition_id',
  'limit' => 'limit',
  'offset' => 'offset',
  'order_by' => 'order_by',
  'pk' => 'pk',
  'pk__in' => 'pk_in',
  'project_id' => 'project_id',
  'project_id__in' => 'project_id_in',
  'state' => 'state',
  'status' => 'status',
  'status__in' => 'status_in',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
