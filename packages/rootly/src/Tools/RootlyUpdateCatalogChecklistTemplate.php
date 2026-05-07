<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a catalog checklist template.
 *
 * Maps to the official Rootly endpoint put /v1/catalog_checklist_templates/{id}.
 */
class RootlyUpdateCatalogChecklistTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_catalog_checklist_template';
    protected const DESCRIPTION = 'Update a catalog checklist template

Official Rootly endpoint: PUT /v1/catalog_checklist_templates/{id}

Update a specific catalog checklist template by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/catalog_checklist_templates/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
