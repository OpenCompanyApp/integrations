<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve a Helm upstream config for this repository..
 *
 * Maps to the official Cloudsmith endpoint get /repos/{owner}/{identifier}/upstream/helm/{slug_perm}/.
 */
class CloudsmithReposUpstreamHelmRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_upstream_helm_read';
    protected const DESCRIPTION = 'Retrieve a Helm upstream config for this repository.

Official Cloudsmith endpoint: GET /repos/{owner}/{identifier}/upstream/helm/{slug_perm}/

Retrieve a Helm upstream config for this repository.';
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
    protected const METHOD = 'get';
    protected const PATH = '/repos/{owner}/{identifier}/upstream/helm/{slug_perm}/';
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
