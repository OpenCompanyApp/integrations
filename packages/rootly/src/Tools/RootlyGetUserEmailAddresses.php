<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves user email addresses.
 *
 * Maps to the official Rootly endpoint get /v1/users/{user_id}/email_addresses.
 */
class RootlyGetUserEmailAddresses extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_user_email_addresses';
    protected const DESCRIPTION = 'Retrieves user email addresses

Official Rootly endpoint: GET /v1/users/{user_id}/email_addresses

Retrieves all email addresses for the specified user';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/users/{user_id}/email_addresses';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
