<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update a Composer upstream config for this repository..
 *
 * Maps to the official Cloudsmith endpoint put /repos/{owner}/{identifier}/upstream/composer/{slug_perm}/.
 */
class CloudsmithReposUpstreamComposerUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_upstream_composer_update';
    protected const DESCRIPTION = 'Update a Composer upstream config for this repository.

Official Cloudsmith endpoint: PUT /repos/{owner}/{identifier}/upstream/composer/{slug_perm}/

Update a Composer upstream config for this repository.';
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
  'slug_perm' => array (
  'type' => 'string',
  'description' => 'slug_perm parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'put';
    protected const PATH = '/repos/{owner}/{identifier}/upstream/composer/{slug_perm}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'identifier' => 'identifier',
  'slug_perm' => 'slug_perm',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
