<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Show details of a specific alert channel..
 *
 * Maps to the official Checkly endpoint GET /v1/alert-channels/{id}.
 */
class ChecklyGetV1AlertchannelsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_alertchannels_id';
    protected const DESCRIPTION = 'Show details of a specific alert channel.

Official Checkly endpoint: GET /v1/alert-channels/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'integer',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
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
