<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Environment.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/environments/{id}/.
 */
class DbtCloudV2RetrieveEnvironment extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_retrieve_environment';
    protected const DESCRIPTION = 'Retrieve Environment

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/environments/{id}/

Deprecated. Consider using the v3 API instead.';
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
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response. Available: repository, connection.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/accounts/{account_id}/environments/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
