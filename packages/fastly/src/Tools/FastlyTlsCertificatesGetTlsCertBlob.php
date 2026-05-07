<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a TLS certificate blob (Limited Availability)
 *
 * Maps to Fastly generated client operation TlsCertificatesApi::getTlsCertBlob (GET /tls/certificates/{tls_certificate_id}/blob).
 */
class FastlyTlsCertificatesGetTlsCertBlob extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_certificates_get_tls_cert_blob';
    protected const DESCRIPTION = 'Get a TLS certificate blob (Limited Availability)

Official Fastly client operation: TlsCertificatesApi::getTlsCertBlob
Endpoint: GET /tls/certificates/{tls_certificate_id}/blob

Get a TLS certificate blob (Limited Availability)';
    protected const PARAMETERS = array (
  'tls_certificate_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_certificate_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_certificates_get_tls_cert_blob',
  'class' => 'FastlyTlsCertificatesGetTlsCertBlob',
  'api_class' => 'TlsCertificatesApi',
  'method_name' => 'getTlsCertBlob',
  'method' => 'GET',
  'path' => '/tls/certificates/{tls_certificate_id}/blob',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a TLS certificate blob (Limited Availability)',
  'description' => 'Get a TLS certificate blob (Limited Availability)',
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
