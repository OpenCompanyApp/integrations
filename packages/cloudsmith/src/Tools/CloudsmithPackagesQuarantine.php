<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Quarantine or release a package..
 *
 * Maps to the official Cloudsmith endpoint post /packages/{owner}/{repo}/{identifier}/quarantine/.
 */
class CloudsmithPackagesQuarantine extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_quarantine';
    protected const DESCRIPTION = 'Quarantine or release a package.

Official Cloudsmith endpoint: POST /packages/{owner}/{repo}/{identifier}/quarantine/

Quarantine or release a package.';
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
    protected const PATH = '/packages/{owner}/{repo}/{identifier}/quarantine/';
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
