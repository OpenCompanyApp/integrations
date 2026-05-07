<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes an environment variable. Uses the "key" field as the ID for deletion..
 *
 * Maps to the official Checkly endpoint DELETE /v1/variables/{key}.
 */
class ChecklyDeleteV1VariablesKey extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_variables_key';
    protected const DESCRIPTION = 'Permanently removes an environment variable. Uses the "key" field as the ID for deletion.

Official Checkly endpoint: DELETE /v1/variables/{key}.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'key parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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
