<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get an access token for a connected account.
 *
 * Maps to the official WorkOS endpoint post /data-integrations/{slug}/token.
 */
class WorkOSDataIntegrationsGetUserlandUserToken extends AbstractWorkOSTool
{
    protected const NAME = 'workos_data_integrations_get_userland_user_token';
    protected const DESCRIPTION = 'Get an access token for a connected account

Official WorkOS endpoint: POST /data-integrations/{slug}/token

Fetches a valid OAuth access token for a user\'s connected account. WorkOS automatically handles token refresh, ensuring you always receive a valid, non-expired token.';
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
    protected const PATH = '/data-integrations/{slug}/token';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
