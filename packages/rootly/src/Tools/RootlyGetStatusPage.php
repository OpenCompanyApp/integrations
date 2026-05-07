<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a status page.
 *
 * Maps to the official Rootly endpoint get /v1/status-pages/{id}.
 */
class RootlyGetStatusPage extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_status_page';
    protected const DESCRIPTION = 'Retrieves a status page

Official Rootly endpoint: GET /v1/status-pages/{id}

Retrieves a specific status page by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/status-pages/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
