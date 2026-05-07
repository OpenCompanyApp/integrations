<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all client certificates..
 *
 * Maps to the official Checkly endpoint GET /v1/client-certificates.
 */
class ChecklyGetV1Clientcertificates extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_clientcertificates';
    protected const DESCRIPTION = 'Lists all client certificates.

Official Checkly endpoint: GET /v1/client-certificates.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/client-certificates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
