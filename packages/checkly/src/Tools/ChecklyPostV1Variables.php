<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Creates a new environment variable..
 *
 * Maps to the official Checkly endpoint POST /v1/variables.
 */
class ChecklyPostV1Variables extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_variables';
    protected const DESCRIPTION = 'Creates a new environment variable.

Official Checkly endpoint: POST /v1/variables.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/variables';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
