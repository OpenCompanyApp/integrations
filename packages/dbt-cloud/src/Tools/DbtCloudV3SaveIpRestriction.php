<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Save IP Restriction.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/ip-restrictions/.
 */
class DbtCloudV3SaveIpRestriction extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_save_ip_restriction';
    protected const DESCRIPTION = 'Save IP Restriction

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/ip-restrictions/

Save net-new ip restriction rule

Note: As long as at least one cidr was successfully saved a 2XX will be returned.
Check the `extra` key within the response for a list of cidrs that failed to save.';
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
    protected const PATH = '/api/v3/accounts/{account_id}/ip-restrictions/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
