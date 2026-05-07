<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a catalog checklist template.
 *
 * Maps to the official Rootly endpoint post /v1/catalog_checklist_templates.
 */
class RootlyCreateCatalogChecklistTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_catalog_checklist_template';
    protected const DESCRIPTION = 'Creates a catalog checklist template

Official Rootly endpoint: POST /v1/catalog_checklist_templates

Creates a new catalog checklist template';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/catalog_checklist_templates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
