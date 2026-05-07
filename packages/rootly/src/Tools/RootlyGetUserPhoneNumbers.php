<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves user phone numbers.
 *
 * Maps to the official Rootly endpoint get /v1/users/{user_id}/phone_numbers.
 */
class RootlyGetUserPhoneNumbers extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_user_phone_numbers';
    protected const DESCRIPTION = 'Retrieves user phone numbers

Official Rootly endpoint: GET /v1/users/{user_id}/phone_numbers

Retrieves all phone numbers for the specified user';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/users/{user_id}/phone_numbers';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
