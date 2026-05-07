<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update status page template.
 *
 * Maps to the official Rootly endpoint put /v1/templates/{id}.
 */
class RootlyUpdateStatusPageTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_status_page_template';
    protected const DESCRIPTION = 'Update status page template

Official Rootly endpoint: PUT /v1/templates/{id}

Update a specific template event by id';
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
    protected const PATH = '/v1/templates/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
