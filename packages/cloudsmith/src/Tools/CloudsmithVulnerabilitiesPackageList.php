<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Lists scan results for a specific package..
 *
 * Maps to the official Cloudsmith endpoint get /vulnerabilities/{owner}/{repo}/{package}/.
 */
class CloudsmithVulnerabilitiesPackageList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_vulnerabilities_package_list';
    protected const DESCRIPTION = 'Lists scan results for a specific package.

Official Cloudsmith endpoint: GET /vulnerabilities/{owner}/{repo}/{package}/

Lists scan results for a specific package.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'repo' => array (
  'type' => 'string',
  'description' => 'repo parameter.',
  'required' => true,
),
  'package' => array (
  'type' => 'string',
  'description' => 'package parameter.',
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
    protected const PATH = '/vulnerabilities/{owner}/{repo}/{package}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
  'package' => 'package',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
