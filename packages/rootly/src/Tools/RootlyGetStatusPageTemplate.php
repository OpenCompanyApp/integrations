<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a status page template.
 *
 * Maps to the official Rootly endpoint get /v1/templates/{id}.
 */
class RootlyGetStatusPageTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_status_page_template';
    protected const DESCRIPTION = 'Retrieves a status page template

Official Rootly endpoint: GET /v1/templates/{id}

Retrieves a specific status_page_template by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/templates/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
