<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a certificate
 *
 * Maps to Fastly generated client operation TlsBulkCertificatesApi::getTlsBulkCert (GET /tls/bulk/certificates/{certificate_id}).
 */
class FastlyTlsBulkCertificatesGetTlsBulkCert extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_bulk_certificates_get_tls_bulk_cert';
    protected const DESCRIPTION = 'Get a certificate

Official Fastly client operation: TlsBulkCertificatesApi::getTlsBulkCert
Endpoint: GET /tls/bulk/certificates/{certificate_id}

Get a certificate';
    protected const PARAMETERS = array (
  'certificate_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `certificate_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_bulk_certificates_get_tls_bulk_cert',
  'class' => 'FastlyTlsBulkCertificatesGetTlsBulkCert',
  'api_class' => 'TlsBulkCertificatesApi',
  'method_name' => 'getTlsBulkCert',
  'method' => 'GET',
  'path' => '/tls/bulk/certificates/{certificate_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a certificate',
  'description' => 'Get a certificate',
  'type' => 'read',
  'parameters' =>
  array (
    'certificate_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `certificate_id`.',
    ),
  ),
  'path_params' =>
  array (
    'certificate_id' => 'certificate_id',
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
