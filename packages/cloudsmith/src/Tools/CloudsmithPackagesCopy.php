<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Copy a package to another repository..
 *
 * Maps to the official Cloudsmith endpoint post /packages/{owner}/{repo}/{identifier}/copy/.
 */
class CloudsmithPackagesCopy extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_copy';
    protected const DESCRIPTION = 'Copy a package to another repository.

Official Cloudsmith endpoint: POST /packages/{owner}/{repo}/{identifier}/copy/

Copy a package to another repository.';
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/packages/{owner}/{repo}/{identifier}/copy/';
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
