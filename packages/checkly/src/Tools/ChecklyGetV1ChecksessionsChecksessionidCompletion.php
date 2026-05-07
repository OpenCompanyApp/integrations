<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Call this endpoint to await the completion of a check session. A successful response will be returned once the check session reaches its final state (i.e. when it passes or fails). If the check session takes a long time to complete, the endpoint will return a timeout error code. You should keep calling the endpoint until you receive a successful response, or a non-timeout related error code. If using *curl*, its `--retry` option is suitable. The successful response of this endpoint is equivalent to the `GET /v1/check-sessions/{checkSessionId}` endpoint's response for a completed check session..
 *
 * Maps to the official Checkly endpoint GET /v1/check-sessions/{checkSessionId}/completion.
 */
class ChecklyGetV1ChecksessionsChecksessionidCompletion extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checksessions_checksessionid_completion';
    protected const DESCRIPTION = 'Call this endpoint to await the completion of a check session. A successful response will be returned once the check session reaches its final state (i.e. when it passes or fails). If the check session takes a long time to complete, the endpoint will return a timeout error code. You should keep calling the endpoint until you receive a successful response, or a non-timeout related error code. If using *curl*, its `--retry` option is suitable. The successful response of this endpoint is equivalent to the `GET /v1/check-sessions/{checkSessionId}` endpoint\'s response for a completed check session.

Official Checkly endpoint: GET /v1/check-sessions/{checkSessionId}/completion.';
    protected const PARAMETERS = array (
      'check_session_id' => array (
        'type' => 'string',
        'description' => 'The unique identifier of the check session.',
        'required' => true,
      ),
      'max_wait_seconds' => array (
        'type' => 'number',
        'description' => 'The maximum time to wait for completion, in seconds.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/check-sessions/{checkSessionId}/completion';
    protected const PATH_PARAMS = array (
      'checkSessionId' => 'check_session_id',
    );
    protected const QUERY_PARAMS = array (
      'maxWaitSeconds' => 'max_wait_seconds',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
