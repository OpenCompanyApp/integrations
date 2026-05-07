<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Creates a new alert channel.
 *
 * Maps to the official Checkly endpoint POST /v1/alert-channels.
 */
class ChecklyPostV1Alertchannels extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_alertchannels';
    protected const DESCRIPTION = 'Creates a new alert channel

Official Checkly endpoint: POST /v1/alert-channels.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/alert-channels';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
