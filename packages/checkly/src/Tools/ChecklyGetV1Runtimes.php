<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all supported runtimes and the included NPM packages for Browser checks and setup & teardown scripts for API checks..
 *
 * Maps to the official Checkly endpoint GET /v1/runtimes.
 */
class ChecklyGetV1Runtimes extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_runtimes';
    protected const DESCRIPTION = 'Lists all supported runtimes and the included NPM packages for Browser checks and setup & teardown scripts for API checks.

Official Checkly endpoint: GET /v1/runtimes.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/runtimes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
