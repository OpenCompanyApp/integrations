<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Cancel a check run, check session, test run, or test session.
 *
 * Maps to the official Checkly endpoint POST /v1/cancel.
 */
class ChecklyCancel extends AbstractChecklyTool
{
    protected const NAME = 'checkly_cancel';
    protected const DESCRIPTION = 'Cancel a check run, check session, test run, or test session

Official Checkly endpoint: POST /v1/cancel.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/cancel';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
