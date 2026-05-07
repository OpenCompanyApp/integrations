<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a catalog checklist template.
 *
 * Maps to the official Rootly endpoint delete /v1/catalog_checklist_templates/{id}.
 */
class RootlyDeleteCatalogChecklistTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_catalog_checklist_template';
    protected const DESCRIPTION = 'Delete a catalog checklist template

Official Rootly endpoint: DELETE /v1/catalog_checklist_templates/{id}

Delete a specific catalog checklist template by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
