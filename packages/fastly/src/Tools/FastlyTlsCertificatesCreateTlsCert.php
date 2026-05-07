<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a TLS certificate
 *
 * Maps to Fastly generated client operation TlsCertificatesApi::createTlsCert (POST /tls/certificates).
 */
class FastlyTlsCertificatesCreateTlsCert extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_certificates_create_tls_cert';
    protected const DESCRIPTION = 'Create a TLS certificate

Official Fastly client operation: TlsCertificatesApi::createTlsCert
Endpoint: POST /tls/certificates

Create a TLS certificate';
    protected const PARAMETERS = array (
  'tls_certificate' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `tls_certificate`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_certificates_create_tls_cert',
  'class' => 'FastlyTlsCertificatesCreateTlsCert',
  'api_class' => 'TlsCertificatesApi',
  'method_name' => 'createTlsCert',
  'method' => 'POST',
  'path' => '/tls/certificates',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a TLS certificate',
  'description' => 'Create a TLS certificate',
  'type' => 'write',
  'parameters' =>
  array (
    'tls_certificate' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `tls_certificate`.',
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
  'body_param' => 'tls_certificate',
  'body_required' => false,
);
}
