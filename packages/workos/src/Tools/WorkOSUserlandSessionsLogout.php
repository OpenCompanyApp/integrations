<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Logout.
 *
 * Maps to the official WorkOS endpoint get /user_management/sessions/logout.
 */
class WorkOSUserlandSessionsLogout extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_sessions_logout';
    protected const DESCRIPTION = 'Logout

Official WorkOS endpoint: GET /user_management/sessions/logout

Logout a user from the current [session](/reference/authkit/session).';
    protected const PARAMETERS = array (
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `session_id` from the official WorkOS API operation.',
  ),
  'return_to' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `return_to` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/sessions/logout';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'session_id' => 'session_id',
  'return_to' => 'return_to',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
