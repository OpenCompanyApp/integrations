<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Get SCIM User.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/scim/v2/Users/{user_id}.
 */
class DbtCloudV3GetScimUser extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_get_scim_user';
    protected const DESCRIPTION = 'Get SCIM User

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/scim/v2/Users/{user_id}

Get a user via SCIM';
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
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/scim/v2/Users/{user_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
