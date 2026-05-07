<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Create Repository.
 *
 * Maps to the official dbt Cloud v2 endpoint post /api/v2/accounts/{account_id}/repositories/.
 */
class DbtCloudV2CreateRepository extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_create_repository';
    protected const DESCRIPTION = 'Create Repository

Official dbt Cloud v2 endpoint: POST /api/v2/accounts/{account_id}/repositories/

Deprecated. Consider using the v3 API instead.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v2/accounts/{account_id}/repositories/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
