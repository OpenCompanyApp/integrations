<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a functionality.
 *
 * Maps to the official FireHydrant endpoint patch /v1/functionalities/{functionality_id}.
 */
class FireHydrantUpdateFunctionality extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_functionality';
    protected const DESCRIPTION = 'Update a functionality

Official FireHydrant endpoint: PATCH /v1/functionalities/{functionality_id}

Update a functionalities attributes';
    protected const PARAMETERS = array (
  'functionality_id' =>
  array (
    'type' => 'string',
    'description' => 'functionality_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/functionalities/{functionality_id}';
    protected const PATH_PARAMS = array (
  'functionality_id' => 'functionality_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
