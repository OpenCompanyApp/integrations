<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes a client certificate..
 *
 * Maps to the official Checkly endpoint DELETE /v1/client-certificates/{id}.
 */
class ChecklyDeleteV1ClientcertificatesId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_clientcertificates_id';
    protected const DESCRIPTION = 'Permanently removes a client certificate.

Official Checkly endpoint: DELETE /v1/client-certificates/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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
