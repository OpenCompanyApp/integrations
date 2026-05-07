<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Shows one client certificate..
 *
 * Maps to the official Checkly endpoint GET /v1/client-certificates/{id}.
 */
class ChecklyGetV1ClientcertificatesId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_clientcertificates_id';
    protected const DESCRIPTION = 'Shows one client certificate.

Official Checkly endpoint: GET /v1/client-certificates/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/client-certificates/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
