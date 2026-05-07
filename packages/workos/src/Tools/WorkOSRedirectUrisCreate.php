<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create a redirect URI.
 *
 * Maps to the official WorkOS endpoint post /user_management/redirect_uris.
 */
class WorkOSRedirectUrisCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_redirect_uris_create';
    protected const DESCRIPTION = 'Create a redirect URI

Official WorkOS endpoint: POST /user_management/redirect_uris

Creates a new redirect URI for an environment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/redirect_uris';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
