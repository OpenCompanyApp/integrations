<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List catalogs.
 *
 * Maps to the official Rootly endpoint get /v1/catalogs.
 */
class RootlyListCatalogs extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_catalogs';
    protected const DESCRIPTION = 'List catalogs

Official Rootly endpoint: GET /v1/catalogs

List catalogs';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: fields,entities',
    'enum' =>
    array (
      0 => 'fields',
      1 => 'entities',
    ),
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
      4 => 'position',
      5 => '-position',
    ),
  ),
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
  'filter_slug' =>
  array (
    'type' => 'string',
    'description' => 'filter[slug] parameter.',
  ),
  'filter_name' =>
  array (
    'type' => 'string',
    'description' => 'filter[name] parameter.',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/catalogs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'sort' => 'sort',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[search]' => 'filter_search',
  'filter[slug]' => 'filter_slug',
  'filter[name]' => 'filter_name',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
