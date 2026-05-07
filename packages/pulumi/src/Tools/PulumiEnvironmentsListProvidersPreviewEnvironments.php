<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListProviders.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/environments/providers.
 */
class PulumiEnvironmentsListProvidersPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_providers_preview_environments';
    protected const DESCRIPTION = 'ListProviders

Official Pulumi Cloud endpoint: GET /api/preview/environments/providers

Returns a list of all available Pulumi ESC providers. Providers are integrations that dynamically retrieve configuration and secrets from external sources (e.g., AWS, Azure, Google Cloud, HashiCorp Vault, 1Password) via the fn::open function in environment definitions. Optionally filter by organization using the orgName query parameter to see only providers available to that organization.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `orgName` from the official Pulumi Cloud API operation. Filter providers available to this organization',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/environments/providers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
