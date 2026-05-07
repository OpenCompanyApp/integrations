<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all private locations in your account..
 *
 * Maps to the official Checkly endpoint GET /v1/private-locations.
 */
class ChecklyGetV1Privatelocations extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_privatelocations';
    protected const DESCRIPTION = 'Lists all private locations in your account.

Official Checkly endpoint: GET /v1/private-locations.';
    protected const PARAMETERS = array (
      'versions' => array (
        'type' => 'boolean',
        'description' => 'versions parameter.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/private-locations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'versions' => 'versions',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
