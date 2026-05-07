<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Retrieves a test session. Note that the returned data may be incomplete if the test session is still in progress..
 *
 * Maps to the official Checkly endpoint GET /v1/test-sessions/{testSessionId}.
 */
class ChecklyGetV1TestsessionsTestsessionid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_testsessions_testsessionid';
    protected const DESCRIPTION = 'Retrieves a test session. Note that the returned data may be incomplete if the test session is still in progress.

Official Checkly endpoint: GET /v1/test-sessions/{testSessionId}.';
    protected const PARAMETERS = array (
      'test_session_id' => array (
        'type' => 'string',
        'description' => 'The unique identifier of the test session.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/test-sessions/{testSessionId}';
    protected const PATH_PARAMS = array (
      'testSessionId' => 'test_session_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
