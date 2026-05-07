<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetProviderSchema.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/providers/{providerName}/schema.
 */
class PulumiEnvironmentsGetProviderSchemaEsc extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_get_provider_schema_esc';
    protected const DESCRIPTION = 'GetProviderSchema

Official Pulumi Cloud endpoint: GET /api/esc/providers/{providerName}/schema

Returns the JSON schema for a Pulumi ESC provider. Providers are integrations that dynamically retrieve configuration and secrets from external sources such as AWS, Azure, Google Cloud, HashiCorp Vault, and others via fn::open. The schema describes the provider\'s input parameters, output structure, and configuration options. The provider is identified by name in the URL path.';
    protected const PARAMETERS = array (
  'provider_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `providerName` from the official Pulumi Cloud API operation. The provider name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/providers/{providerName}/schema';
    protected const PATH_PARAMS = array (
  'providerName' => 'provider_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
