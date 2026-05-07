<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List Form Sets.
 *
 * Maps to the official Rootly endpoint get /v1/form_sets.
 */
class RootlyListFormSets extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_form_sets';
    protected const DESCRIPTION = 'List Form Sets

Official Rootly endpoint: GET /v1/form_sets

List form_sets';
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
  'filter_slug' =>
  array (
    'type' => 'string',
    'description' => 'filter[slug] parameter.',
  ),
  'filter_is_default' =>
  array (
    'type' => 'boolean',
    'description' => 'filter[is_default] parameter.',
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
    protected const PATH = '/v1/form_sets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[slug]' => 'filter_slug',
  'filter[is_default]' => 'filter_is_default',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
