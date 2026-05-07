<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Test a list of IP addresses against the repository's current GeoIP rules..
 *
 * Maps to the official Cloudsmith endpoint post /repos/{owner}/{identifier}/geoip/test/.
 */
class CloudsmithReposGeoipTest extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_geoip_test';
    protected const DESCRIPTION = 'Test a list of IP addresses against the repository\'s current GeoIP rules.

Official Cloudsmith endpoint: POST /repos/{owner}/{identifier}/geoip/test/

Test a list of IP addresses against the repository\'s current GeoIP rules.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'identifier' => array (
  'type' => 'string',
  'description' => 'identifier parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/repos/{owner}/{identifier}/geoip/test/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
