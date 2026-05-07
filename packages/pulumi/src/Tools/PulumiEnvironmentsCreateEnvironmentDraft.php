<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateEnvironmentDraft.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/drafts.
 */
class PulumiEnvironmentsCreateEnvironmentDraft extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_create_environment_draft';
    protected const DESCRIPTION = 'CreateEnvironmentDraft

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/drafts

Creates a new draft change request for a Pulumi ESC environment. Drafts allow proposing changes to an environment definition that can be reviewed and approved before being applied. This is part of the approvals workflow for environments. Returns a ChangeRequestRef containing the draft identifier. Requires the Approvals feature to be enabled for the organization.';
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
);
    protected const METHOD = 'post';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/drafts';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
