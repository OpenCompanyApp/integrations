<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Create License Map.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/license-maps/.
 */
class DbtCloudV3CreateLicenseMap extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_create_license_map';
    protected const DESCRIPTION = 'Create License Map

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/license-maps/';
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
    protected const PATH = '/api/v3/accounts/{account_id}/license-maps/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
