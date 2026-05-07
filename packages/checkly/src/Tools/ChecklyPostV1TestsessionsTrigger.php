<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Starts a tests session with checks matching the provided target filters. If no filters are given, matches all eligible checks. This endpoint does not wait for the test session to complete. Use the `GET /v1/test-sessions/{testSessionId}/completion` or `GET /v1/test-sessions/{testSessionId}` endpoints to track progress if needed. Test sessions do not produce alerts. Equivalent to the `npx checkly trigger` command of the Checkly CLI..
 *
 * Maps to the official Checkly endpoint POST /v1/test-sessions/trigger.
 */
class ChecklyPostV1TestsessionsTrigger extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_testsessions_trigger';
    protected const DESCRIPTION = 'Starts a tests session with checks matching the provided target filters. If no filters are given, matches all eligible checks. This endpoint does not wait for the test session to complete. Use the `GET /v1/test-sessions/{testSessionId}/completion` or `GET /v1/test-sessions/{testSessionId}` endpoints to track progress if needed. Test sessions do not produce alerts. Equivalent to the `npx checkly trigger` command of the Checkly CLI.

Official Checkly endpoint: POST /v1/test-sessions/trigger.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/test-sessions/trigger';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
