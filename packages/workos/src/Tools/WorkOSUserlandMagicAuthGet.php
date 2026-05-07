<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get Magic Auth code details.
 *
 * Maps to the official WorkOS endpoint get /user_management/magic_auth/{id}.
 */
class WorkOSUserlandMagicAuthGet extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_magic_auth_get';
    protected const DESCRIPTION = 'Get Magic Auth code details

Official WorkOS endpoint: GET /user_management/magic_auth/{id}

Get the details of an existing [Magic Auth](/reference/authkit/magic-auth) code that can be used to send an email to a user for authentication.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/magic_auth/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
