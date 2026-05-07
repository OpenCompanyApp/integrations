<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List runbooks.
 *
 * Maps to the official FireHydrant endpoint get /v1/runbooks.
 */
class FireHydrantListRunbooks extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_runbooks';
    protected const DESCRIPTION = 'List runbooks

Official FireHydrant endpoint: GET /v1/runbooks

Lists all available runbooks.';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'description' => 'A query to search runbooks by their name',
  ),
  'owners' =>
  array (
    'type' => 'string',
    'description' => 'A query to search runbooks by their owners',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'Sort runbooks by their updated date. Accepts \'asc\', \'desc\'. This parameter is deprecated in favor of \'order_by\' and \'order_direction\'.',
    'enum' =>
    array (
      0 => 'asc',
      1 => 'desc',
    ),
  ),
  'order_by' =>
  array (
    'type' => 'string',
    'description' => 'Sort runbooks by their updated date or name. Accepts \'updated_at\', \'name\', \'owner\', \'last_executed_at\', and \'created_at\'.',
    'enum' =>
    array (
      0 => 'updated_at',
      1 => 'name',
      2 => 'created_at',
      3 => 'last_executed_at',
      4 => 'owner',
    ),
  ),
  'order_direction' =>
  array (
    'type' => 'string',
    'description' => 'Allows assigning a direction to how the specified `order_by` parameter is sorted. This parameter must be paired with `order_by` and does nothing on its own.',
    'enum' =>
    array (
      0 => 'asc',
      1 => 'desc',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/runbooks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'name' => 'name',
  'owners' => 'owners',
  'sort' => 'sort',
  'order_by' => 'order_by',
  'order_direction' => 'order_direction',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
