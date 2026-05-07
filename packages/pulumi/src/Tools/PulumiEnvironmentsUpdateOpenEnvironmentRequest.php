<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateOpenEnvironmentRequest.
 *
 * Maps to the official Pulumi Cloud endpoint put /api/esc/environments/{orgName}/{projectName}/{envName}/open/request/{changeRequestID}.
 */
class PulumiEnvironmentsUpdateOpenEnvironmentRequest extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_update_open_environment_request';
    protected const DESCRIPTION = 'UpdateOpenEnvironmentRequest

Official Pulumi Cloud endpoint: PUT /api/esc/environments/{orgName}/{projectName}/{envName}/open/request/{changeRequestID}

Updates an existing open environment request that was created as part of the gated opens approval workflow. The request is identified by the changeRequestID path parameter. The request body contains the updated open request details, such as approval status. Returns a ChangeRequestRef on success. Requires the Approvals feature to be enabled for the organization.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/open/request/{changeRequestID}';
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
