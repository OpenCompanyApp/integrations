<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create a Magic Auth code.
 *
 * Maps to the official WorkOS endpoint post /user_management/magic_auth.
 */
class WorkOSUserlandMagicAuthSendMagicAuthCodeAndReturn extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_magic_auth_send_magic_auth_code_and_return';
    protected const DESCRIPTION = 'Create a Magic Auth code

Official WorkOS endpoint: POST /user_management/magic_auth

Creates a one-time authentication code that can be sent to the user\'s email address. The code expires in 10 minutes. To verify the code, [authenticate the user with Magic Auth](/reference/authkit/authentication/magic-auth).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/magic_auth';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
