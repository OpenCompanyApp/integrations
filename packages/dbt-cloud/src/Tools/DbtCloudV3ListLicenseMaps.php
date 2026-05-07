<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List License Maps.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/license-maps/.
 */
class DbtCloudV3ListLicenseMaps extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_license_maps';
    protected const DESCRIPTION = 'List License Maps

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/license-maps/';
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
    'description' => 'Comma-separated list of related objects to include in the response.',
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
    protected const PATH = '/api/v3/accounts/{account_id}/license-maps/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
  'limit' => 'limit',
  'offset' => 'offset',
  'order_by' => 'order_by',
  'pk' => 'pk',
  'state' => 'state',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
