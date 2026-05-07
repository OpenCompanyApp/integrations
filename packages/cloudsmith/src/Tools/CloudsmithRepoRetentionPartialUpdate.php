<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update the retention rules for the repository..
 *
 * Maps to the official Cloudsmith endpoint patch /repos/{owner}/{repo}/retention/.
 */
class CloudsmithRepoRetentionPartialUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repo_retention_partial_update';
    protected const DESCRIPTION = 'Update the retention rules for the repository.

Official Cloudsmith endpoint: PATCH /repos/{owner}/{repo}/retention/

Update the retention rules for the repository.';
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'patch';
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
