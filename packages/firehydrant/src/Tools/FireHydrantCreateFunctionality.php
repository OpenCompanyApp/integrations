<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a functionality.
 *
 * Maps to the official FireHydrant endpoint post /v1/functionalities.
 */
class FireHydrantCreateFunctionality extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_functionality';
    protected const DESCRIPTION = 'Create a functionality

Official FireHydrant endpoint: POST /v1/functionalities

Creates a functionality for the organization';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
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
