<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a backend
 *
 * Maps to Fastly generated client operation BackendApi::updateBackend (PUT /service/{service_id}/version/{version_id}/backend/{backend_name}).
 */
class FastlyBackendUpdateBackend extends AbstractFastlyTool
{
    protected const NAME = 'fastly_backend_update_backend';
    protected const DESCRIPTION = 'Update a backend

Official Fastly client operation: BackendApi::updateBackend
Endpoint: PUT /service/{service_id}/version/{version_id}/backend/{backend_name}

Update a backend';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'version_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `version_id`.',
  ),
  'backend_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `backend_name`.',
  ),
  'address' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `address`.',
  ),
  'auto_loadbalance' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `auto_loadbalance`.',
  ),
  'between_bytes_timeout' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `between_bytes_timeout`.',
  ),
  'client_cert' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `client_cert`.',
  ),
  'comment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `comment`.',
  ),
  'connect_timeout' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `connect_timeout`.',
  ),
  'first_byte_timeout' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `first_byte_timeout`.',
  ),
  'fetch_timeout' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `fetch_timeout`.',
  ),
  'healthcheck' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `healthcheck`.',
  ),
  'hostname' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `hostname`.',
  ),
  'ipv4' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ipv4`.',
  ),
  'ipv6' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ipv6`.',
  ),
  'keepalive_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `keepalive_time`.',
  ),
  'max_conn' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `max_conn`.',
  ),
  'max_tls_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `max_tls_version`.',
  ),
  'min_tls_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `min_tls_version`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'override_host' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `override_host`.',
  ),
  'port' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `port`.',
  ),
  'prefer_ipv6' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `prefer_ipv6`.',
  ),
  'request_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `request_condition`.',
  ),
  'share_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `share_key`.',
  ),
  'shield' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `shield`.',
  ),
  'ssl_ca_cert' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ssl_ca_cert`.',
  ),
  'ssl_cert_hostname' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ssl_cert_hostname`.',
  ),
  'ssl_check_cert' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ssl_check_cert`.',
  ),
  'ssl_ciphers' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ssl_ciphers`.',
  ),
  'ssl_client_cert' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ssl_client_cert`.',
  ),
  'ssl_client_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ssl_client_key`.',
  ),
  'ssl_hostname' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ssl_hostname`.',
  ),
  'ssl_sni_hostname' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ssl_sni_hostname`.',
  ),
  'tcp_keepalive_enable' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tcp_keepalive_enable`.',
  ),
  'tcp_keepalive_interval' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tcp_keepalive_interval`.',
  ),
  'tcp_keepalive_probes' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tcp_keepalive_probes`.',
  ),
  'tcp_keepalive_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tcp_keepalive_time`.',
  ),
  'use_ssl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `use_ssl`.',
  ),
  'weight' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `weight`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_backend_update_backend',
  'class' => 'FastlyBackendUpdateBackend',
  'api_class' => 'BackendApi',
  'method_name' => 'updateBackend',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/backend/{backend_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a backend',
  'description' => 'Update a backend',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'version_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `version_id`.',
    ),
    'backend_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `backend_name`.',
    ),
    'address' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `address`.',
    ),
    'auto_loadbalance' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `auto_loadbalance`.',
    ),
    'between_bytes_timeout' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `between_bytes_timeout`.',
    ),
    'client_cert' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `client_cert`.',
    ),
    'comment' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `comment`.',
    ),
    'connect_timeout' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `connect_timeout`.',
    ),
    'first_byte_timeout' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `first_byte_timeout`.',
    ),
    'fetch_timeout' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `fetch_timeout`.',
    ),
    'healthcheck' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `healthcheck`.',
    ),
    'hostname' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `hostname`.',
    ),
    'ipv4' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ipv4`.',
    ),
    'ipv6' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ipv6`.',
    ),
    'keepalive_time' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `keepalive_time`.',
    ),
    'max_conn' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `max_conn`.',
    ),
    'max_tls_version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `max_tls_version`.',
    ),
    'min_tls_version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `min_tls_version`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'override_host' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `override_host`.',
    ),
    'port' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `port`.',
    ),
    'prefer_ipv6' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `prefer_ipv6`.',
    ),
    'request_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `request_condition`.',
    ),
    'share_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `share_key`.',
    ),
    'shield' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `shield`.',
    ),
    'ssl_ca_cert' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ssl_ca_cert`.',
    ),
    'ssl_cert_hostname' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ssl_cert_hostname`.',
    ),
    'ssl_check_cert' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ssl_check_cert`.',
    ),
    'ssl_ciphers' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ssl_ciphers`.',
    ),
    'ssl_client_cert' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ssl_client_cert`.',
    ),
    'ssl_client_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ssl_client_key`.',
    ),
    'ssl_hostname' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ssl_hostname`.',
    ),
    'ssl_sni_hostname' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ssl_sni_hostname`.',
    ),
    'tcp_keepalive_enable' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tcp_keepalive_enable`.',
    ),
    'tcp_keepalive_interval' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tcp_keepalive_interval`.',
    ),
    'tcp_keepalive_probes' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tcp_keepalive_probes`.',
    ),
    'tcp_keepalive_time' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tcp_keepalive_time`.',
    ),
    'use_ssl' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `use_ssl`.',
    ),
    'weight' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `weight`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'backend_name' => 'backend_name',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
    'address' => 'address',
    'auto_loadbalance' => 'auto_loadbalance',
    'between_bytes_timeout' => 'between_bytes_timeout',
    'client_cert' => 'client_cert',
    'comment' => 'comment',
    'connect_timeout' => 'connect_timeout',
    'first_byte_timeout' => 'first_byte_timeout',
    'fetch_timeout' => 'fetch_timeout',
    'healthcheck' => 'healthcheck',
    'hostname' => 'hostname',
    'ipv4' => 'ipv4',
    'ipv6' => 'ipv6',
    'keepalive_time' => 'keepalive_time',
    'max_conn' => 'max_conn',
    'max_tls_version' => 'max_tls_version',
    'min_tls_version' => 'min_tls_version',
    'name' => 'name',
    'override_host' => 'override_host',
    'port' => 'port',
    'prefer_ipv6' => 'prefer_ipv6',
    'request_condition' => 'request_condition',
    'share_key' => 'share_key',
    'shield' => 'shield',
    'ssl_ca_cert' => 'ssl_ca_cert',
    'ssl_cert_hostname' => 'ssl_cert_hostname',
    'ssl_check_cert' => 'ssl_check_cert',
    'ssl_ciphers' => 'ssl_ciphers',
    'ssl_client_cert' => 'ssl_client_cert',
    'ssl_client_key' => 'ssl_client_key',
    'ssl_hostname' => 'ssl_hostname',
    'ssl_sni_hostname' => 'ssl_sni_hostname',
    'tcp_keepalive_enable' => 'tcp_keepalive_enable',
    'tcp_keepalive_interval' => 'tcp_keepalive_interval',
    'tcp_keepalive_probes' => 'tcp_keepalive_probes',
    'tcp_keepalive_time' => 'tcp_keepalive_time',
    'use_ssl' => 'use_ssl',
    'weight' => 'weight',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
