<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Create Account Connection.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/connections/.
 */
class DbtCloudV3CreateAccountConnection extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_create_account_connection';
    protected const DESCRIPTION = 'Create Account Connection

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/connections/

Create a new Account Connection.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'The maximum number of items to return.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'The number of items to skip before starting to collect the result set.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v3/accounts/{account_id}/connections/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'limit' => 'limit',
  'offset' => 'offset',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
