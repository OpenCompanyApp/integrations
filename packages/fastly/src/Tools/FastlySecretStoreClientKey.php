<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create new client key
 *
 * Maps to Fastly generated client operation SecretStoreApi::clientKey (POST /resources/stores/secret/client-key).
 */
class FastlySecretStoreClientKey extends AbstractFastlyTool
{
    protected const NAME = 'fastly_secret_store_client_key';
    protected const DESCRIPTION = 'Create new client key

Official Fastly client operation: SecretStoreApi::clientKey
Endpoint: POST /resources/stores/secret/client-key

Create new client key';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_secret_store_client_key',
  'class' => 'FastlySecretStoreClientKey',
  'api_class' => 'SecretStoreApi',
  'method_name' => 'clientKey',
  'method' => 'POST',
  'path' => '/resources/stores/secret/client-key',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create new client key',
  'description' => 'Create new client key',
  'type' => 'write',
  'parameters' =>
  array (
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
  'body_param' => NULL,
  'body_required' => false,
);
}
