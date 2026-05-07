<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a severity.
 *
 * Maps to the official Rootly endpoint put /v1/severities/{id}.
 */
class RootlyUpdateSeverity extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_severity';
    protected const DESCRIPTION = 'Update a severity

Official Rootly endpoint: PUT /v1/severities/{id}

Update a specific severity by id';
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
    protected const PATH = '/v1/severities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
