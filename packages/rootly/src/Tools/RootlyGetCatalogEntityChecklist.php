<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a catalog entity checklist.
 *
 * Maps to the official Rootly endpoint get /v1/catalog_entity_checklists/{id}.
 */
class RootlyGetCatalogEntityChecklist extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_catalog_entity_checklist';
    protected const DESCRIPTION = 'Retrieves a catalog entity checklist

Official Rootly endpoint: GET /v1/catalog_entity_checklists/{id}

Retrieves a specific catalog entity checklist by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/catalog_entity_checklists/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
