<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List SSH Tunnels.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/encryptions/.
 */
class DbtCloudV2ListSshTunnels extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_list_ssh_tunnels';
    protected const DESCRIPTION = 'List SSH Tunnels

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/encryptions/

List SSH tunnels';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'connection_id' =>
  array (
    'type' => 'integer',
    'description' => 'connection_id parameter.',
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
    protected const PATH = '/api/v2/accounts/{account_id}/encryptions/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'connection_id' => 'connection_id',
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
