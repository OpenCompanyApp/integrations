<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Authenticate.
 *
 * Maps to the official WorkOS endpoint post /user_management/authenticate.
 */
class WorkOSUserlandSessionsAuthenticate0 extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_sessions_authenticate_0';
    protected const DESCRIPTION = 'Authenticate

Official WorkOS endpoint: POST /user_management/authenticate

Authenticate a user with a specified [authentication method](/reference/authkit/authentication).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/authenticate';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
