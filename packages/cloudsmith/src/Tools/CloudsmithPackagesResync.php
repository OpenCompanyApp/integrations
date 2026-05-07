<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Schedule a package for resynchronisation..
 *
 * Maps to the official Cloudsmith endpoint post /packages/{owner}/{repo}/{identifier}/resync/.
 */
class CloudsmithPackagesResync extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_resync';
    protected const DESCRIPTION = 'Schedule a package for resynchronisation.

Official Cloudsmith endpoint: POST /packages/{owner}/{repo}/{identifier}/resync/

Schedule a package for resynchronisation.';
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
    protected const METHOD = 'post';
    protected const PATH = '/packages/{owner}/{repo}/{identifier}/resync/';
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
