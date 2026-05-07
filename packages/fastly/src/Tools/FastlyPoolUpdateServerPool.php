<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a server pool
 *
 * Maps to Fastly generated client operation PoolApi::updateServerPool (PUT /service/{service_id}/version/{version_id}/pool/{pool_name}).
 */
class FastlyPoolUpdateServerPool extends AbstractFastlyTool
{
    protected const NAME = 'fastly_pool_update_server_pool';
    protected const DESCRIPTION = 'Update a server pool

Official Fastly client operation: PoolApi::updateServerPool
Endpoint: PUT /service/{service_id}/version/{version_id}/pool/{pool_name}

Update a server pool';
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
  'pool_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `pool_name`.',
  ),
  'tls_ca_cert' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_ca_cert`.',
  ),
  'tls_client_cert' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_client_cert`.',
  ),
  'tls_client_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_client_key`.',
  ),
  'tls_cert_hostname' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_cert_hostname`.',
  ),
  'use_tls' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `use_tls`.',
  ),
  'created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `created_at`.',
  ),
  'deleted_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `deleted_at`.',
  ),
  'updated_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `updated_at`.',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `version`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'shield' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `shield`.',
  ),
  'request_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `request_condition`.',
  ),
  'tls_ciphers' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_ciphers`.',
  ),
  'tls_sni_hostname' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_sni_hostname`.',
  ),
  'min_tls_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `min_tls_version`.',
  ),
  'max_tls_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `max_tls_version`.',
  ),
  'healthcheck' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `healthcheck`.',
  ),
  'comment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `comment`.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `type`.',
  ),
  'override_host' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `override_host`.',
  ),
  'between_bytes_timeout' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `between_bytes_timeout`.',
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
  'max_conn_default' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `max_conn_default`.',
  ),
  'quorum' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `quorum`.',
  ),
  'tls_check_cert' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_check_cert`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_pool_update_server_pool',
  'class' => 'FastlyPoolUpdateServerPool',
  'api_class' => 'PoolApi',
  'method_name' => 'updateServerPool',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/pool/{pool_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a server pool',
  'description' => 'Update a server pool',
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
    'pool_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `pool_name`.',
    ),
    'tls_ca_cert' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_ca_cert`.',
    ),
    'tls_client_cert' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_client_cert`.',
    ),
    'tls_client_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_client_key`.',
    ),
    'tls_cert_hostname' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_cert_hostname`.',
    ),
    'use_tls' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `use_tls`.',
    ),
    'created_at' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `created_at`.',
    ),
    'deleted_at' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `deleted_at`.',
    ),
    'updated_at' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `updated_at`.',
    ),
    'version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `version`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'shield' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `shield`.',
    ),
    'request_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `request_condition`.',
    ),
    'tls_ciphers' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_ciphers`.',
    ),
    'tls_sni_hostname' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_sni_hostname`.',
    ),
    'min_tls_version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `min_tls_version`.',
    ),
    'max_tls_version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `max_tls_version`.',
    ),
    'healthcheck' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `healthcheck`.',
    ),
    'comment' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `comment`.',
    ),
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `type`.',
    ),
    'override_host' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `override_host`.',
    ),
    'between_bytes_timeout' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `between_bytes_timeout`.',
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
    'max_conn_default' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `max_conn_default`.',
    ),
    'quorum' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `quorum`.',
    ),
    'tls_check_cert' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_check_cert`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'pool_name' => 'pool_name',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
    'tls_ca_cert' => 'tls_ca_cert',
    'tls_client_cert' => 'tls_client_cert',
    'tls_client_key' => 'tls_client_key',
    'tls_cert_hostname' => 'tls_cert_hostname',
    'use_tls' => 'use_tls',
    'created_at' => 'created_at',
    'deleted_at' => 'deleted_at',
    'updated_at' => 'updated_at',
    'service_id' => 'service_id',
    'version' => 'version',
    'name' => 'name',
    'shield' => 'shield',
    'request_condition' => 'request_condition',
    'tls_ciphers' => 'tls_ciphers',
    'tls_sni_hostname' => 'tls_sni_hostname',
    'min_tls_version' => 'min_tls_version',
    'max_tls_version' => 'max_tls_version',
    'healthcheck' => 'healthcheck',
    'comment' => 'comment',
    'type' => 'type',
    'override_host' => 'override_host',
    'between_bytes_timeout' => 'between_bytes_timeout',
    'connect_timeout' => 'connect_timeout',
    'first_byte_timeout' => 'first_byte_timeout',
    'max_conn_default' => 'max_conn_default',
    'quorum' => 'quorum',
    'tls_check_cert' => 'tls_check_cert',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
