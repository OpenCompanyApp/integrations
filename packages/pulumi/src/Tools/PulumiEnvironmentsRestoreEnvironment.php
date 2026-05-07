<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RestoreEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint put /api/esc/environments/{orgName}/restore.
 */
class PulumiEnvironmentsRestoreEnvironment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_restore_environment';
    protected const DESCRIPTION = 'RestoreEnvironment

Official Pulumi Cloud endpoint: PUT /api/esc/environments/{orgName}/restore

Restores a previously deleted Pulumi ESC environment within an organization. The request body specifies the environment to restore by its project and name. The environment must have been deleted within the retention window and not yet permanently purged. Returns 204 on success with no response body. Returns 404 if the deleted environment cannot be found.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/esc/environments/{orgName}/restore';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
