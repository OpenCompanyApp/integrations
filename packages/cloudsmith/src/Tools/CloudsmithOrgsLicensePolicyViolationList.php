<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * List all current license policy violations for this Organization..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/license-policy-violation/.
 */
class CloudsmithOrgsLicensePolicyViolationList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_license_policy_violation_list';
    protected const DESCRIPTION = 'List all current license policy violations for this Organization.

Official Cloudsmith endpoint: GET /orgs/{org}/license-policy-violation/

List all current license policy violations for this Organization.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'cursor' => array (
  'type' => 'string',
  'description' => 'The pagination cursor value.',
),
  'page_size' => array (
  'type' => 'string',
  'description' => 'Number of results to return per page.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/license-policy-violation/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
