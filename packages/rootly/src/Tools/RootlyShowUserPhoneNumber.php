<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Show user phone number.
 *
 * Maps to the official Rootly endpoint get /v1/phone_numbers/{id}.
 */
class RootlyShowUserPhoneNumber extends AbstractRootlyTool
{
    protected const NAME = 'rootly_show_user_phone_number';
    protected const DESCRIPTION = 'Show user phone number

Official Rootly endpoint: GET /v1/phone_numbers/{id}

Retrieves a specific user phone number';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/phone_numbers/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
