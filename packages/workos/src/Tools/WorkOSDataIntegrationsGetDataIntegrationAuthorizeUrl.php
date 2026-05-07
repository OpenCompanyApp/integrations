<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get authorization URL.
 *
 * Maps to the official WorkOS endpoint post /data-integrations/{slug}/authorize.
 */
class WorkOSDataIntegrationsGetDataIntegrationAuthorizeUrl extends AbstractWorkOSTool
{
    protected const NAME = 'workos_data_integrations_get_data_integration_authorize_url';
    protected const DESCRIPTION = 'Get authorization URL

Official WorkOS endpoint: POST /data-integrations/{slug}/authorize

Generates an OAuth authorization URL to initiate the connection flow for a user. Redirect the user to the returned URL to begin the OAuth flow with the third-party provider.';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `slug` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/data-integrations/{slug}/authorize';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
