<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List catalog entity checklists.
 *
 * Maps to the official Rootly endpoint get /v1/catalog_entity_checklists.
 */
class RootlyListCatalogEntityChecklists extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_catalog_entity_checklists';
    protected const DESCRIPTION = 'List catalog entity checklists

Official Rootly endpoint: GET /v1/catalog_entity_checklists

List catalog entity checklists';
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
  'filter_status' =>
  array (
    'type' => 'string',
    'description' => 'filter[status] parameter.',
  ),
  'filter_catalog_checklist_template_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[catalog_checklist_template_id] parameter.',
  ),
  'filter_auditable_type' =>
  array (
    'type' => 'string',
    'description' => 'filter[auditable_type] parameter.',
  ),
  'filter_auditable_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[auditable_id] parameter.',
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
    protected const PATH = '/v1/catalog_entity_checklists';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[status]' => 'filter_status',
  'filter[catalog_checklist_template_id]' => 'filter_catalog_checklist_template_id',
  'filter[auditable_type]' => 'filter_auditable_type',
  'filter[auditable_id]' => 'filter_auditable_id',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
