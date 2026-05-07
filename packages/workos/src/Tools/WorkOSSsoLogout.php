<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Logout Redirect.
 *
 * Maps to the official WorkOS endpoint get /sso/logout.
 */
class WorkOSSsoLogout extends AbstractWorkOSTool
{
    protected const NAME = 'workos_sso_logout';
    protected const DESCRIPTION = 'Logout Redirect

Official WorkOS endpoint: GET /sso/logout

Logout allows to sign out a user from your application by triggering the identity provider sign out flow. This `GET` endpoint should be a redirection, since the identity provider user will be identified in the browser session. Before redirecting to this endpoint, you need to generate a short-lived logout token using the [Logout Authorize](/reference/sso/logout/authorize) endpoint.';
    protected const PARAMETERS = array (
  'token' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `token` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/sso/logout';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'token' => 'token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
