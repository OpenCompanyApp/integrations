<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * OpenYAML.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/environments/{orgName}/yaml/open.
 */
class PulumiEnvironmentsOpenYAMLPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_open_yaml_preview';
    protected const DESCRIPTION = 'OpenYAML

Official Pulumi Cloud endpoint: POST /api/preview/environments/{orgName}/yaml/open

Opens an anonymous Pulumi ESC environment from a raw YAML definition provided in the request body, fully resolving all dynamic values, provider integrations, and secrets. Unlike OpenEnvironment, this does not require a pre-existing environment to be stored. The duration parameter specifies how long the session remains valid using Go duration format. Returns an OpenEnvironmentResponse containing the session ID. Use the session ID with ReadAnonymousOpenEnvironment to retrieve the resolved values.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'duration' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `duration` from the official Pulumi Cloud API operation. The session duration, using Go time units: ns, us, ms, s, m, h (e.g. \'2h\')',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/environments/{orgName}/yaml/open';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'duration' => 'duration',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
