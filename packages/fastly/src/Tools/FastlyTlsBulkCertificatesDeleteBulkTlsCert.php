<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a certificate
 *
 * Maps to Fastly generated client operation TlsBulkCertificatesApi::deleteBulkTlsCert (DELETE /tls/bulk/certificates/{certificate_id}).
 */
class FastlyTlsBulkCertificatesDeleteBulkTlsCert extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_bulk_certificates_delete_bulk_tls_cert';
    protected const DESCRIPTION = 'Delete a certificate

Official Fastly client operation: TlsBulkCertificatesApi::deleteBulkTlsCert
Endpoint: DELETE /tls/bulk/certificates/{certificate_id}

Delete a certificate';
    protected const PARAMETERS = array (
  'certificate_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `certificate_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_bulk_certificates_delete_bulk_tls_cert',
  'class' => 'FastlyTlsBulkCertificatesDeleteBulkTlsCert',
  'api_class' => 'TlsBulkCertificatesApi',
  'method_name' => 'deleteBulkTlsCert',
  'method' => 'DELETE',
  'path' => '/tls/bulk/certificates/{certificate_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a certificate',
  'description' => 'Delete a certificate',
  'type' => 'write',
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
