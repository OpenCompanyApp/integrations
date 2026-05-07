<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an user.
 *
 * Maps to the official Rootly endpoint get /v1/users/{id}.
 */
class RootlyGetUser extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_user';
    protected const DESCRIPTION = 'Retrieves an user

Official Rootly endpoint: GET /v1/users/{id}

Retrieves a specific user by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: email_addresses,phone_numbers',
    'enum' =>
    array (
      0 => 'email_addresses',
      1 => 'phone_numbers',
      2 => 'devices',
      3 => 'role',
      4 => 'on_call_role',
      5 => 'teams',
      6 => 'schedules',
      7 => 'notification_rules',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
