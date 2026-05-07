<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Semantic Layer Credentials.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/semantic-layer-credentials/.
 */
class DbtCloudV3ListSemanticLayerCredentials extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_semantic_layer_credentials';
    protected const DESCRIPTION = 'List Semantic Layer Credentials

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/semantic-layer-credentials/';
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
    protected const PATH = '/api/v3/accounts/{account_id}/semantic-layer-credentials/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
  'order_by' => 'order_by',
  'pk' => 'pk',
  'project_id' => 'project_id',
  'state' => 'state',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
