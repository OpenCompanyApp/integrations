<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List retrospective templates.
 *
 * Maps to the official FireHydrant endpoint get /v1/retrospective_templates.
 */
class FireHydrantListRetrospectiveTemplates extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_retrospective_templates';
    protected const DESCRIPTION = 'List retrospective templates

Official FireHydrant endpoint: GET /v1/retrospective_templates

List all retrospective templates';
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
  'for_incident' =>
  array (
    'type' => 'string',
    'description' => 'for_incident parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/retrospective_templates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'for_incident' => 'for_incident',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
