<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a functionality.
 *
 * Maps to the official FireHydrant endpoint get /v1/functionalities/{functionality_id}.
 */
class FireHydrantGetFunctionality extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_functionality';
    protected const DESCRIPTION = 'Get a functionality

Official FireHydrant endpoint: GET /v1/functionalities/{functionality_id}

Retrieves a single functionality by ID';
    protected const PARAMETERS = array (
  'functionality_id' =>
  array (
    'type' => 'string',
    'description' => 'Functionality UUID or slug',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/functionalities/{functionality_id}';
    protected const PATH_PARAMS = array (
  'functionality_id' => 'functionality_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
