<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List catalog checklist templates.
 *
 * Maps to the official Rootly endpoint get /v1/catalog_checklist_templates.
 */
class RootlyListCatalogChecklistTemplates extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_catalog_checklist_templates';
    protected const DESCRIPTION = 'List catalog checklist templates

Official Rootly endpoint: GET /v1/catalog_checklist_templates

List catalog checklist templates';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: template_fields,template_owners',
    'enum' =>
    array (
      0 => 'template_fields',
      1 => 'template_owners',
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
      4 => 'name',
      5 => '-name',
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
  'filter_name' =>
  array (
    'type' => 'string',
    'description' => 'filter[name] parameter.',
  ),
  'filter_slug' =>
  array (
    'type' => 'string',
    'description' => 'filter[slug] parameter.',
  ),
  'filter_catalog_type' =>
  array (
    'type' => 'string',
    'description' => 'filter[catalog_type] parameter.',
  ),
  'filter_scope_type' =>
  array (
    'type' => 'string',
    'description' => 'filter[scope_type] parameter.',
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
    protected const PATH = '/v1/catalog_checklist_templates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'sort' => 'sort',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[name]' => 'filter_name',
  'filter[slug]' => 'filter_slug',
  'filter[catalog_type]' => 'filter_catalog_type',
  'filter[scope_type]' => 'filter_scope_type',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
