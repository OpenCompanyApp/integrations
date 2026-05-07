<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a user email address.
 *
 * Maps to the official Rootly endpoint post /v1/users/{user_id}/email_addresses.
 */
class RootlyCreateUserEmailAddress extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_user_email_address';
    protected const DESCRIPTION = 'Creates a user email address

Official Rootly endpoint: POST /v1/users/{user_id}/email_addresses

Creates a new user email address from provided data';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/users/{user_id}/email_addresses';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
