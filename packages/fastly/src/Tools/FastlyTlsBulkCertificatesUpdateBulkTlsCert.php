<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a certificate
 *
 * Maps to Fastly generated client operation TlsBulkCertificatesApi::updateBulkTlsCert (PATCH /tls/bulk/certificates/{certificate_id}).
 */
class FastlyTlsBulkCertificatesUpdateBulkTlsCert extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_bulk_certificates_update_bulk_tls_cert';
    protected const DESCRIPTION = 'Update a certificate

Official Fastly client operation: TlsBulkCertificatesApi::updateBulkTlsCert
Endpoint: PATCH /tls/bulk/certificates/{certificate_id}

Update a certificate';
    protected const PARAMETERS = array (
  'certificate_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `certificate_id`.',
  ),
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
  'slug' => 'fastly_tls_bulk_certificates_update_bulk_tls_cert',
  'class' => 'FastlyTlsBulkCertificatesUpdateBulkTlsCert',
  'api_class' => 'TlsBulkCertificatesApi',
  'method_name' => 'updateBulkTlsCert',
  'method' => 'PATCH',
  'path' => '/tls/bulk/certificates/{certificate_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a certificate',
  'description' => 'Update a certificate',
  'type' => 'write',
  'parameters' =>
  array (
    'certificate_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `certificate_id`.',
    ),
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
  'body_param' => 'tls_bulk_certificate',
  'body_required' => false,
);
}
