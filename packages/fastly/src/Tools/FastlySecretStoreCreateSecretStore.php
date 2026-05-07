<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create new secret store
 *
 * Maps to Fastly generated client operation SecretStoreApi::createSecretStore (POST /resources/stores/secret).
 */
class FastlySecretStoreCreateSecretStore extends AbstractFastlyTool
{
    protected const NAME = 'fastly_secret_store_create_secret_store';
    protected const DESCRIPTION = 'Create new secret store

Official Fastly client operation: SecretStoreApi::createSecretStore
Endpoint: POST /resources/stores/secret

Create new secret store';
    protected const PARAMETERS = array (
  'secret_store' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `secret_store`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_secret_store_create_secret_store',
  'class' => 'FastlySecretStoreCreateSecretStore',
  'api_class' => 'SecretStoreApi',
  'method_name' => 'createSecretStore',
  'method' => 'POST',
  'path' => '/resources/stores/secret',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create new secret store',
  'description' => 'Create new secret store',
  'type' => 'write',
  'parameters' =>
  array (
    'secret_store' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `secret_store`.',
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
  'body_param' => 'secret_store',
  'body_required' => false,
);
}
