<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadOpenEnvironmentRequest.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}/open/request/{changeRequestID}.
 */
class PulumiEnvironmentsReadOpenEnvironmentRequest extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_read_open_environment_request';
    protected const DESCRIPTION = 'ReadOpenEnvironmentRequest

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}/open/request/{changeRequestID}

Reads the details of an open environment request that was created as part of the gated opens approval workflow. The request is identified by the changeRequestID path parameter. The response includes the request\'s status, the requesting user, and approval details. An optional revision query parameter can target a specific environment revision. Requires the Approvals feature to be enabled.';
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
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/open/request/{changeRequestID}';
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
