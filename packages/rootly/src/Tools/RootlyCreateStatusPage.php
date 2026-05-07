<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a status page.
 *
 * Maps to the official Rootly endpoint post /v1/status-pages.
 */
class RootlyCreateStatusPage extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_status_page';
    protected const DESCRIPTION = 'Creates a status page

Official Rootly endpoint: POST /v1/status-pages

Creates a new status page from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/status-pages';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
