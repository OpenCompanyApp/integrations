<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * OpenEnvironmentDraft.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/esc/environments/{orgName}/{projectName}/{envName}/drafts/{changeRequestID}/open.
 */
class PulumiEnvironmentsOpenEnvironmentDraftPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_open_environment_draft_preview';
    protected const DESCRIPTION = 'OpenEnvironmentDraft

Official Pulumi Cloud endpoint: POST /api/preview/esc/environments/{orgName}/{projectName}/{envName}/drafts/{changeRequestID}/open

Opens a draft version of a Pulumi ESC environment, fully resolving all dynamic values, provider integrations, and secrets for the proposed changes. The duration parameter specifies how long the open session remains valid using Go duration format (e.g., \'2h\', \'30m\'). An optional revision parameter can target a specific base revision. Returns an OpenEnvironmentResponse containing the session ID for subsequent reads. Requires the Approvals feature.';
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
  'duration' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `duration` from the official Pulumi Cloud API operation. The session duration, using Go time units: ns, us, ms, s, m, h (e.g. \'2h\')',
  ),
  'revision' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `revision` from the official Pulumi Cloud API operation. The environment revision number to target',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/esc/environments/{orgName}/{projectName}/{envName}/drafts/{changeRequestID}/open';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
  'changeRequestID' => 'change_request_id',
);
    protected const QUERY_PARAMS = array (
  'duration' => 'duration',
  'revision' => 'revision',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
