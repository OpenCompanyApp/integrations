<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all configured alert channels and their subscribed checks..
 *
 * Maps to the official Checkly endpoint GET /v1/alert-channels.
 */
class ChecklyGetV1Alertchannels extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_alertchannels';
    protected const DESCRIPTION = 'Lists all configured alert channels and their subscribed checks.

Official Checkly endpoint: GET /v1/alert-channels.';
    protected const PARAMETERS = array (
      'limit' => array (
        'type' => 'integer',
        'description' => 'Limit the number of results',
        'required' => false,
      ),
      'page' => array (
        'type' => 'number',
        'description' => 'Page number',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/alert-channels';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'page' => 'page',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
