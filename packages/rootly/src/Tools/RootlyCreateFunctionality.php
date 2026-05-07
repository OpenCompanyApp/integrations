<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a functionality.
 *
 * Maps to the official Rootly endpoint post /v1/functionalities.
 */
class RootlyCreateFunctionality extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_functionality';
    protected const DESCRIPTION = 'Creates a functionality

Official Rootly endpoint: POST /v1/functionalities

Creates a new functionality from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/functionalities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
