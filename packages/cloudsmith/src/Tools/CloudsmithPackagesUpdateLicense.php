<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update the license for a package..
 *
 * Maps to the official Cloudsmith endpoint patch /packages/{owner}/{repo}/{identifier}/update-license/.
 */
class CloudsmithPackagesUpdateLicense extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_update_license';
    protected const DESCRIPTION = 'Update the license for a package.

Official Cloudsmith endpoint: PATCH /packages/{owner}/{repo}/{identifier}/update-license/

Update the license for a package.';
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
    protected const METHOD = 'patch';
    protected const PATH = '/packages/{owner}/{repo}/{identifier}/update-license/';
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
