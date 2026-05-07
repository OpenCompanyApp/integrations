<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CheckYAML.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/yaml/check.
 */
class PulumiEnvironmentsCheckYAMLEsc extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_check_yaml_esc';
    protected const DESCRIPTION = 'CheckYAML

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/yaml/check

Checks a raw YAML environment definition for errors without creating or modifying any environment. The YAML definition is provided in the request body and validated for correctness, including imports, provider configurations, function invocations, and interpolation expressions. When the showSecrets query parameter is set to true, secret values are returned in plaintext in the response. This is useful for validating environment definitions before applying them.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'show_secrets' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `showSecrets` from the official Pulumi Cloud API operation. Whether to show secret values in plaintext',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/esc/environments/{orgName}/yaml/check';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'showSecrets' => 'show_secrets',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
