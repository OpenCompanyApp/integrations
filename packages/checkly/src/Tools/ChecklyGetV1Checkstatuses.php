<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Shows the current status information for all checks in your account. The check status records are continuously updated as new check results come in..
 *
 * Maps to the official Checkly endpoint GET /v1/check-statuses.
 */
class ChecklyGetV1Checkstatuses extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checkstatuses';
    protected const DESCRIPTION = 'Shows the current status information for all checks in your account. The check status records are continuously updated as new check results come in.

Official Checkly endpoint: GET /v1/check-statuses.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/check-statuses';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
