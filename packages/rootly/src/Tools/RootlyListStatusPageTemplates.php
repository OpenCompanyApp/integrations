<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List status page templates.
 *
 * Maps to the official Rootly endpoint get /v1/status-pages/{status_page_id}/templates.
 */
class RootlyListStatusPageTemplates extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_status_page_templates';
    protected const DESCRIPTION = 'List status page templates

Official Rootly endpoint: GET /v1/status-pages/{status_page_id}/templates

List status page templates';
    protected const PARAMETERS = array (
  'status_page_id' =>
  array (
    'type' => 'string',
    'description' => 'status_page_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/status-pages/{status_page_id}/templates';
    protected const PATH_PARAMS = array (
  'status_page_id' => 'status_page_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
