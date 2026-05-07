<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List Retrospective Templates.
 *
 * Maps to the official Rootly endpoint get /v1/post_mortem_templates.
 */
class RootlyListPostmortemTemplates extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_postmortem_templates';
    protected const DESCRIPTION = 'List Retrospective Templates

Official Rootly endpoint: GET /v1/post_mortem_templates

List Retrospective Templates';
    protected const PARAMETERS = array (
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
    protected const PATH = '/v1/post_mortem_templates';
    protected const PATH_PARAMS = array (
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
