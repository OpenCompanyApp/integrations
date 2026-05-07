<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Send email change code.
 *
 * Maps to the official WorkOS endpoint post /user_management/users/{id}/email_change/send.
 */
class WorkOSUserlandUsersSendEmailChange extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_users_send_email_change';
    protected const DESCRIPTION = 'Send email change code

Official WorkOS endpoint: POST /user_management/users/{id}/email_change/send

Sends an email that contains a one-time code used to change a user\'s email address.';
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
    protected const PATH = '/user_management/users/{id}/email_change/send';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
