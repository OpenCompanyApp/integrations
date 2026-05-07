<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Modify privileges for the repository..
 *
 * Maps to the official Cloudsmith endpoint patch /repos/{owner}/{identifier}/privileges.
 */
class CloudsmithReposPrivilegesPartialUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_privileges_partial_update';
    protected const DESCRIPTION = 'Modify privileges for the repository.

Official Cloudsmith endpoint: PATCH /repos/{owner}/{identifier}/privileges

Modify privileges for the repository.';
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
    protected const PATH = '/repos/{owner}/{identifier}/privileges';
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
