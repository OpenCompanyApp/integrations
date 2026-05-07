<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Generates a phone number for Live Call Router.
 *
 * Maps to the official Rootly endpoint get /v1/live_call_routers/generate_phone_number.
 */
class RootlyGeneratePhoneNumberLiveCallRouter extends AbstractRootlyTool
{
    protected const NAME = 'rootly_generate_phone_number_live_call_router';
    protected const DESCRIPTION = 'Generates a phone number for Live Call Router

Official Rootly endpoint: GET /v1/live_call_routers/generate_phone_number

Generates a phone number for Live Call Router';
    protected const PARAMETERS = array (
  'country_code' =>
  array (
    'type' => 'string',
    'description' => 'country_code parameter.',
    'required' => true,
    'enum' =>
    array (
      0 => 'AU',
      1 => 'CA',
      2 => 'DE',
      3 => 'NL',
      4 => 'NZ',
      5 => 'SE',
      6 => 'GB',
      7 => 'US',
    ),
  ),
  'phone_type' =>
  array (
    'type' => 'string',
    'description' => 'phone_type parameter.',
    'required' => true,
    'enum' =>
    array (
      0 => 'local',
      1 => 'toll_free',
      2 => 'mobile',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/live_call_routers/generate_phone_number';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'country_code' => 'country_code',
  'phone_type' => 'phone_type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
