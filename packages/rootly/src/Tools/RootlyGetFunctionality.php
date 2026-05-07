<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a functionality.
 *
 * Maps to the official Rootly endpoint get /v1/functionalities/{id}.
 */
class RootlyGetFunctionality extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_functionality';
    protected const DESCRIPTION = 'Retrieves a functionality

Official Rootly endpoint: GET /v1/functionalities/{id}

Retrieves a specific functionality by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/functionalities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
