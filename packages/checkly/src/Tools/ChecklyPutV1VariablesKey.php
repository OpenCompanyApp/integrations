<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Updates an environment variable. Uses the "key" field as the ID for updating. Only updates value, locked, and secret properties. Once a value is set to secret, it cannot be unset..
 *
 * Maps to the official Checkly endpoint PUT /v1/variables/{key}.
 */
class ChecklyPutV1VariablesKey extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_variables_key';
    protected const DESCRIPTION = 'Updates an environment variable. Uses the "key" field as the ID for updating. Only updates value, locked, and secret properties. Once a value is set to secret, it cannot be unset.

Official Checkly endpoint: PUT /v1/variables/{key}.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'key parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/variables/{key}';
    protected const PATH_PARAMS = array (
      'key' => 'key',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
