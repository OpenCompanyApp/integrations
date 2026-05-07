<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List checklist templates.
 *
 * Maps to the official FireHydrant endpoint get /v1/checklist_templates.
 */
class FireHydrantListChecklistTemplates extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_checklist_templates';
    protected const DESCRIPTION = 'List checklist templates

Official FireHydrant endpoint: GET /v1/checklist_templates

List all of the checklist templates that have been added to the organization';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A query to search checklist templates by their name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/checklist_templates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'query' => 'query',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
