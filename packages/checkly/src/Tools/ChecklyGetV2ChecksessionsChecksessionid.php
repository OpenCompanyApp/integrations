<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Retrieve a check session.
 *
 * Maps to the official Checkly endpoint GET /v2/check-sessions/{checkSessionId}.
 */
class ChecklyGetV2ChecksessionsChecksessionid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v2_checksessions_checksessionid';
    protected const DESCRIPTION = 'Retrieve a check session

Official Checkly endpoint: GET /v2/check-sessions/{checkSessionId}.';
    protected const PARAMETERS = array (
      'check_session_id' => array (
        'type' => 'string',
        'description' => 'checkSessionId path parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/check-sessions/{checkSessionId}';
    protected const PATH_PARAMS = array (
      'checkSessionId' => 'check_session_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
