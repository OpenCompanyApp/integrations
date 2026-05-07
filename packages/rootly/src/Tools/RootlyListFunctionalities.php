<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List functionalities.
 *
 * Maps to the official Rootly endpoint get /v1/functionalities.
 */
class RootlyListFunctionalities extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_functionalities';
    protected const DESCRIPTION = 'List functionalities

Official Rootly endpoint: GET /v1/functionalities

List functionalities';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
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
  'filter_name' =>
  array (
    'type' => 'string',
    'description' => 'filter[name] parameter.',
  ),
  'filter_backstage_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[backstage_id] parameter.',
  ),
  'filter_cortex_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[cortex_id] parameter.',
  ),
  'filter_opslevel_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[opslevel_id] parameter.',
  ),
  'filter_external_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[external_id] parameter.',
  ),
  'filter_slug' =>
  array (
    'type' => 'string',
    'description' => 'filter[slug] parameter.',
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
    'description' => 'sort parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/functionalities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[search]' => 'filter_search',
  'filter[name]' => 'filter_name',
  'filter[backstage_id]' => 'filter_backstage_id',
  'filter[cortex_id]' => 'filter_cortex_id',
  'filter[opslevel_id]' => 'filter_opslevel_id',
  'filter[external_id]' => 'filter_external_id',
  'filter[slug]' => 'filter_slug',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
