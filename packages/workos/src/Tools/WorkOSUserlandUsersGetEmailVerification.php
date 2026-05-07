<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get an email verification code.
 *
 * Maps to the official WorkOS endpoint get /user_management/email_verification/{id}.
 */
class WorkOSUserlandUsersGetEmailVerification extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_users_get_email_verification';
    protected const DESCRIPTION = 'Get an email verification code

Official WorkOS endpoint: GET /user_management/email_verification/{id}

Get the details of an existing email verification code that can be used to send an email to a user for verification.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/email_verification/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
