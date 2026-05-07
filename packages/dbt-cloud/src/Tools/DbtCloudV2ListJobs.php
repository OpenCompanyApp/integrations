<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Jobs.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/jobs/.
 */
class DbtCloudV2ListJobs extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_list_jobs';
    protected const DESCRIPTION = 'List Jobs

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/jobs/

List jobs for the given account';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'dbt_version_in' =>
  array (
    'type' => 'array',
    'description' => 'dbt_version__in parameter.',
  ),
  'environment_id' =>
  array (
    'type' => 'integer',
    'description' => 'environment_id parameter.',
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'A list of related objects to include in the response. Valid values are `environment`, `custom_environment_variables`, `most_recent_run`, `most_recent_completed_run`, and `fusion_readiness`.',
  ),
  'is_fusion_ready' =>
  array (
    'type' => 'boolean',
    'description' => 'Filters jobs by fusion readiness. When true, returns conformant or override-ready jobs. When false, returns non-ready jobs.',
  ),
  'is_system' =>
  array (
    'type' => 'boolean',
    'description' => 'is_system parameter.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'limit parameter.',
  ),
  'name_icontains' =>
  array (
    'type' => 'string',
    'description' => 'name__icontains parameter.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'offset parameter.',
  ),
  'order_by' =>
  array (
    'type' => 'string',
    'description' => 'Field to order the results by. Use `-` to reverse the order.',
  ),
  'pk' =>
  array (
    'type' => 'integer',
    'description' => 'pk parameter.',
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
    'description' => 'Filters by soft deletion state.
            <ul>
                <li>
                    <strong>"active"</strong> / <strong>1</strong>: Only active resources
                </li>
                <li>
                    <strong>"deleted"</strong> / <strong>2</strong>: Only deleted resources
                </li>
                <li>
                    <strong>"all"</strong>: All resources
                </li>
            </ul>',
  ),
  'triggers_schedule' =>
  array (
    'type' => 'boolean',
    'description' => 'triggers_schedule parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/accounts/{account_id}/jobs/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'dbt_version__in' => 'dbt_version_in',
  'environment_id' => 'environment_id',
  'include_related' => 'include_related',
  'is_fusion_ready' => 'is_fusion_ready',
  'is_system' => 'is_system',
  'limit' => 'limit',
  'name__icontains' => 'name_icontains',
  'offset' => 'offset',
  'order_by' => 'order_by',
  'pk' => 'pk',
  'project_id' => 'project_id',
  'project_id__in' => 'project_id_in',
  'state' => 'state',
  'triggers_schedule' => 'triggers_schedule',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
