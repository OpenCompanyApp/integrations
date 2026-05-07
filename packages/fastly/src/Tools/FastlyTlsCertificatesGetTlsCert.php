<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a TLS certificate
 *
 * Maps to Fastly generated client operation TlsCertificatesApi::getTlsCert (GET /tls/certificates/{tls_certificate_id}).
 */
class FastlyTlsCertificatesGetTlsCert extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_certificates_get_tls_cert';
    protected const DESCRIPTION = 'Get a TLS certificate

Official Fastly client operation: TlsCertificatesApi::getTlsCert
Endpoint: GET /tls/certificates/{tls_certificate_id}

Get a TLS certificate';
    protected const PARAMETERS = array (
  'tls_certificate_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_certificate_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_certificates_get_tls_cert',
  'class' => 'FastlyTlsCertificatesGetTlsCert',
  'api_class' => 'TlsCertificatesApi',
  'method_name' => 'getTlsCert',
  'method' => 'GET',
  'path' => '/tls/certificates/{tls_certificate_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a TLS certificate',
  'description' => 'Get a TLS certificate',
  'type' => 'read',
  'parameters' =>
  array (
    'tls_certificate_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `tls_certificate_id`.',
    ),
  ),
  'path_params' =>
  array (
    'tls_certificate_id' => 'tls_certificate_id',
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
  'body_param' => NULL,
  'body_required' => false,
);
}
