<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a status page.
 *
 * Maps to the official Rootly endpoint put /v1/status-pages/{id}.
 */
class RootlyUpdateStatusPage extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_status_page';
    protected const DESCRIPTION = 'Update a status page

Official Rootly endpoint: PUT /v1/status-pages/{id}

Update a specific status page by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/status-pages/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
