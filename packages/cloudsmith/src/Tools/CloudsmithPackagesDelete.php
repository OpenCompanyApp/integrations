<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Delete a specific package in a repository..
 *
 * Maps to the official Cloudsmith endpoint delete /packages/{owner}/{repo}/{identifier}/.
 */
class CloudsmithPackagesDelete extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_delete';
    protected const DESCRIPTION = 'Delete a specific package in a repository.

Official Cloudsmith endpoint: DELETE /packages/{owner}/{repo}/{identifier}/

Delete a specific package in a repository.';
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
  'identifier' => array (
  'type' => 'string',
  'description' => 'identifier parameter.',
  'required' => true,
),
);
    protected const METHOD = 'delete';
    protected const PATH = '/packages/{owner}/{repo}/{identifier}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
