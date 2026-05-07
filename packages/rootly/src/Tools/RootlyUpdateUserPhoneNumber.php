<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update user phone number.
 *
 * Maps to the official Rootly endpoint put /v1/phone_numbers/{id}.
 */
class RootlyUpdateUserPhoneNumber extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_user_phone_number';
    protected const DESCRIPTION = 'Update user phone number

Official Rootly endpoint: PUT /v1/phone_numbers/{id}

Updates a user phone number';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/phone_numbers/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
