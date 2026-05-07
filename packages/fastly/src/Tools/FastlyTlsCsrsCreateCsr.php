<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create CSR
 *
 * Maps to Fastly generated client operation TlsCsrsApi::createCsr (POST /tls/certificate_signing_requests).
 */
class FastlyTlsCsrsCreateCsr extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_csrs_create_csr';
    protected const DESCRIPTION = 'Create CSR

Official Fastly client operation: TlsCsrsApi::createCsr
Endpoint: POST /tls/certificate_signing_requests

Create CSR';
    protected const PARAMETERS = array (
  'tls_csr' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `tls_csr`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_csrs_create_csr',
  'class' => 'FastlyTlsCsrsCreateCsr',
  'api_class' => 'TlsCsrsApi',
  'method_name' => 'createCsr',
  'method' => 'POST',
  'path' => '/tls/certificate_signing_requests',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create CSR',
  'description' => 'Create CSR',
  'type' => 'write',
  'parameters' =>
  array (
    'tls_csr' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `tls_csr`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => 'tls_csr',
  'body_required' => false,
);
}
