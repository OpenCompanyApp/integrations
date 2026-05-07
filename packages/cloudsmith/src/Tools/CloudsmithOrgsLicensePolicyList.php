<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all package license policies..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/license-policy/.
 */
class CloudsmithOrgsLicensePolicyList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_license_policy_list';
    protected const DESCRIPTION = 'Get a list of all package license policies.

Official Cloudsmith endpoint: GET /orgs/{org}/license-policy/

Get a list of all package license policies.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'page' => array (
  'type' => 'string',
  'description' => 'A page number within the paginated result set.',
),
  'page_size' => array (
  'type' => 'string',
  'description' => 'Number of results to return per page.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/license-policy/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
