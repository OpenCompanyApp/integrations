<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Show the current status information for a specific check..
 *
 * Maps to the official Checkly endpoint GET /v1/check-statuses/{checkId}.
 */
class ChecklyGetV1CheckstatusesCheckid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checkstatuses_checkid';
    protected const DESCRIPTION = 'Show the current status information for a specific check.

Official Checkly endpoint: GET /v1/check-statuses/{checkId}.';
    protected const PARAMETERS = array (
      'check_id' => array (
        'type' => 'string',
        'description' => 'checkId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/check-statuses/{checkId}';
    protected const PATH_PARAMS = array (
      'checkId' => 'check_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
