<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a specific repository..
 *
 * Maps to the official Cloudsmith endpoint get /repos/{owner}/{identifier}/.
 */
class CloudsmithReposRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_read';
    protected const DESCRIPTION = 'Get a specific repository.

Official Cloudsmith endpoint: GET /repos/{owner}/{identifier}/

Get a specific repository.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/repos/{owner}/{identifier}/';
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
