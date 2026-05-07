<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Users.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/users/.
 */
class DbtCloudV2ListUsers extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_list_users';
    protected const DESCRIPTION = 'List Users

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/users/

List the Users associated with the specified Account.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/accounts/{account_id}/users/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
