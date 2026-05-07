<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Call this endpoint to await the completion of a test session. A successful response code will be returned once the test session reaches its final state (i.e. when it passes or fails). If the test session takes a long time to complete, the endpoint will return a timeout error code. You should keep calling the endpoint until you receive a successful response, or a non-timeout related error code. If using *curl*, its `--retry` option is suitable. The successful response of this endpoint is equivalent to the `GET /v1/test-sessions/{testSessionId}` endpoint's response for a completed test session..
 *
 * Maps to the official Checkly endpoint GET /v1/test-sessions/{testSessionId}/completion.
 */
class ChecklyGetV1TestsessionsTestsessionidCompletion extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_testsessions_testsessionid_completion';
    protected const DESCRIPTION = 'Call this endpoint to await the completion of a test session. A successful response code will be returned once the test session reaches its final state (i.e. when it passes or fails). If the test session takes a long time to complete, the endpoint will return a timeout error code. You should keep calling the endpoint until you receive a successful response, or a non-timeout related error code. If using *curl*, its `--retry` option is suitable. The successful response of this endpoint is equivalent to the `GET /v1/test-sessions/{testSessionId}` endpoint\'s response for a completed test session.

Official Checkly endpoint: GET /v1/test-sessions/{testSessionId}/completion.';
    protected const PARAMETERS = array (
      'test_session_id' => array (
        'type' => 'string',
        'description' => 'The unique identifier of the test session.',
        'required' => true,
      ),
      'max_wait_seconds' => array (
        'type' => 'number',
        'description' => 'The maximum time to wait for completion, in seconds.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/test-sessions/{testSessionId}/completion';
    protected const PATH_PARAMS = array (
      'testSessionId' => 'test_session_id',
    );
    protected const QUERY_PARAMS = array (
      'maxWaitSeconds' => 'max_wait_seconds',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
