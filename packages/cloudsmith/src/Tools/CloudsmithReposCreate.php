<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a new repository in a given namespace..
 *
 * Maps to the official Cloudsmith endpoint post /repos/{owner}/.
 */
class CloudsmithReposCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_create';
    protected const DESCRIPTION = 'Create a new repository in a given namespace.

Official Cloudsmith endpoint: POST /repos/{owner}/

Create a new repository in a given namespace.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/repos/{owner}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
