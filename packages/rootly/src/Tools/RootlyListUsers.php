<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List users.
 *
 * Maps to the official Rootly endpoint get /v1/users.
 */
class RootlyListUsers extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_users';
    protected const DESCRIPTION = 'List users

Official Rootly endpoint: GET /v1/users

List users';
    protected const PARAMETERS = array (
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
  'filter_search' =>
  array (
    'type' => 'string',
    'description' => 'filter[search] parameter.',
  ),
  'filter_email' =>
  array (
    'type' => 'string',
    'description' => 'filter[email] parameter.',
  ),
  'filter_created_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][gt] parameter.',
  ),
  'filter_created_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][gte] parameter.',
  ),
  'filter_created_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][lt] parameter.',
  ),
  'filter_created_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][lte] parameter.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: created_at,updated_at',
    'enum' =>
    array (
      0 => 'created_at',
      1 => '-created_at',
      2 => 'updated_at',
      3 => '-updated_at',
    ),
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
    protected const PATH = '/v1/users';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[search]' => 'filter_search',
  'filter[email]' => 'filter_email',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
  'sort' => 'sort',
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
