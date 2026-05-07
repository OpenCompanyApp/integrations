<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * (Deprecated) Approve a Certificate.
 *
 * Maps to the official Fivetran endpoint post /v1/certificates.
 */
class FivetranApproveCertificate extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_approve_certificate';
    protected const DESCRIPTION = '(Deprecated) Approve a Certificate

Official Fivetran endpoint: POST /v1/certificates

Approves a certificate for a connection/destination, so Fivetran trusts this certificate for a source/destination database. The connection/destination setup tests will fail if a non-approved certificate is provided.';
    protected const PARAMETERS = array (
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/certificates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
