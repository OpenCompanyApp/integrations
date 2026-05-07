<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Delete a Swift upstream config for this repository..
 *
 * Maps to the official Cloudsmith endpoint delete /repos/{owner}/{identifier}/upstream/swift/{slug_perm}/.
 */
class CloudsmithReposUpstreamSwiftDelete extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_upstream_swift_delete';
    protected const DESCRIPTION = 'Delete a Swift upstream config for this repository.

Official Cloudsmith endpoint: DELETE /repos/{owner}/{identifier}/upstream/swift/{slug_perm}/

Delete a Swift upstream config for this repository.';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/repos/{owner}/{identifier}/upstream/swift/{slug_perm}/';
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
