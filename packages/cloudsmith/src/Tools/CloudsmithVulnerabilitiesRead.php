<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a scan result..
 *
 * Maps to the official Cloudsmith endpoint get /vulnerabilities/{owner}/{repo}/{package}/{identifier}/.
 */
class CloudsmithVulnerabilitiesRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_vulnerabilities_read';
    protected const DESCRIPTION = 'Get a scan result.

Official Cloudsmith endpoint: GET /vulnerabilities/{owner}/{repo}/{package}/{identifier}/

Get a scan result.';
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
  'identifier' => array (
  'type' => 'string',
  'description' => 'identifier parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/vulnerabilities/{owner}/{repo}/{package}/{identifier}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
  'package' => 'package',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
