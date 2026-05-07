<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update alert.
 *
 * Maps to the official Rootly endpoint patch /v1/alerts/{id}.
 */
class RootlyUpdateAlert extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_alert';
    protected const DESCRIPTION = 'Update alert

Official Rootly endpoint: PATCH /v1/alerts/{id}

Updates an alert';
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
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/alerts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
