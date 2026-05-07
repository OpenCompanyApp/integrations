<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a specific package in a repository..
 *
 * Maps to the official Cloudsmith endpoint get /packages/{owner}/{repo}/{identifier}/.
 */
class CloudsmithPackagesRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_read';
    protected const DESCRIPTION = 'Get a specific package in a repository.

Official Cloudsmith endpoint: GET /packages/{owner}/{repo}/{identifier}/

Get a specific package in a repository.';
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
    protected const PATH = '/packages/{owner}/{repo}/{identifier}/';
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
