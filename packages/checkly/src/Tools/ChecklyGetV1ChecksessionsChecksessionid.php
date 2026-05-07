<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Retrieves a check session. Results may be incomplete if the check session is still in progress. Once a check session has finished, results will include at least one check result for each run location: one result with `resultType` equal to `"FINAL"`, and zero or more results with `resultType` equal to `"ATTEMPT"` (one for each failed attempt, if any). Each result contains just enough information to quickly determine whether the check run was successful or not. To dive even deeper into individual results, use the `GET /v1/check-results/{checkId}/{checkResultId}` endpoint to retrieve detailed data about a specific result..
 *
 * Maps to the official Checkly endpoint GET /v1/check-sessions/{checkSessionId}.
 */
class ChecklyGetV1ChecksessionsChecksessionid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checksessions_checksessionid';
    protected const DESCRIPTION = 'Retrieves a check session. Results may be incomplete if the check session is still in progress. Once a check session has finished, results will include at least one check result for each run location: one result with `resultType` equal to `"FINAL"`, and zero or more results with `resultType` equal to `"ATTEMPT"` (one for each failed attempt, if any). Each result contains just enough information to quickly determine whether the check run was successful or not. To dive even deeper into individual results, use the `GET /v1/check-results/{checkId}/{checkResultId}` endpoint to retrieve detailed data about a specific result.

Official Checkly endpoint: GET /v1/check-sessions/{checkSessionId}.';
    protected const PARAMETERS = array (
      'check_session_id' => array (
        'type' => 'string',
        'description' => 'The unique identifier of the check session.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/check-sessions/{checkSessionId}';
    protected const PATH_PARAMS = array (
      'checkSessionId' => 'check_session_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
