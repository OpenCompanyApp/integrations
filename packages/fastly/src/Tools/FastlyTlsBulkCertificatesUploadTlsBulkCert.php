<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Upload a certificate
 *
 * Maps to Fastly generated client operation TlsBulkCertificatesApi::uploadTlsBulkCert (POST /tls/bulk/certificates).
 */
class FastlyTlsBulkCertificatesUploadTlsBulkCert extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_bulk_certificates_upload_tls_bulk_cert';
    protected const DESCRIPTION = 'Upload a certificate

Official Fastly client operation: TlsBulkCertificatesApi::uploadTlsBulkCert
Endpoint: POST /tls/bulk/certificates

Upload a certificate';
    protected const PARAMETERS = array (
  'tls_bulk_certificate' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `tls_bulk_certificate`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_bulk_certificates_upload_tls_bulk_cert',
  'class' => 'FastlyTlsBulkCertificatesUploadTlsBulkCert',
  'api_class' => 'TlsBulkCertificatesApi',
  'method_name' => 'uploadTlsBulkCert',
  'method' => 'POST',
  'path' => '/tls/bulk/certificates',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Upload a certificate',
  'description' => 'Upload a certificate',
  'type' => 'write',
  'parameters' =>
  array (
    'tls_bulk_certificate' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `tls_bulk_certificate`.',
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
  'body_param' => 'tls_bulk_certificate',
  'body_required' => false,
);
}
