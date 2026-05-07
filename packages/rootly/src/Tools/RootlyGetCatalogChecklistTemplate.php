<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a catalog checklist template.
 *
 * Maps to the official Rootly endpoint get /v1/catalog_checklist_templates/{id}.
 */
class RootlyGetCatalogChecklistTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_catalog_checklist_template';
    protected const DESCRIPTION = 'Retrieves a catalog checklist template

Official Rootly endpoint: GET /v1/catalog_checklist_templates/{id}

Retrieves a specific catalog checklist template by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/catalog_checklist_templates/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
