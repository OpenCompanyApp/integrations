<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get the synchronization status for a package..
 *
 * Maps to the official Cloudsmith endpoint get /packages/{owner}/{repo}/{identifier}/status/.
 */
class CloudsmithPackagesStatus extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_status';
    protected const DESCRIPTION = 'Get the synchronization status for a package.

Official Cloudsmith endpoint: GET /packages/{owner}/{repo}/{identifier}/status/

Get the synchronization status for a package.';
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
  'identifier' => array (
  'type' => 'string',
  'description' => 'identifier parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/packages/{owner}/{repo}/{identifier}/status/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
