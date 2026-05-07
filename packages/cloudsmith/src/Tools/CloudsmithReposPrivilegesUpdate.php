<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Replace all existing repository privileges with those specified..
 *
 * Maps to the official Cloudsmith endpoint put /repos/{owner}/{identifier}/privileges.
 */
class CloudsmithReposPrivilegesUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_privileges_update';
    protected const DESCRIPTION = 'Replace all existing repository privileges with those specified.

Official Cloudsmith endpoint: PUT /repos/{owner}/{identifier}/privileges

Replace all existing repository privileges with those specified.';
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
    protected const METHOD = 'put';
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
