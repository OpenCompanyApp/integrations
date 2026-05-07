<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadOpenEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/environments/{orgName}/{envName}/open/{openSessionID}.
 */
class PulumiEnvironmentsReadOpenEnvironmentPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_read_open_environment_preview_environments';
    protected const DESCRIPTION = 'ReadOpenEnvironment

Official Pulumi Cloud endpoint: GET /api/preview/environments/{orgName}/{envName}/open/{openSessionID}

Reads the fully resolved values from an open environment session that was created via the OpenEnvironment endpoint. The openSessionID path parameter must match a valid, non-expired session. The optional property query parameter accepts a dot-separated path to retrieve a specific nested value instead of the entire resolved environment (e.g., \'aws.credentials.accessKeyId\'). The response contains all resolved configuration values with secrets decrypted and provider-sourced values fully evaluated.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'env_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `envName` from the official Pulumi Cloud API operation. The environment name',
  ),
  'open_session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `openSessionID` from the official Pulumi Cloud API operation. The session ID returned from the open environment operation',
  ),
  'property' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `property` from the official Pulumi Cloud API operation. A dot-separated path to a specific property to retrieve from the environment',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/environments/{orgName}/{envName}/open/{openSessionID}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
  'openSessionID' => 'open_session_id',
);
    protected const QUERY_PARAMS = array (
  'property' => 'property',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
