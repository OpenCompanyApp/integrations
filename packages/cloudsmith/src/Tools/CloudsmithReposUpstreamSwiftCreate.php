<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a Swift upstream config for this repository..
 *
 * Maps to the official Cloudsmith endpoint post /repos/{owner}/{identifier}/upstream/swift/.
 */
class CloudsmithReposUpstreamSwiftCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_upstream_swift_create';
    protected const DESCRIPTION = 'Create a Swift upstream config for this repository.

Official Cloudsmith endpoint: POST /repos/{owner}/{identifier}/upstream/swift/

Create a Swift upstream config for this repository.';
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
    protected const METHOD = 'post';
    protected const PATH = '/repos/{owner}/{identifier}/upstream/swift/';
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
