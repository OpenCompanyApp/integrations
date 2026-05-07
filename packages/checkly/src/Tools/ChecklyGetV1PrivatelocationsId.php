<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Show details of a specific private location..
 *
 * Maps to the official Checkly endpoint GET /v1/private-locations/{id}.
 */
class ChecklyGetV1PrivatelocationsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_privatelocations_id';
    protected const DESCRIPTION = 'Show details of a specific private location.

Official Checkly endpoint: GET /v1/private-locations/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/private-locations/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
