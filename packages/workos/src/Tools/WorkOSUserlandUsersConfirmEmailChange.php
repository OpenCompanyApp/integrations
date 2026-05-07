<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Confirm email change.
 *
 * Maps to the official WorkOS endpoint post /user_management/users/{id}/email_change/confirm.
 */
class WorkOSUserlandUsersConfirmEmailChange extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_users_confirm_email_change';
    protected const DESCRIPTION = 'Confirm email change

Official WorkOS endpoint: POST /user_management/users/{id}/email_change/confirm

Confirms an email change using the one-time code received by the user.';
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
    protected const PATH = '/user_management/users/{id}/email_change/confirm';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
