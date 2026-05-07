<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Show details of a specific environment variable. Uses the "key" field for selection..
 *
 * Maps to the official Checkly endpoint GET /v1/variables/{key}.
 */
class ChecklyGetV1VariablesKey extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_variables_key';
    protected const DESCRIPTION = 'Show details of a specific environment variable. Uses the "key" field for selection.

Official Checkly endpoint: GET /v1/variables/{key}.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'key parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
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
