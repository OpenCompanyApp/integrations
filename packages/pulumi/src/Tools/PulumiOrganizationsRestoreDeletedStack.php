<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RestoreDeletedStack.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/restore-stack/{programID}.
 */
class PulumiOrganizationsRestoreDeletedStack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_restore_deleted_stack';
    protected const DESCRIPTION = 'RestoreDeletedStack

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/restore-stack/{programID}

RestoreDeletedStack un-deletes a soft-deleted stack for the given programID if the organization has the restore stacks feature enabled.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'program_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `programID` from the official Pulumi Cloud API operation. The program identifier',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/restore-stack/{programID}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'programID' => 'program_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
