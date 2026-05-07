<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve the retention rules for the repository..
 *
 * Maps to the official Cloudsmith endpoint get /repos/{owner}/{repo}/retention/.
 */
class CloudsmithRepoRetentionRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repo_retention_read';
    protected const DESCRIPTION = 'Retrieve the retention rules for the repository.

Official Cloudsmith endpoint: GET /repos/{owner}/{repo}/retention/

Retrieve the retention rules for the repository.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/repos/{owner}/{repo}/retention/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
