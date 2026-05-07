<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Await the completion of a check session.
 *
 * Maps to the official Checkly endpoint GET /v2/check-sessions/{checkSessionId}/completion.
 */
class ChecklyGetV2ChecksessionsChecksessionidCompletion extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v2_checksessions_checksessionid_completion';
    protected const DESCRIPTION = 'Await the completion of a check session

Official Checkly endpoint: GET /v2/check-sessions/{checkSessionId}/completion.';
    protected const PARAMETERS = array (
      'check_session_id' => array (
        'type' => 'string',
        'description' => 'checkSessionId path parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/check-sessions/{checkSessionId}/completion';
    protected const PATH_PARAMS = array (
      'checkSessionId' => 'check_session_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
