<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Repos delete.
 *
 * Maps to the official Cloudsmith endpoint delete /repos/{owner}/{identifier}/.
 */
class CloudsmithReposDelete extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_delete';
    protected const DESCRIPTION = 'Repos delete

Official Cloudsmith endpoint: DELETE /repos/{owner}/{identifier}/

Delete a repository in a given namespace.

Note: Repositories are soft-deleted and can be restored within a retention period. During this time, the repository\'s slug remains reserved and cannot be reused for new repositories.';
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
    protected const METHOD = 'delete';
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
