<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update details about a repository in a given namespace..
 *
 * Maps to the official Cloudsmith endpoint patch /repos/{owner}/{identifier}/.
 */
class CloudsmithReposPartialUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_partial_update';
    protected const DESCRIPTION = 'Update details about a repository in a given namespace.

Official Cloudsmith endpoint: PATCH /repos/{owner}/{identifier}/

Update details about a repository in a given namespace.';
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'patch';
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
