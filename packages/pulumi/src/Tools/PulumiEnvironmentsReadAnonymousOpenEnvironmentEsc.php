<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadAnonymousOpenEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/yaml/open/{openSessionID}.
 */
class PulumiEnvironmentsReadAnonymousOpenEnvironmentEsc extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_read_anonymous_open_environment_esc';
    protected const DESCRIPTION = 'ReadAnonymousOpenEnvironment

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/yaml/open/{openSessionID}

Reads the fully resolved values from an anonymous open environment session that was created via the OpenYAML endpoint. The openSessionID path parameter must match a valid, non-expired session. The optional property query parameter accepts a dot-separated path to retrieve a specific nested value instead of the entire resolved environment (e.g., \'aws.credentials.accessKeyId\'). The response contains the resolved configuration values with secrets decrypted.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
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
    protected const PATH = '/api/esc/environments/{orgName}/yaml/open/{openSessionID}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'openSessionID' => 'open_session_id',
);
    protected const QUERY_PARAMS = array (
  'property' => 'property',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
