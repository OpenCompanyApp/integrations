<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List audits.
 *
 * Maps to the official Rootly endpoint get /v1/audits.
 */
class RootlyListAudits extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_audits';
    protected const DESCRIPTION = 'List audits

Official Rootly endpoint: GET /v1/audits

List audits';
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
  'filter_user_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[user_id] parameter.',
  ),
  'filter_api_key_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[api_key_id] parameter.',
  ),
  'filter_source' =>
  array (
    'type' => 'string',
    'description' => 'filter[source] parameter.',
  ),
  'filter_item_type' =>
  array (
    'type' => 'string',
    'description' => 'filter[item_type] parameter.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'sort parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/audits';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
  'filter[user_id]' => 'filter_user_id',
  'filter[api_key_id]' => 'filter_api_key_id',
  'filter[source]' => 'filter_source',
  'filter[item_type]' => 'filter_item_type',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
