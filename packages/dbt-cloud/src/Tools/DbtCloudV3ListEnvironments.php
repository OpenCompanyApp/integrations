<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Environments.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/projects/{project_id}/environments/.
 */
class DbtCloudV3ListEnvironments extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_environments';
    protected const DESCRIPTION = 'List Environments

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/projects/{project_id}/environments/

List Environments';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'credentials_id' =>
  array (
    'type' => 'integer',
    'description' => 'credentials_id parameter.',
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
  'deployment_type' =>
  array (
    'type' => 'string',
    'description' => 'deployment_type parameter.',
    'enum' =>
    array (
      0 => 'production',
      1 => 'staging',
    ),
  ),
  'deployment_type_in' =>
  array (
    'type' => 'array',
    'description' => 'deployment_type__in parameter.',
  ),
  'id_gt' =>
  array (
    'type' => 'integer',
    'description' => 'id__gt parameter.',
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response. Available: project, connection, credentials, repository.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'limit parameter.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name parameter.',
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
  'pk_in' =>
  array (
    'type' => 'array',
    'description' => 'pk__in parameter.',
  ),
  'project_id' =>
  array (
    'type' => 'integer',
    'description' => 'project_id parameter.',
    'required' => true,
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
  'type' =>
  array (
    'type' => 'string',
    'description' => 'type parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/environments/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
  'credentials_id' => 'credentials_id',
  'dbt_version' => 'dbt_version',
  'dbt_version__in' => 'dbt_version_in',
  'deployment_type' => 'deployment_type',
  'deployment_type__in' => 'deployment_type_in',
  'id__gt' => 'id_gt',
  'include_related' => 'include_related',
  'limit' => 'limit',
  'name' => 'name',
  'name__icontains' => 'name_icontains',
  'offset' => 'offset',
  'order_by' => 'order_by',
  'pk' => 'pk',
  'pk__in' => 'pk_in',
  'project_id__in' => 'project_id_in',
  'state' => 'state',
  'type' => 'type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
