<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List OAuthConfigurations.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/oauth-configurations/.
 */
class DbtCloudV3ListOauthConfigurations extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_oauth_configurations';
    protected const DESCRIPTION = 'List OAuthConfigurations

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/oauth-configurations/

List OAuthConfigurations';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'client_id' =>
  array (
    'type' => 'string',
    'description' => 'client_id parameter.',
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
  'type' =>
  array (
    'type' => 'string',
    'description' => 'type parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/oauth-configurations/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'client_id' => 'client_id',
  'include_related' => 'include_related',
  'limit' => 'limit',
  'offset' => 'offset',
  'order_by' => 'order_by',
  'pk' => 'pk',
  'state' => 'state',
  'type' => 'type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
