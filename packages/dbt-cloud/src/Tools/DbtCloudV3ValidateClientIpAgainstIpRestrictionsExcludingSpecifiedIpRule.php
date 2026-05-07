<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Validate Client IP Against IP Restrictions Excluding Specified IP Rule.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/ip-restrictions-set/{id}/validate/{rule_id}.
 */
class DbtCloudV3ValidateClientIpAgainstIpRestrictionsExcludingSpecifiedIpRule extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_validate_client_ip_against_ip_restrictions_excluding_specified_ip_rule';
    protected const DESCRIPTION = 'Validate Client IP Against IP Restrictions Excluding Specified IP Rule

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/ip-restrictions-set/{id}/validate/{rule_id}

This endpoint returns whether the client ip is acceptable based on the
configured ip restriction rules associated to the rule set - excluding the ip rule id
passed into the url';
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
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
  'rule_id' =>
  array (
    'type' => 'integer',
    'description' => 'rule_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/ip-restrictions-set/{id}/validate/{rule_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
  'rule_id' => 'rule_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
