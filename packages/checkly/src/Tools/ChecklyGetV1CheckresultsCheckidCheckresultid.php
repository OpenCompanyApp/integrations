<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Show details of a specific check result..
 *
 * Maps to the official Checkly endpoint GET /v1/check-results/{checkId}/{checkResultId}.
 */
class ChecklyGetV1CheckresultsCheckidCheckresultid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checkresults_checkid_checkresultid';
    protected const DESCRIPTION = 'Show details of a specific check result.

Official Checkly endpoint: GET /v1/check-results/{checkId}/{checkResultId}.';
    protected const PARAMETERS = array (
      'check_id' => array (
        'type' => 'string',
        'description' => 'checkId parameter.',
        'required' => true,
      ),
      'check_result_id' => array (
        'type' => 'string',
        'description' => 'checkResultId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/check-results/{checkId}/{checkResultId}';
    protected const PATH_PARAMS = array (
      'checkId' => 'check_id',
      'checkResultId' => 'check_result_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
