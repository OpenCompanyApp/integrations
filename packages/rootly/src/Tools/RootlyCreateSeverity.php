<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a severity.
 *
 * Maps to the official Rootly endpoint post /v1/severities.
 */
class RootlyCreateSeverity extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_severity';
    protected const DESCRIPTION = 'Creates a severity

Official Rootly endpoint: POST /v1/severities

Creates a new severity from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/severities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
