<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a TLS certificate
 *
 * Maps to Fastly generated client operation TlsCertificatesApi::deleteTlsCert (DELETE /tls/certificates/{tls_certificate_id}).
 */
class FastlyTlsCertificatesDeleteTlsCert extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_certificates_delete_tls_cert';
    protected const DESCRIPTION = 'Delete a TLS certificate

Official Fastly client operation: TlsCertificatesApi::deleteTlsCert
Endpoint: DELETE /tls/certificates/{tls_certificate_id}

Delete a TLS certificate';
    protected const PARAMETERS = array (
  'tls_certificate_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_certificate_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_certificates_delete_tls_cert',
  'class' => 'FastlyTlsCertificatesDeleteTlsCert',
  'api_class' => 'TlsCertificatesApi',
  'method_name' => 'deleteTlsCert',
  'method' => 'DELETE',
  'path' => '/tls/certificates/{tls_certificate_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a TLS certificate',
  'description' => 'Delete a TLS certificate',
  'type' => 'write',
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
