<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Shows the details of all included NPM packages and their version for one specific runtime.
 *
 * Maps to the official Checkly endpoint GET /v1/runtimes/{id}.
 */
class ChecklyGetV1RuntimesId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_runtimes_id';
    protected const DESCRIPTION = 'Shows the details of all included NPM packages and their version for one specific runtime

Official Checkly endpoint: GET /v1/runtimes/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/runtimes/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
