<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Starts a check session for each check that matches the provided target filters. If no filters are given, matches all eligible checks. This endpoint does not wait for the check session to complete. Use the `GET /v1/check-sessions/{checkSessionId}/completion` or `GET /v1/check-sessions/{checkSessionId}` endpoints to track progress if needed. Standard alerting rules apply to finished check runs. Equivalent to the _Schedule Now_ button in the UI..
 *
 * Maps to the official Checkly endpoint POST /v1/check-sessions/trigger.
 */
class ChecklyPostV1ChecksessionsTrigger extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_checksessions_trigger';
    protected const DESCRIPTION = 'Starts a check session for each check that matches the provided target filters. If no filters are given, matches all eligible checks. This endpoint does not wait for the check session to complete. Use the `GET /v1/check-sessions/{checkSessionId}/completion` or `GET /v1/check-sessions/{checkSessionId}` endpoints to track progress if needed. Standard alerting rules apply to finished check runs. Equivalent to the _Schedule Now_ button in the UI.

Official Checkly endpoint: POST /v1/check-sessions/trigger.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/check-sessions/trigger';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
