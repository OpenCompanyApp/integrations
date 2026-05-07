<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update IP Restriction.
 *
 * Maps to the official dbt Cloud v3 endpoint put /api/v3/accounts/{account_id}/ip-restrictions/{id}.
 */
class DbtCloudV3UpdateIpRestriction extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_ip_restriction';
    protected const DESCRIPTION = 'Update IP Restriction

Official dbt Cloud v3 endpoint: PUT /api/v3/accounts/{account_id}/ip-restrictions/{id}

Update an existing ip restriction rule

Note: As long as at least one cidr was successfully saved a 2XX will be returned.
Check the `extra` key within the response for a list of cidrs that failed to save.';
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
    protected const PATH = '/api/v3/accounts/{account_id}/ip-restrictions/{id}';
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
