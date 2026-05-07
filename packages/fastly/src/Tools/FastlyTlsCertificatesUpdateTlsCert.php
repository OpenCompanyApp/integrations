<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a TLS certificate
 *
 * Maps to Fastly generated client operation TlsCertificatesApi::updateTlsCert (PATCH /tls/certificates/{tls_certificate_id}).
 */
class FastlyTlsCertificatesUpdateTlsCert extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_certificates_update_tls_cert';
    protected const DESCRIPTION = 'Update a TLS certificate

Official Fastly client operation: TlsCertificatesApi::updateTlsCert
Endpoint: PATCH /tls/certificates/{tls_certificate_id}

Update a TLS certificate';
    protected const PARAMETERS = array (
  'tls_certificate_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_certificate_id`.',
  ),
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
  'slug' => 'fastly_tls_certificates_update_tls_cert',
  'class' => 'FastlyTlsCertificatesUpdateTlsCert',
  'api_class' => 'TlsCertificatesApi',
  'method_name' => 'updateTlsCert',
  'method' => 'PATCH',
  'path' => '/tls/certificates/{tls_certificate_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a TLS certificate',
  'description' => 'Update a TLS certificate',
  'type' => 'write',
  'parameters' =>
  array (
    'tls_certificate_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `tls_certificate_id`.',
    ),
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
  'body_param' => 'tls_certificate',
  'body_required' => false,
);
}
