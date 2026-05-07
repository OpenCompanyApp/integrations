<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Update an alert channel.
 *
 * Maps to the official Checkly endpoint PUT /v1/alert-channels/{id}.
 */
class ChecklyPutV1AlertchannelsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_alertchannels_id';
    protected const DESCRIPTION = 'Update an alert channel

Official Checkly endpoint: PUT /v1/alert-channels/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'integer',
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
    protected const PATH = '/v1/alert-channels/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
