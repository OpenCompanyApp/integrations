<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get the list of dependencies for a package. Transitive dependencies are included where supported..
 *
 * Maps to the official Cloudsmith endpoint get /packages/{owner}/{repo}/{identifier}/dependencies/.
 */
class CloudsmithPackagesDependencies extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_dependencies';
    protected const DESCRIPTION = 'Get the list of dependencies for a package. Transitive dependencies are included where supported.

Official Cloudsmith endpoint: GET /packages/{owner}/{repo}/{identifier}/dependencies/

Get the list of dependencies for a package. Transitive dependencies are included where supported.';
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
    protected const PATH = '/packages/{owner}/{repo}/{identifier}/dependencies/';
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
