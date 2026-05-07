<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Environments.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/environments/.
 */
class DbtCloudV2ListEnvironments extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_list_environments';
    protected const DESCRIPTION = 'List Environments

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/environments/

Deprecated. Consider using the v3 API instead.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
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
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response. Available: repository, connection.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'limit parameter.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'offset parameter.',
  ),
  'order_by' =>
  array (
    'type' => 'string',
    'description' => 'Field to order results by. Prefix with \'-\' for descending order.',
  ),
  'pk' =>
  array (
    'type' => 'integer',
    'description' => 'pk parameter.',
  ),
  'project_id' =>
  array (
    'type' => 'integer',
    'description' => 'project_id parameter.',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/accounts/{account_id}/environments/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'dbt_version' => 'dbt_version',
  'dbt_version__in' => 'dbt_version_in',
  'include_related' => 'include_related',
  'limit' => 'limit',
  'offset' => 'offset',
  'order_by' => 'order_by',
  'pk' => 'pk',
  'project_id' => 'project_id',
  'project_id__in' => 'project_id_in',
  'state' => 'state',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
