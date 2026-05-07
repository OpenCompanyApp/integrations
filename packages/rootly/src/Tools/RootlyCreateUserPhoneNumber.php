<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a user phone number.
 *
 * Maps to the official Rootly endpoint post /v1/users/{user_id}/phone_numbers.
 */
class RootlyCreateUserPhoneNumber extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_user_phone_number';
    protected const DESCRIPTION = 'Creates a user phone number

Official Rootly endpoint: POST /v1/users/{user_id}/phone_numbers

Creates a new user phone number from provided data';
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
    protected const PATH = '/v1/users/{user_id}/phone_numbers';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
