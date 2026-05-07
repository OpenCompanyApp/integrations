<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List status update templates.
 *
 * Maps to the official FireHydrant endpoint get /v1/status_update_templates.
 */
class FireHydrantListStatusUpdateTemplates extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_status_update_templates';
    protected const DESCRIPTION = 'List status update templates

Official FireHydrant endpoint: GET /v1/status_update_templates

List all status update templates for your organization';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/status_update_templates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
