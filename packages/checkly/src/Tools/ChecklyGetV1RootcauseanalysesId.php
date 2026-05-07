<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Retrieves a specific root cause analysis. Use the `id` returned from either POST endpoint and poll until the response is HTTP 200. While the analysis is being generated the endpoint returns HTTP 202 with `{"id":"","status":"PENDING"}`. A genuine HTTP 404 means the ID does not exist. Works for both check error group and test session error group analyses..
 *
 * Maps to the official Checkly endpoint GET /v1/root-cause-analyses/{id}.
 */
class ChecklyGetV1RootcauseanalysesId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_rootcauseanalyses_id';
    protected const DESCRIPTION = 'Retrieves a specific root cause analysis. Use the `id` returned from either POST endpoint and poll until the response is HTTP 200. While the analysis is being generated the endpoint returns HTTP 202 with `{"id":"","status":"PENDING"}`. A genuine HTTP 404 means the ID does not exist. Works for both check error group and test session error group analyses.

Official Checkly endpoint: GET /v1/root-cause-analyses/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/root-cause-analyses/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
