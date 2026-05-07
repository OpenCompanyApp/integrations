<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Replace SCIM User.
 *
 * Maps to the official dbt Cloud v3 endpoint put /api/v3/accounts/{account_id}/scim/v2/Users/{user_id}.
 */
class DbtCloudV3ReplaceScimUser extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_replace_scim_user';
    protected const DESCRIPTION = 'Replace SCIM User

Official dbt Cloud v3 endpoint: PUT /api/v3/accounts/{account_id}/scim/v2/Users/{user_id}

Replace a user via SCIM using PUT';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'user_id parameter.',
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
    protected const PATH = '/api/v3/accounts/{account_id}/scim/v2/Users/{user_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
