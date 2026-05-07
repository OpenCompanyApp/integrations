<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Updates a private location..
 *
 * Maps to the official Checkly endpoint PUT /v1/private-locations/{id}.
 */
class ChecklyPutV1PrivatelocationsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_privatelocations_id';
    protected const DESCRIPTION = 'Updates a private location.

Official Checkly endpoint: PUT /v1/private-locations/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
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
