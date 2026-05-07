<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] List Custom Fields.
 *
 * Maps to the official Rootly endpoint get /v1/custom_fields.
 */
class RootlyListCustomFields extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_custom_fields';
    protected const DESCRIPTION = '[DEPRECATED] List Custom Fields

Official Rootly endpoint: GET /v1/custom_fields

[DEPRECATED] Use form field endpoints instead. List Custom fields';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: options',
    'enum' =>
    array (
      0 => 'options',
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
  'filter_slug' =>
  array (
    'type' => 'string',
    'description' => 'filter[slug] parameter.',
  ),
  'filter_label' =>
  array (
    'type' => 'string',
    'description' => 'filter[label] parameter.',
  ),
  'filter_kind' =>
  array (
    'type' => 'string',
    'description' => 'filter[kind] parameter.',
  ),
  'filter_enabled' =>
  array (
    'type' => 'boolean',
    'description' => 'filter[enabled] parameter.',
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
    protected const PATH = '/v1/custom_fields';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'sort' => 'sort',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[slug]' => 'filter_slug',
  'filter[label]' => 'filter_label',
  'filter[kind]' => 'filter_kind',
  'filter[enabled]' => 'filter_enabled',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
