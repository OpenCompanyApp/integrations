<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update Service Token.
 *
 * Maps to the official dbt Cloud v3 endpoint put /api/v3/accounts/{account_id}/service-tokens/{id}/.
 */
class DbtCloudV3UpdateServiceToken extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_service_token';
    protected const DESCRIPTION = 'Update Service Token

Official dbt Cloud v3 endpoint: PUT /api/v3/accounts/{account_id}/service-tokens/{id}/';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'id' =>
  array (
    'type' => 'integer',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/v3/accounts/{account_id}/service-tokens/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
