<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Verify email.
 *
 * Maps to the official WorkOS endpoint post /user_management/users/{id}/email_verification/confirm.
 */
class WorkOSUserlandUsersEmailVerification0 extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_users_email_verification_0';
    protected const DESCRIPTION = 'Verify email

Official WorkOS endpoint: POST /user_management/users/{id}/email_verification/confirm

Verifies an email address using the one-time code received by the user.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/users/{id}/email_verification/confirm';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
