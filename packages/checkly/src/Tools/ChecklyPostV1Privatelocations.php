<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Creates a new private location..
 *
 * Maps to the official Checkly endpoint POST /v1/private-locations.
 */
class ChecklyPostV1Privatelocations extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_privatelocations';
    protected const DESCRIPTION = 'Creates a new private location.

Official Checkly endpoint: POST /v1/private-locations.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/private-locations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
