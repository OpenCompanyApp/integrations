<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateEnvironmentDraft.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/esc/environments/{orgName}/{projectName}/{envName}/drafts/{changeRequestID}.
 */
class PulumiEnvironmentsUpdateEnvironmentDraft extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_update_environment_draft';
    protected const DESCRIPTION = 'UpdateEnvironmentDraft

Official Pulumi Cloud endpoint: PATCH /api/esc/environments/{orgName}/{projectName}/{envName}/drafts/{changeRequestID}

Updates the YAML definition of an existing draft change request for a Pulumi ESC environment. The draft is identified by the changeRequestID path parameter. The request body contains the updated YAML definition. Returns a ChangeRequestRef on success. Requires the Approvals feature to be enabled for the organization.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'env_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `envName` from the official Pulumi Cloud API operation. The environment name',
  ),
  'change_request_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `changeRequestID` from the official Pulumi Cloud API operation. The change request ID',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/drafts/{changeRequestID}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
  'changeRequestID' => 'change_request_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
