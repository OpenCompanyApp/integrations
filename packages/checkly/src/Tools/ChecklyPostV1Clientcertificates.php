<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Creates a new client certificate..
 *
 * Maps to the official Checkly endpoint POST /v1/client-certificates.
 */
class ChecklyPostV1Clientcertificates extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_clientcertificates';
    protected const DESCRIPTION = 'Creates a new client certificate.

Official Checkly endpoint: POST /v1/client-certificates.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/client-certificates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
