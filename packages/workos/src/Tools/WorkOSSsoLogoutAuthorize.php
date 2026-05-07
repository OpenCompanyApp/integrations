<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Logout Authorize.
 *
 * Maps to the official WorkOS endpoint post /sso/logout/authorize.
 */
class WorkOSSsoLogoutAuthorize extends AbstractWorkOSTool
{
    protected const NAME = 'workos_sso_logout_authorize';
    protected const DESCRIPTION = 'Logout Authorize

Official WorkOS endpoint: POST /sso/logout/authorize

You should call this endpoint from your server to generate a logout token which is required for the [Logout Redirect](/reference/sso/logout) endpoint.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sso/logout/authorize';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
