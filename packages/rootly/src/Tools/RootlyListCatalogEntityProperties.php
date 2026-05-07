<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List catalog properties.
 *
 * Maps to the official Rootly endpoint get /v1/catalog_entities/{catalog_entity_id}/properties.
 */
class RootlyListCatalogEntityProperties extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_catalog_entity_properties';
    protected const DESCRIPTION = 'List catalog properties

Official Rootly endpoint: GET /v1/catalog_entities/{catalog_entity_id}/properties

**Deprecated:** This endpoint is deprecated, please use `include=fields` on catalog entities or native catalog endpoints (teams, services, functionalities, incident_types, causes, environments) to retrieve field values instead.

List Catalog Entity Properties.';
    protected const PARAMETERS = array (
  'catalog_entity_id' =>
  array (
    'type' => 'string',
    'description' => 'catalog_entity_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: catalog_entity,catalog_field',
    'enum' =>
    array (
      0 => 'catalog_entity',
      1 => 'catalog_field',
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
  'filter_catalog_field_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[catalog_field_id] parameter.',
  ),
  'filter_key' =>
  array (
    'type' => 'string',
    'description' => 'filter[key] parameter.',
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
    protected const PATH = '/v1/catalog_entities/{catalog_entity_id}/properties';
    protected const PATH_PARAMS = array (
  'catalog_entity_id' => 'catalog_entity_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'sort' => 'sort',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[catalog_field_id]' => 'filter_catalog_field_id',
  'filter[key]' => 'filter_key',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
