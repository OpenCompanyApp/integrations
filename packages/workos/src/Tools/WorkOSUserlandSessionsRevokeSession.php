<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Revoke Session.
 *
 * Maps to the official WorkOS endpoint post /user_management/sessions/revoke.
 */
class WorkOSUserlandSessionsRevokeSession extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_sessions_revoke_session';
    protected const DESCRIPTION = 'Revoke Session

Official WorkOS endpoint: POST /user_management/sessions/revoke

Revoke a [user session](/reference/authkit/session).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/sessions/revoke';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
