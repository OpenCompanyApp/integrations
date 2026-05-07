<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * List all Transformations.
 *
 * Maps to the official Fivetran endpoint get /v1/transformations.
 */
class FivetranTransformationsList extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_transformations_list';
    protected const DESCRIPTION = 'List all Transformations

Official Fivetran endpoint: GET /v1/transformations

Returns a list of all transformations within your Fivetran account.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Fivetran API operation. Paging cursor, [read more about pagination](https://fivetran.com/docs/rest-api/pagination)',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Fivetran API operation. Number of records to fetch per page. Accepts a number in the range 1..1000; the default value is 100.',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `group_id` from the official Fivetran API operation. Specify the group identifier to filter transformations by group',
  ),
  'project_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `project_id` from the official Fivetran API operation. Specify dbt Core project identifier to filter transformations by project',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `type` from the official Fivetran API operation. Transformation type filter',
    'enum' =>
    array (
      0 => 'DBT_CORE',
      1 => 'QUICKSTART',
    ),
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/transformations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'group_id' => 'group_id',
  'project_id' => 'project_id',
  'type' => 'type',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
