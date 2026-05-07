<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a status page template.
 *
 * Maps to the official Rootly endpoint post /v1/status-pages/{status_page_id}/templates.
 */
class RootlyCreateStatusPageTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_status_page_template';
    protected const DESCRIPTION = 'Creates a status page template

Official Rootly endpoint: POST /v1/status-pages/{status_page_id}/templates

Creates a new template from provided data';
    protected const PARAMETERS = array (
  'status_page_id' =>
  array (
    'type' => 'string',
    'description' => 'status_page_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/status-pages/{status_page_id}/templates';
    protected const PATH_PARAMS = array (
  'status_page_id' => 'status_page_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
