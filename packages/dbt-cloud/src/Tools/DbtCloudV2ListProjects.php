<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Projects.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/projects/.
 */
class DbtCloudV2ListProjects extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_list_projects';
    protected const DESCRIPTION = 'List Projects

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/projects/

Deprecated. Consider using the v3 API instead.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response. Available: repository, connection, group_permissions, docs_job, freshness_job.',
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
    'description' => 'Field to order results by. Prefix with \'-\' for descending order.',
  ),
  'pk' =>
  array (
    'type' => 'integer',
    'description' => 'pk parameter.',
  ),
  'pk_gt' =>
  array (
    'type' => 'integer',
    'description' => 'pk__gt parameter.',
  ),
  'pk_in' =>
  array (
    'type' => 'array',
    'description' => 'pk__in parameter.',
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
    protected const PATH = '/api/v2/accounts/{account_id}/projects/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
  'limit' => 'limit',
  'name__icontains' => 'name_icontains',
  'offset' => 'offset',
  'order_by' => 'order_by',
  'pk' => 'pk',
  'pk__gt' => 'pk_gt',
  'pk__in' => 'pk_in',
  'state' => 'state',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
