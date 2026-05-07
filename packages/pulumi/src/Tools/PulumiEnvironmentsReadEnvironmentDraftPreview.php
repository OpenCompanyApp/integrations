<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadEnvironmentDraft.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/esc/environments/{orgName}/{projectName}/{envName}/drafts/{changeRequestID}.
 */
class PulumiEnvironmentsReadEnvironmentDraftPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_read_environment_draft_preview';
    protected const DESCRIPTION = 'ReadEnvironmentDraft

Official Pulumi Cloud endpoint: GET /api/preview/esc/environments/{orgName}/{projectName}/{envName}/drafts/{changeRequestID}

Reads the YAML definition for a draft version of a Pulumi ESC environment. Drafts are proposed changes created as part of the approvals workflow. The draft is identified by the changeRequestID path parameter. An optional revision query parameter can target a specific base revision. The response is returned in application/x-yaml format. Requires the Approvals feature to be enabled.';
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
  'revision' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `revision` from the official Pulumi Cloud API operation. The environment revision number to target',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/esc/environments/{orgName}/{projectName}/{envName}/drafts/{changeRequestID}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
  'changeRequestID' => 'change_request_id',
);
    protected const QUERY_PARAMS = array (
  'revision' => 'revision',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
