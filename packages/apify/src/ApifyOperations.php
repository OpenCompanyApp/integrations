<?php

namespace OpenCompany\Integrations\Apify;

/**
 * Official Apify OpenAPI operation metadata.
 *
 * Source: https://docs.apify.com/api/openapi.json.
 */
class ApifyOperations
{
    /**
     * Return all supported Apify API operations.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
  0 =>
  [
    'operation' => 'acts_get',
    'slug' => 'apify_acts_get',
    'class' => 'ApifyActsGet',
    'method' => 'GET',
    'path' => '/v2/acts',
    'name' => 'Get list of Actors',
    'description' => 'Execute official Apify API operation `acts_get`.

Endpoint: GET /v2/acts.',
    'type' => 'read',
    'tag' => 'Actors',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'my',
        'param' => 'my',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the returned list only contains Actors owned by the user. The default value is `false`.',
      ],
      1 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      3 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `createdAt` field in descending order. By default, they are sorted in ascending order.',
      ],
      4 =>
      [
        'name' => 'sortBy',
        'param' => 'sort_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Field to sort the records by. The default is `createdAt`. You can also use `stats.lastRunStartedAt` to sort by the most recently ran Actors.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  1 =>
  [
    'operation' => 'acts_post',
    'slug' => 'apify_acts_post',
    'class' => 'ApifyActsPost',
    'method' => 'POST',
    'path' => '/v2/acts',
    'name' => 'Create Actor',
    'description' => 'Execute official Apify API operation `acts_post`.

Endpoint: POST /v2/acts.',
    'type' => 'write',
    'tag' => 'Actors',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  2 =>
  [
    'operation' => 'act_get',
    'slug' => 'apify_act_get',
    'class' => 'ApifyActGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}',
    'name' => 'Get Actor',
    'description' => 'Execute official Apify API operation `act_get`.

Endpoint: GET /v2/acts/{actorId}.',
    'type' => 'read',
    'tag' => 'Actors',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  3 =>
  [
    'operation' => 'act_put',
    'slug' => 'apify_act_put',
    'class' => 'ApifyActPut',
    'method' => 'PUT',
    'path' => '/v2/acts/{actorId}',
    'name' => 'Update Actor',
    'description' => 'Execute official Apify API operation `act_put`.

Endpoint: PUT /v2/acts/{actorId}.',
    'type' => 'write',
    'tag' => 'Actors',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  4 =>
  [
    'operation' => 'act_delete',
    'slug' => 'apify_act_delete',
    'class' => 'ApifyActDelete',
    'method' => 'DELETE',
    'path' => '/v2/acts/{actorId}',
    'name' => 'Delete Actor',
    'description' => 'Execute official Apify API operation `act_delete`.

Endpoint: DELETE /v2/acts/{actorId}.',
    'type' => 'write',
    'tag' => 'Actors',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  5 =>
  [
    'operation' => 'act_versions_get',
    'slug' => 'apify_act_versions_get',
    'class' => 'ApifyActVersionsGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/versions',
    'name' => 'Get list of versions',
    'description' => 'Execute official Apify API operation `act_versions_get`.

Endpoint: GET /v2/acts/{actorId}/versions.',
    'type' => 'read',
    'tag' => 'Actors/Actor versions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  6 =>
  [
    'operation' => 'act_versions_post',
    'slug' => 'apify_act_versions_post',
    'class' => 'ApifyActVersionsPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/versions',
    'name' => 'Create version',
    'description' => 'Execute official Apify API operation `act_versions_post`.

Endpoint: POST /v2/acts/{actorId}/versions.',
    'type' => 'write',
    'tag' => 'Actors/Actor versions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  7 =>
  [
    'operation' => 'act_version_get',
    'slug' => 'apify_act_version_get',
    'class' => 'ApifyActVersionGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/versions/{versionNumber}',
    'name' => 'Get version',
    'description' => 'Execute official Apify API operation `act_version_get`.

Endpoint: GET /v2/acts/{actorId}/versions/{versionNumber}.',
    'type' => 'read',
    'tag' => 'Actors/Actor versions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'versionNumber',
        'param' => 'version_number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor version.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  8 =>
  [
    'operation' => 'act_version_put',
    'slug' => 'apify_act_version_put',
    'class' => 'ApifyActVersionPut',
    'method' => 'PUT',
    'path' => '/v2/acts/{actorId}/versions/{versionNumber}',
    'name' => 'Update version',
    'description' => 'Execute official Apify API operation `act_version_put`.

Endpoint: PUT /v2/acts/{actorId}/versions/{versionNumber}.',
    'type' => 'write',
    'tag' => 'Actors/Actor versions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'versionNumber',
        'param' => 'version_number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor version.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  9 =>
  [
    'operation' => 'act_version_post',
    'slug' => 'apify_act_version_post',
    'class' => 'ApifyActVersionPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/versions/{versionNumber}',
    'name' => 'Update version (POST)',
    'description' => 'Execute official Apify API operation `act_version_post`.

Endpoint: POST /v2/acts/{actorId}/versions/{versionNumber}.',
    'type' => 'write',
    'tag' => 'Actors/Actor versions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'versionNumber',
        'param' => 'version_number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor version.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  10 =>
  [
    'operation' => 'act_version_delete',
    'slug' => 'apify_act_version_delete',
    'class' => 'ApifyActVersionDelete',
    'method' => 'DELETE',
    'path' => '/v2/acts/{actorId}/versions/{versionNumber}',
    'name' => 'Delete version',
    'description' => 'Execute official Apify API operation `act_version_delete`.

Endpoint: DELETE /v2/acts/{actorId}/versions/{versionNumber}.',
    'type' => 'write',
    'tag' => 'Actors/Actor versions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'versionNumber',
        'param' => 'version_number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor version.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  11 =>
  [
    'operation' => 'act_version_envVars_get',
    'slug' => 'apify_act_version_env_vars_get',
    'class' => 'ApifyActVersionEnvVarsGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/versions/{versionNumber}/env-vars',
    'name' => 'Get list of environment variables',
    'description' => 'Execute official Apify API operation `act_version_envVars_get`.

Endpoint: GET /v2/acts/{actorId}/versions/{versionNumber}/env-vars.',
    'type' => 'read',
    'tag' => 'Actors/Actor versions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'versionNumber',
        'param' => 'version_number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor version.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  12 =>
  [
    'operation' => 'act_version_envVars_post',
    'slug' => 'apify_act_version_env_vars_post',
    'class' => 'ApifyActVersionEnvVarsPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/versions/{versionNumber}/env-vars',
    'name' => 'Create environment variable',
    'description' => 'Execute official Apify API operation `act_version_envVars_post`.

Endpoint: POST /v2/acts/{actorId}/versions/{versionNumber}/env-vars.',
    'type' => 'write',
    'tag' => 'Actors/Actor versions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'versionNumber',
        'param' => 'version_number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor version.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  13 =>
  [
    'operation' => 'act_version_envVar_get',
    'slug' => 'apify_act_version_env_var_get',
    'class' => 'ApifyActVersionEnvVarGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/versions/{versionNumber}/env-vars/{envVarName}',
    'name' => 'Get environment variable',
    'description' => 'Execute official Apify API operation `act_version_envVar_get`.

Endpoint: GET /v2/acts/{actorId}/versions/{versionNumber}/env-vars/{envVarName}.',
    'type' => 'read',
    'tag' => 'Actors/Actor versions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'versionNumber',
        'param' => 'version_number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor version.',
      ],
      2 =>
      [
        'name' => 'envVarName',
        'param' => 'env_var_name',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the environment variable',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  14 =>
  [
    'operation' => 'act_version_envVar_put',
    'slug' => 'apify_act_version_env_var_put',
    'class' => 'ApifyActVersionEnvVarPut',
    'method' => 'PUT',
    'path' => '/v2/acts/{actorId}/versions/{versionNumber}/env-vars/{envVarName}',
    'name' => 'Update environment variable',
    'description' => 'Execute official Apify API operation `act_version_envVar_put`.

Endpoint: PUT /v2/acts/{actorId}/versions/{versionNumber}/env-vars/{envVarName}.',
    'type' => 'write',
    'tag' => 'Actors/Actor versions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'versionNumber',
        'param' => 'version_number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor version.',
      ],
      2 =>
      [
        'name' => 'envVarName',
        'param' => 'env_var_name',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the environment variable',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  15 =>
  [
    'operation' => 'act_version_envVar_post',
    'slug' => 'apify_act_version_env_var_post',
    'class' => 'ApifyActVersionEnvVarPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/versions/{versionNumber}/env-vars/{envVarName}',
    'name' => 'Update environment variable (POST)',
    'description' => 'Execute official Apify API operation `act_version_envVar_post`.

Endpoint: POST /v2/acts/{actorId}/versions/{versionNumber}/env-vars/{envVarName}.',
    'type' => 'write',
    'tag' => 'Actors/Actor versions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'versionNumber',
        'param' => 'version_number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor version.',
      ],
      2 =>
      [
        'name' => 'envVarName',
        'param' => 'env_var_name',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the environment variable',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  16 =>
  [
    'operation' => 'act_version_envVar_delete',
    'slug' => 'apify_act_version_env_var_delete',
    'class' => 'ApifyActVersionEnvVarDelete',
    'method' => 'DELETE',
    'path' => '/v2/acts/{actorId}/versions/{versionNumber}/env-vars/{envVarName}',
    'name' => 'Delete environment variable',
    'description' => 'Execute official Apify API operation `act_version_envVar_delete`.

Endpoint: DELETE /v2/acts/{actorId}/versions/{versionNumber}/env-vars/{envVarName}.',
    'type' => 'write',
    'tag' => 'Actors/Actor versions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'versionNumber',
        'param' => 'version_number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor version.',
      ],
      2 =>
      [
        'name' => 'envVarName',
        'param' => 'env_var_name',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the environment variable',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  17 =>
  [
    'operation' => 'act_webhooks_get',
    'slug' => 'apify_act_webhooks_get',
    'class' => 'ApifyActWebhooksGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/webhooks',
    'name' => 'Get list of webhooks',
    'description' => 'Execute official Apify API operation `act_webhooks_get`.

Endpoint: GET /v2/acts/{actorId}/webhooks.',
    'type' => 'read',
    'tag' => 'Actors/Webhook collection',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      3 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `createdAt` field in descending order. By default, they are sorted in ascending order.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  18 =>
  [
    'operation' => 'act_builds_get',
    'slug' => 'apify_act_builds_get',
    'class' => 'ApifyActBuildsGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/builds',
    'name' => 'Get list of builds',
    'description' => 'Execute official Apify API operation `act_builds_get`.

Endpoint: GET /v2/acts/{actorId}/builds.',
    'type' => 'read',
    'tag' => 'Actors/Actor builds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      3 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `startedAt` field in descending order. By default, they are sorted in ascending order.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  19 =>
  [
    'operation' => 'act_builds_post',
    'slug' => 'apify_act_builds_post',
    'class' => 'ApifyActBuildsPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/builds',
    'name' => 'Build Actor',
    'description' => 'Execute official Apify API operation `act_builds_post`.

Endpoint: POST /v2/acts/{actorId}/builds.',
    'type' => 'write',
    'tag' => 'Actors/Actor builds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'version',
        'param' => 'version',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor version number to be built.',
      ],
      2 =>
      [
        'name' => 'useCache',
        'param' => 'use_cache',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the system will use a cache to speed up the build process. By default, cache is not used.',
      ],
      3 =>
      [
        'name' => 'betaPackages',
        'param' => 'beta_packages',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the Actor is built with beta versions of Apify NPM packages. By default, the build uses `latest` packages.',
      ],
      4 =>
      [
        'name' => 'tag',
        'param' => 'tag',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Tag to be applied to the build on success. By default, the tag is taken from Actor version\'s `buildTag` property.',
      ],
      5 =>
      [
        'name' => 'waitForFinish',
        'param' => 'wait_for_finish',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'The maximum number of seconds the server waits for the build to finish. By default it is `0`, the maximum value is `60`. <!-- MAX_ACTOR_JOB_ASYNC_WAIT_SECS --> If the build fini...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  20 =>
  [
    'operation' => 'act_build_default_get',
    'slug' => 'apify_act_build_default_get',
    'class' => 'ApifyActBuildDefaultGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/builds/default',
    'name' => 'Get default build',
    'description' => 'Execute official Apify API operation `act_build_default_get`.

Endpoint: GET /v2/acts/{actorId}/builds/default.',
    'type' => 'read',
    'tag' => 'Actors/Actor builds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'waitForFinish',
        'param' => 'wait_for_finish',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'The maximum number of seconds the server waits for the build to finish. By default it is `0`, the maximum value is `60`. <!-- MAX_ACTOR_JOB_ASYNC_WAIT_SECS --> If the build fini...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  21 =>
  [
    'operation' => 'act_openapi_json_get',
    'slug' => 'apify_act_openapi_json_get',
    'class' => 'ApifyActOpenapiJsonGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/builds/{buildId}/openapi.json',
    'name' => 'Get OpenAPI definition',
    'description' => 'Execute official Apify API operation `act_openapi_json_get`.

Endpoint: GET /v2/acts/{actorId}/builds/{buildId}/openapi.json.',
    'type' => 'read',
    'tag' => 'Actors/Actor builds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'buildId',
        'param' => 'build_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the build, found in the build\'s Info tab. Use the special value `default` to get the OpenAPI schema for the Actor\'s default build.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  22 =>
  [
    'operation' => 'act_build_get',
    'slug' => 'apify_act_build_get',
    'class' => 'ApifyActBuildGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/builds/{buildId}',
    'name' => 'Get build',
    'description' => 'Execute official Apify API operation `act_build_get`.

Endpoint: GET /v2/acts/{actorId}/builds/{buildId}.',
    'type' => 'read',
    'tag' => 'Actors/Actor builds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'buildId',
        'param' => 'build_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the build, found in the build\'s Info tab.',
      ],
      2 =>
      [
        'name' => 'waitForFinish',
        'param' => 'wait_for_finish',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'The maximum number of seconds the server waits for the build to finish. By default it is `0`, the maximum value is `60`. <!-- MAX_ACTOR_JOB_ASYNC_WAIT_SECS --> If the build fini...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  23 =>
  [
    'operation' => 'act_build_abort_post',
    'slug' => 'apify_act_build_abort_post',
    'class' => 'ApifyActBuildAbortPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/builds/{buildId}/abort',
    'name' => 'Abort build',
    'description' => 'Execute official Apify API operation `act_build_abort_post`.

Endpoint: POST /v2/acts/{actorId}/builds/{buildId}/abort.',
    'type' => 'write',
    'tag' => 'Actors/Actor builds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'buildId',
        'param' => 'build_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the build, found in the build\'s Info tab.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  24 =>
  [
    'operation' => 'act_runs_get',
    'slug' => 'apify_act_runs_get',
    'class' => 'ApifyActRunsGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs',
    'name' => 'Get list of runs',
    'description' => 'Execute official Apify API operation `act_runs_get`.

Endpoint: GET /v2/acts/{actorId}/runs.',
    'type' => 'read',
    'tag' => 'Actors/Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      3 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `startedAt` field in descending order. By default, they are sorted in ascending order.',
      ],
      4 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Single status or comma-separated list of statuses, see ([available statuses](https://docs.apify.com/platform/actors/running/runs-and-builds#lifecycle)). Used to filter runs by t...',
      ],
      5 =>
      [
        'name' => 'startedAfter',
        'param' => 'started_after',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter runs that started after the specified date and time (inclusive). The value must be a valid ISO 8601 datetime string (UTC).',
      ],
      6 =>
      [
        'name' => 'startedBefore',
        'param' => 'started_before',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter runs that started before the specified date and time (inclusive). The value must be a valid ISO 8601 datetime string (UTC).',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  25 =>
  [
    'operation' => 'act_runs_post',
    'slug' => 'apify_act_runs_post',
    'class' => 'ApifyActRunsPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/runs',
    'name' => 'Run Actor',
    'description' => 'Execute official Apify API operation `act_runs_post`.

Endpoint: POST /v2/acts/{actorId}/runs.',
    'type' => 'write',
    'tag' => 'Actors/Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'timeout',
        'param' => 'timeout',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optional timeout for the run, in seconds. By default, the run uses the timeout from its configuration.',
      ],
      2 =>
      [
        'name' => 'memory',
        'param' => 'memory',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Memory limit for the run, in megabytes. The amount of memory can be set to a power of 2 with a minimum of 128. By default, the run uses the memory limit from its configuration.',
      ],
      3 =>
      [
        'name' => 'maxItems',
        'param' => 'max_items',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum number of dataset items that will be charged for pay-per-result Actors. This does NOT guarantee that the Actor will return only this many items. It only en...',
      ],
      4 =>
      [
        'name' => 'maxTotalChargeUsd',
        'param' => 'max_total_charge_usd',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum cost of the run. This parameter is useful for pay-per-event Actors, as it allows you to limit the amount charged to your subscription. You can access the m...',
      ],
      5 =>
      [
        'name' => 'restartOnError',
        'param' => 'restart_on_error',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Determines whether the run will be restarted if it fails.',
      ],
      6 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the Actor build to run. It can be either a build tag or build number. By default, the run uses the build from its configuration (typically `latest`).',
      ],
      7 =>
      [
        'name' => 'waitForFinish',
        'param' => 'wait_for_finish',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'The maximum number of seconds the server waits for the run to finish. By default it is `0`, the maximum value is `60`. <!-- MAX_ACTOR_JOB_ASYNC_WAIT_SECS --> If the run finishes...',
      ],
      8 =>
      [
        'name' => 'webhooks',
        'param' => 'webhooks',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies optional webhooks associated with the Actor run, which can be used to receive a notification e.g. when the Actor finished or failed. The value is a Base64-encoded JSON...',
      ],
      9 =>
      [
        'name' => 'forcePermissionLevel',
        'param' => 'force_permission_level',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides the Actor\'s permission level for this specific run. Use to test restricted permissions before deploying changes to your Actor or to temporarily elevate or restrict acc...',
      ],
      10 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  26 =>
  [
    'operation' => 'act_runSync_post',
    'slug' => 'apify_act_run_sync_post',
    'class' => 'ApifyActRunSyncPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/run-sync',
    'name' => 'Run Actor synchronously with input and return output',
    'description' => 'Execute official Apify API operation `act_runSync_post`.

Endpoint: POST /v2/acts/{actorId}/run-sync.',
    'type' => 'write',
    'tag' => 'Actors/Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'outputRecordKey',
        'param' => 'output_record_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Key of the record from run\'s default key-value store to be returned in the response. By default, it is `OUTPUT`.',
      ],
      2 =>
      [
        'name' => 'timeout',
        'param' => 'timeout',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optional timeout for the run, in seconds. By default, the run uses the timeout from its configuration.',
      ],
      3 =>
      [
        'name' => 'memory',
        'param' => 'memory',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Memory limit for the run, in megabytes. The amount of memory can be set to a power of 2 with a minimum of 128. By default, the run uses the memory limit from its configuration.',
      ],
      4 =>
      [
        'name' => 'maxItems',
        'param' => 'max_items',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum number of dataset items that will be charged for pay-per-result Actors. This does NOT guarantee that the Actor will return only this many items. It only en...',
      ],
      5 =>
      [
        'name' => 'maxTotalChargeUsd',
        'param' => 'max_total_charge_usd',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum cost of the run. This parameter is useful for pay-per-event Actors, as it allows you to limit the amount charged to your subscription. You can access the m...',
      ],
      6 =>
      [
        'name' => 'restartOnError',
        'param' => 'restart_on_error',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Determines whether the run will be restarted if it fails.',
      ],
      7 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the Actor build to run. It can be either a build tag or build number. By default, the run uses the build from its configuration (typically `latest`).',
      ],
      8 =>
      [
        'name' => 'webhooks',
        'param' => 'webhooks',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies optional webhooks associated with the Actor run, which can be used to receive a notification e.g. when the Actor finished or failed. The value is a Base64-encoded JSON...',
      ],
      9 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  27 =>
  [
    'operation' => 'act_runSync_get',
    'slug' => 'apify_act_run_sync_get',
    'class' => 'ApifyActRunSyncGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/run-sync',
    'name' => 'Without input',
    'description' => 'Execute official Apify API operation `act_runSync_get`.

Endpoint: GET /v2/acts/{actorId}/run-sync.',
    'type' => 'read',
    'tag' => 'Actors/Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'outputRecordKey',
        'param' => 'output_record_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Key of the record from run\'s default key-value store to be returned in the response. By default, it is `OUTPUT`.',
      ],
      2 =>
      [
        'name' => 'timeout',
        'param' => 'timeout',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optional timeout for the run, in seconds. By default, the run uses the timeout from its configuration.',
      ],
      3 =>
      [
        'name' => 'memory',
        'param' => 'memory',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Memory limit for the run, in megabytes. The amount of memory can be set to a power of 2 with a minimum of 128. By default, the run uses the memory limit from its configuration.',
      ],
      4 =>
      [
        'name' => 'maxItems',
        'param' => 'max_items',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum number of dataset items that will be charged for pay-per-result Actors. This does NOT guarantee that the Actor will return only this many items. It only en...',
      ],
      5 =>
      [
        'name' => 'maxTotalChargeUsd',
        'param' => 'max_total_charge_usd',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum cost of the run. This parameter is useful for pay-per-event Actors, as it allows you to limit the amount charged to your subscription. You can access the m...',
      ],
      6 =>
      [
        'name' => 'restartOnError',
        'param' => 'restart_on_error',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Determines whether the run will be restarted if it fails.',
      ],
      7 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the Actor build to run. It can be either a build tag or build number. By default, the run uses the build from its configuration (typically `latest`).',
      ],
      8 =>
      [
        'name' => 'webhooks',
        'param' => 'webhooks',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies optional webhooks associated with the Actor run, which can be used to receive a notification e.g. when the Actor finished or failed. The value is a Base64-encoded JSON...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  28 =>
  [
    'operation' => 'act_runSyncGetDatasetItems_post',
    'slug' => 'apify_act_run_sync_get_dataset_items_post',
    'class' => 'ApifyActRunSyncGetDatasetItemsPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/run-sync-get-dataset-items',
    'name' => 'Run Actor synchronously with input and get dataset items',
    'description' => 'Execute official Apify API operation `act_runSyncGetDatasetItems_post`.

Endpoint: POST /v2/acts/{actorId}/run-sync-get-dataset-items.',
    'type' => 'write',
    'tag' => 'Actors/Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'timeout',
        'param' => 'timeout',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optional timeout for the run, in seconds. By default, the run uses the timeout from its configuration.',
      ],
      2 =>
      [
        'name' => 'memory',
        'param' => 'memory',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Memory limit for the run, in megabytes. The amount of memory can be set to a power of 2 with a minimum of 128. By default, the run uses the memory limit from its configuration.',
      ],
      3 =>
      [
        'name' => 'maxItems',
        'param' => 'max_items',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum number of dataset items that will be charged for pay-per-result Actors. This does NOT guarantee that the Actor will return only this many items. It only en...',
      ],
      4 =>
      [
        'name' => 'maxTotalChargeUsd',
        'param' => 'max_total_charge_usd',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum cost of the run. This parameter is useful for pay-per-event Actors, as it allows you to limit the amount charged to your subscription. You can access the m...',
      ],
      5 =>
      [
        'name' => 'restartOnError',
        'param' => 'restart_on_error',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Determines whether the run will be restarted if it fails.',
      ],
      6 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the Actor build to run. It can be either a build tag or build number. By default, the run uses the build from its configuration (typically `latest`).',
      ],
      7 =>
      [
        'name' => 'webhooks',
        'param' => 'webhooks',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies optional webhooks associated with the Actor run, which can be used to receive a notification e.g. when the Actor finished or failed. The value is a Base64-encoded JSON...',
      ],
      8 =>
      [
        'name' => 'format',
        'param' => 'format',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Format of the results, possible values are: `json`, `jsonl`, `csv`, `html`, `xlsx`, `xml` and `rss`. The default value is `json`.',
      ],
      9 =>
      [
        'name' => 'clean',
        'param' => 'clean',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the API endpoint returns only non-empty items and skips hidden fields (i.e. fields starting with the # character). The `clean` parameter is just a shortcut...',
      ],
      10 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      11 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. By default there is no limit.',
      ],
      12 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be picked from the items, only these fields will remain in the resulting record objects. Note that the fields in the outputted item...',
      ],
      13 =>
      [
        'name' => 'omit',
        'param' => 'omit',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be omitted from the items.',
      ],
      14 =>
      [
        'name' => 'unwind',
        'param' => 'unwind',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be unwound, in order which they should be processed. Each field should be either an array or an object. If the field is an array th...',
      ],
      15 =>
      [
        'name' => 'flatten',
        'param' => 'flatten',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should transform nested objects into flat structures. For example, with `flatten="foo"` the object `{"foo":{"bar": "hello"}}` is turned in...',
      ],
      16 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'By default, results are returned in the same order as they were stored. To reverse the order, set this parameter to `true` or `1`.',
      ],
      17 =>
      [
        'name' => 'attachment',
        'param' => 'attachment',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the response will define the `Content-Disposition: attachment` header, forcing a web browser to download the file rather than to display it. By default thi...',
      ],
      18 =>
      [
        'name' => 'delimiter',
        'param' => 'delimiter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A delimiter character for CSV files, only used if `format=csv`. You might need to URL-encode the character (e.g. use `%09` for tab or `%3B` for semicolon). The default delimiter...',
      ],
      19 =>
      [
        'name' => 'bom',
        'param' => 'bom',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'All text responses are encoded in UTF-8 encoding. By default, the `format=csv` files are prefixed with the UTF-8 Byte Order Mark (BOM), while `json`, `jsonl`, `xml`, `html` and...',
      ],
      20 =>
      [
        'name' => 'xmlRoot',
        'param' => 'xml_root',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default root element name of `xml` output. By default the root element is `items`.',
      ],
      21 =>
      [
        'name' => 'xmlRow',
        'param' => 'xml_row',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default element name that wraps each page or page function result object in `xml` output. By default the element name is `item`.',
      ],
      22 =>
      [
        'name' => 'skipHeaderRow',
        'param' => 'skip_header_row',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then header row in the `csv` format is skipped.',
      ],
      23 =>
      [
        'name' => 'skipHidden',
        'param' => 'skip_hidden',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then hidden fields are skipped from the output, i.e. fields starting with the `#` character.',
      ],
      24 =>
      [
        'name' => 'skipEmpty',
        'param' => 'skip_empty',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then empty items are skipped from the output. Note that if used, the results might contain less items than the limit value.',
      ],
      25 =>
      [
        'name' => 'simplified',
        'param' => 'simplified',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the endpoint applies the `fields=url,pageFunctionResult,errorInfo` and `unwind=pageFunctionResult` query parameters. This feature is used to emulate simpl...',
      ],
      26 =>
      [
        'name' => 'view',
        'param' => 'view',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the view configuration for dataset items based on the schema definition. This parameter determines how the data will be filtered and presented. For complete specificatio...',
      ],
      27 =>
      [
        'name' => 'skipFailedPages',
        'param' => 'skip_failed_pages',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the all the items with errorInfo property will be skipped from the output. This feature is here to emulate functionality of API version 1 used for the leg...',
      ],
      28 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  29 =>
  [
    'operation' => 'act_runSyncGetDatasetItems_get',
    'slug' => 'apify_act_run_sync_get_dataset_items_get',
    'class' => 'ApifyActRunSyncGetDatasetItemsGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/run-sync-get-dataset-items',
    'name' => 'Run Actor synchronously without input and get dataset items',
    'description' => 'Execute official Apify API operation `act_runSyncGetDatasetItems_get`.

Endpoint: GET /v2/acts/{actorId}/run-sync-get-dataset-items.',
    'type' => 'read',
    'tag' => 'Actors/Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'timeout',
        'param' => 'timeout',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optional timeout for the run, in seconds. By default, the run uses the timeout from its configuration.',
      ],
      2 =>
      [
        'name' => 'memory',
        'param' => 'memory',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Memory limit for the run, in megabytes. The amount of memory can be set to a power of 2 with a minimum of 128. By default, the run uses the memory limit from its configuration.',
      ],
      3 =>
      [
        'name' => 'maxItems',
        'param' => 'max_items',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum number of dataset items that will be charged for pay-per-result Actors. This does NOT guarantee that the Actor will return only this many items. It only en...',
      ],
      4 =>
      [
        'name' => 'maxTotalChargeUsd',
        'param' => 'max_total_charge_usd',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum cost of the run. This parameter is useful for pay-per-event Actors, as it allows you to limit the amount charged to your subscription. You can access the m...',
      ],
      5 =>
      [
        'name' => 'restartOnError',
        'param' => 'restart_on_error',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Determines whether the run will be restarted if it fails.',
      ],
      6 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the Actor build to run. It can be either a build tag or build number. By default, the run uses the build from its configuration (typically `latest`).',
      ],
      7 =>
      [
        'name' => 'webhooks',
        'param' => 'webhooks',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies optional webhooks associated with the Actor run, which can be used to receive a notification e.g. when the Actor finished or failed. The value is a Base64-encoded JSON...',
      ],
      8 =>
      [
        'name' => 'format',
        'param' => 'format',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Format of the results, possible values are: `json`, `jsonl`, `csv`, `html`, `xlsx`, `xml` and `rss`. The default value is `json`.',
      ],
      9 =>
      [
        'name' => 'clean',
        'param' => 'clean',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the API endpoint returns only non-empty items and skips hidden fields (i.e. fields starting with the # character). The `clean` parameter is just a shortcut...',
      ],
      10 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      11 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. By default there is no limit.',
      ],
      12 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be picked from the items, only these fields will remain in the resulting record objects. Note that the fields in the outputted item...',
      ],
      13 =>
      [
        'name' => 'omit',
        'param' => 'omit',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be omitted from the items.',
      ],
      14 =>
      [
        'name' => 'unwind',
        'param' => 'unwind',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be unwound, in order which they should be processed. Each field should be either an array or an object. If the field is an array th...',
      ],
      15 =>
      [
        'name' => 'flatten',
        'param' => 'flatten',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should transform nested objects into flat structures. For example, with `flatten="foo"` the object `{"foo":{"bar": "hello"}}` is turned in...',
      ],
      16 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'By default, results are returned in the same order as they were stored. To reverse the order, set this parameter to `true` or `1`.',
      ],
      17 =>
      [
        'name' => 'attachment',
        'param' => 'attachment',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the response will define the `Content-Disposition: attachment` header, forcing a web browser to download the file rather than to display it. By default thi...',
      ],
      18 =>
      [
        'name' => 'delimiter',
        'param' => 'delimiter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A delimiter character for CSV files, only used if `format=csv`. You might need to URL-encode the character (e.g. use `%09` for tab or `%3B` for semicolon). The default delimiter...',
      ],
      19 =>
      [
        'name' => 'bom',
        'param' => 'bom',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'All text responses are encoded in UTF-8 encoding. By default, the `format=csv` files are prefixed with the UTF-8 Byte Order Mark (BOM), while `json`, `jsonl`, `xml`, `html` and...',
      ],
      20 =>
      [
        'name' => 'xmlRoot',
        'param' => 'xml_root',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default root element name of `xml` output. By default the root element is `items`.',
      ],
      21 =>
      [
        'name' => 'xmlRow',
        'param' => 'xml_row',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default element name that wraps each page or page function result object in `xml` output. By default the element name is `item`.',
      ],
      22 =>
      [
        'name' => 'skipHeaderRow',
        'param' => 'skip_header_row',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then header row in the `csv` format is skipped.',
      ],
      23 =>
      [
        'name' => 'skipHidden',
        'param' => 'skip_hidden',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then hidden fields are skipped from the output, i.e. fields starting with the `#` character.',
      ],
      24 =>
      [
        'name' => 'skipEmpty',
        'param' => 'skip_empty',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then empty items are skipped from the output. Note that if used, the results might contain less items than the limit value.',
      ],
      25 =>
      [
        'name' => 'simplified',
        'param' => 'simplified',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the endpoint applies the `fields=url,pageFunctionResult,errorInfo` and `unwind=pageFunctionResult` query parameters. This feature is used to emulate simpl...',
      ],
      26 =>
      [
        'name' => 'view',
        'param' => 'view',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the view configuration for dataset items based on the schema definition. This parameter determines how the data will be filtered and presented. For complete specificatio...',
      ],
      27 =>
      [
        'name' => 'skipFailedPages',
        'param' => 'skip_failed_pages',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the all the items with errorInfo property will be skipped from the output. This feature is here to emulate functionality of API version 1 used for the leg...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  30 =>
  [
    'operation' => 'act_validateInput_post',
    'slug' => 'apify_act_validate_input_post',
    'class' => 'ApifyActValidateInputPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/validate-input',
    'name' => 'Validate Actor input',
    'description' => 'Execute official Apify API operation `act_validateInput_post`.

Endpoint: POST /v2/acts/{actorId}/validate-input.',
    'type' => 'write',
    'tag' => 'Actors',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional tag or number of the Actor build to use for input schema validation. By default, the `latest` build tag is used.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  31 =>
  [
    'operation' => 'act_run_resurrect_post',
    'slug' => 'apify_act_run_resurrect_post',
    'class' => 'ApifyActRunResurrectPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/runs/{runId}/resurrect',
    'name' => 'Resurrect run',
    'description' => 'Execute official Apify API operation `act_run_resurrect_post`.

Endpoint: POST /v2/acts/{actorId}/runs/{runId}/resurrect.',
    'type' => 'write',
    'tag' => 'Actors/Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      2 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the Actor build to run. It can be either a build tag or build number. By default, the run is resurrected with the same build it originally used. Specifically, if a run...',
      ],
      3 =>
      [
        'name' => 'timeout',
        'param' => 'timeout',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optional timeout for the run, in seconds. By default, the run uses the timeout specified in the run that is being resurrected.',
      ],
      4 =>
      [
        'name' => 'memory',
        'param' => 'memory',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Memory limit for the run, in megabytes. The amount of memory can be set to a power of 2 with a minimum of 128. By default, the run uses the memory limit specified in the run tha...',
      ],
      5 =>
      [
        'name' => 'restartOnError',
        'param' => 'restart_on_error',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Determines whether the resurrected run will be restarted if it fails. By default, the resurrected run uses the same setting as before.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  32 =>
  [
    'operation' => 'act_runs_last_get',
    'slug' => 'apify_act_runs_last_get',
    'class' => 'ApifyActRunsLastGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last',
    'name' => 'Get last run',
    'description' => 'Execute official Apify API operation `act_runs_last_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last.',
    'type' => 'read',
    'tag' => 'Actors/Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'waitForFinish',
        'param' => 'wait_for_finish',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'The maximum number of seconds the server waits for the run to finish. By default it is `0`, the maximum value is `60`. <!-- MAX_ACTOR_JOB_ASYNC_WAIT_SECS --> If the run finishes...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  33 =>
  [
    'operation' => 'act_runs_last_dataset_get',
    'slug' => 'apify_act_runs_last_dataset_get',
    'class' => 'ApifyActRunsLastDatasetGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last/dataset',
    'name' => 'Get last run\'s default dataset',
    'description' => 'Execute official Apify API operation `act_runs_last_dataset_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last/dataset.',
    'type' => 'read',
    'tag' => 'Last Actor run\'s default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  34 =>
  [
    'operation' => 'act_runs_last_dataset_put',
    'slug' => 'apify_act_runs_last_dataset_put',
    'class' => 'ApifyActRunsLastDatasetPut',
    'method' => 'PUT',
    'path' => '/v2/acts/{actorId}/runs/last/dataset',
    'name' => 'Update last run\'s default dataset',
    'description' => 'Execute official Apify API operation `act_runs_last_dataset_put`.

Endpoint: PUT /v2/acts/{actorId}/runs/last/dataset.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  35 =>
  [
    'operation' => 'act_runs_last_dataset_delete',
    'slug' => 'apify_act_runs_last_dataset_delete',
    'class' => 'ApifyActRunsLastDatasetDelete',
    'method' => 'DELETE',
    'path' => '/v2/acts/{actorId}/runs/last/dataset',
    'name' => 'Delete last run\'s default dataset',
    'description' => 'Execute official Apify API operation `act_runs_last_dataset_delete`.

Endpoint: DELETE /v2/acts/{actorId}/runs/last/dataset.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  36 =>
  [
    'operation' => 'act_runs_last_dataset_items_get',
    'slug' => 'apify_act_runs_last_dataset_items_get',
    'class' => 'ApifyActRunsLastDatasetItemsGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last/dataset/items',
    'name' => 'Get last run\'s dataset items',
    'description' => 'Execute official Apify API operation `act_runs_last_dataset_items_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last/dataset/items.',
    'type' => 'read',
    'tag' => 'Last Actor run\'s default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'format',
        'param' => 'format',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Format of the results, possible values are: `json`, `jsonl`, `csv`, `html`, `xlsx`, `xml` and `rss`. The default value is `json`.',
      ],
      3 =>
      [
        'name' => 'clean',
        'param' => 'clean',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the API endpoint returns only non-empty items and skips hidden fields (i.e. fields starting with the # character). The `clean` parameter is just a shortcut...',
      ],
      4 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      5 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. By default there is no limit.',
      ],
      6 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be picked from the items, only these fields will remain in the resulting record objects. Note that the fields in the outputted item...',
      ],
      7 =>
      [
        'name' => 'omit',
        'param' => 'omit',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be omitted from the items.',
      ],
      8 =>
      [
        'name' => 'unwind',
        'param' => 'unwind',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be unwound, in order which they should be processed. Each field should be either an array or an object. If the field is an array th...',
      ],
      9 =>
      [
        'name' => 'flatten',
        'param' => 'flatten',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should transform nested objects into flat structures. For example, with `flatten="foo"` the object `{"foo":{"bar": "hello"}}` is turned in...',
      ],
      10 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'By default, results are returned in the same order as they were stored. To reverse the order, set this parameter to `true` or `1`.',
      ],
      11 =>
      [
        'name' => 'attachment',
        'param' => 'attachment',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the response will define the `Content-Disposition: attachment` header, forcing a web browser to download the file rather than to display it. By default thi...',
      ],
      12 =>
      [
        'name' => 'delimiter',
        'param' => 'delimiter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A delimiter character for CSV files, only used if `format=csv`. You might need to URL-encode the character (e.g. use `%09` for tab or `%3B` for semicolon). The default delimiter...',
      ],
      13 =>
      [
        'name' => 'bom',
        'param' => 'bom',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'All text responses are encoded in UTF-8 encoding. By default, the `format=csv` files are prefixed with the UTF-8 Byte Order Mark (BOM), while `json`, `jsonl`, `xml`, `html` and...',
      ],
      14 =>
      [
        'name' => 'xmlRoot',
        'param' => 'xml_root',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default root element name of `xml` output. By default the root element is `items`.',
      ],
      15 =>
      [
        'name' => 'xmlRow',
        'param' => 'xml_row',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default element name that wraps each page or page function result object in `xml` output. By default the element name is `item`.',
      ],
      16 =>
      [
        'name' => 'skipHeaderRow',
        'param' => 'skip_header_row',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then header row in the `csv` format is skipped.',
      ],
      17 =>
      [
        'name' => 'skipHidden',
        'param' => 'skip_hidden',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then hidden fields are skipped from the output, i.e. fields starting with the `#` character.',
      ],
      18 =>
      [
        'name' => 'skipEmpty',
        'param' => 'skip_empty',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then empty items are skipped from the output. Note that if used, the results might contain less items than the limit value.',
      ],
      19 =>
      [
        'name' => 'simplified',
        'param' => 'simplified',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the endpoint applies the `fields=url,pageFunctionResult,errorInfo` and `unwind=pageFunctionResult` query parameters. This feature is used to emulate simpl...',
      ],
      20 =>
      [
        'name' => 'view',
        'param' => 'view',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the view configuration for dataset items based on the schema definition. This parameter determines how the data will be filtered and presented. For complete specificatio...',
      ],
      21 =>
      [
        'name' => 'skipFailedPages',
        'param' => 'skip_failed_pages',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the all the items with errorInfo property will be skipped from the output. This feature is here to emulate functionality of API version 1 used for the leg...',
      ],
      22 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  37 =>
  [
    'operation' => 'act_runs_last_dataset_items_post',
    'slug' => 'apify_act_runs_last_dataset_items_post',
    'class' => 'ApifyActRunsLastDatasetItemsPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/runs/last/dataset/items',
    'name' => 'Store items in last run\'s dataset',
    'description' => 'Execute official Apify API operation `act_runs_last_dataset_items_post`.

Endpoint: POST /v2/acts/{actorId}/runs/last/dataset/items.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  38 =>
  [
    'operation' => 'act_runs_last_dataset_statistics_get',
    'slug' => 'apify_act_runs_last_dataset_statistics_get',
    'class' => 'ApifyActRunsLastDatasetStatisticsGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last/dataset/statistics',
    'name' => 'Get last run\'s dataset statistics',
    'description' => 'Execute official Apify API operation `act_runs_last_dataset_statistics_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last/dataset/statistics.',
    'type' => 'read',
    'tag' => 'Last Actor run\'s default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  39 =>
  [
    'operation' => 'act_runs_last_keyValueStore_get',
    'slug' => 'apify_act_runs_last_key_value_store_get',
    'class' => 'ApifyActRunsLastKeyValueStoreGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last/key-value-store',
    'name' => 'Get last run\'s default store',
    'description' => 'Execute official Apify API operation `act_runs_last_keyValueStore_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last/key-value-store.',
    'type' => 'read',
    'tag' => 'Last Actor run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  40 =>
  [
    'operation' => 'act_runs_last_keyValueStore_put',
    'slug' => 'apify_act_runs_last_key_value_store_put',
    'class' => 'ApifyActRunsLastKeyValueStorePut',
    'method' => 'PUT',
    'path' => '/v2/acts/{actorId}/runs/last/key-value-store',
    'name' => 'Update last run\'s default store',
    'description' => 'Execute official Apify API operation `act_runs_last_keyValueStore_put`.

Endpoint: PUT /v2/acts/{actorId}/runs/last/key-value-store.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  41 =>
  [
    'operation' => 'act_runs_last_keyValueStore_delete',
    'slug' => 'apify_act_runs_last_key_value_store_delete',
    'class' => 'ApifyActRunsLastKeyValueStoreDelete',
    'method' => 'DELETE',
    'path' => '/v2/acts/{actorId}/runs/last/key-value-store',
    'name' => 'Delete last run\'s default store',
    'description' => 'Execute official Apify API operation `act_runs_last_keyValueStore_delete`.

Endpoint: DELETE /v2/acts/{actorId}/runs/last/key-value-store.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  42 =>
  [
    'operation' => 'act_runs_last_keyValueStore_keys_get',
    'slug' => 'apify_act_runs_last_key_value_store_keys_get',
    'class' => 'ApifyActRunsLastKeyValueStoreKeysGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last/key-value-store/keys',
    'name' => 'Get last run\'s default store\'s list of keys',
    'description' => 'Execute official Apify API operation `act_runs_last_keyValueStore_keys_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last/key-value-store/keys.',
    'type' => 'read',
    'tag' => 'Last Actor run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'exclusiveStartKey',
        'param' => 'exclusive_start_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'All keys up to this one (including) are skipped from the result.',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of keys to be returned. Maximum value is `1000`.',
      ],
      4 =>
      [
        'name' => 'collection',
        'param' => 'collection',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limit the results to keys that belong to a specific collection from the key-value store schema. The key-value store need to have a schema defined for this parameter to work.',
      ],
      5 =>
      [
        'name' => 'prefix',
        'param' => 'prefix',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limit the results to keys that start with a specific prefix.',
      ],
      6 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  43 =>
  [
    'operation' => 'act_runs_last_keyValueStore_records_get',
    'slug' => 'apify_act_runs_last_key_value_store_records_get',
    'class' => 'ApifyActRunsLastKeyValueStoreRecordsGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last/key-value-store/records',
    'name' => 'Download last run\'s default store\'s records',
    'description' => 'Execute official Apify API operation `act_runs_last_keyValueStore_records_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last/key-value-store/records.',
    'type' => 'read',
    'tag' => 'Last Actor run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'collection',
        'param' => 'collection',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If specified, only records belonging to a specific collection from the key-value store schema. The key-value store need to have a schema defined for this parameter to work.',
      ],
      3 =>
      [
        'name' => 'prefix',
        'param' => 'prefix',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If specified, only records whose key starts with the given prefix are included in the archive.',
      ],
      4 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  44 =>
  [
    'operation' => 'act_runs_last_keyValueStore_record_get',
    'slug' => 'apify_act_runs_last_key_value_store_record_get',
    'class' => 'ApifyActRunsLastKeyValueStoreRecordGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last/key-value-store/records/{recordKey}',
    'name' => 'Get last run\'s default store\'s record',
    'description' => 'Execute official Apify API operation `act_runs_last_keyValueStore_record_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last/key-value-store/records/{recordKey}.',
    'type' => 'read',
    'tag' => 'Last Actor run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
      3 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
      4 =>
      [
        'name' => 'attachment',
        'param' => 'attachment',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the response will be served with `Content-Disposition: attachment` header, causing web browsers to offer downloading HTML records instead of displaying them.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  45 =>
  [
    'operation' => 'act_runs_last_keyValueStore_record_put',
    'slug' => 'apify_act_runs_last_key_value_store_record_put',
    'class' => 'ApifyActRunsLastKeyValueStoreRecordPut',
    'method' => 'PUT',
    'path' => '/v2/acts/{actorId}/runs/last/key-value-store/records/{recordKey}',
    'name' => 'Store record in last run\'s default store',
    'description' => 'Execute official Apify API operation `act_runs_last_keyValueStore_record_put`.

Endpoint: PUT /v2/acts/{actorId}/runs/last/key-value-store/records/{recordKey}.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  46 =>
  [
    'operation' => 'act_runs_last_keyValueStore_record_post',
    'slug' => 'apify_act_runs_last_key_value_store_record_post',
    'class' => 'ApifyActRunsLastKeyValueStoreRecordPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/runs/last/key-value-store/records/{recordKey}',
    'name' => 'Store record in last run\'s default store (POST)',
    'description' => 'Execute official Apify API operation `act_runs_last_keyValueStore_record_post`.

Endpoint: POST /v2/acts/{actorId}/runs/last/key-value-store/records/{recordKey}.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  47 =>
  [
    'operation' => 'act_runs_last_keyValueStore_record_delete',
    'slug' => 'apify_act_runs_last_key_value_store_record_delete',
    'class' => 'ApifyActRunsLastKeyValueStoreRecordDelete',
    'method' => 'DELETE',
    'path' => '/v2/acts/{actorId}/runs/last/key-value-store/records/{recordKey}',
    'name' => 'Delete last run\'s default store\'s record',
    'description' => 'Execute official Apify API operation `act_runs_last_keyValueStore_record_delete`.

Endpoint: DELETE /v2/acts/{actorId}/runs/last/key-value-store/records/{recordKey}.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  48 =>
  [
    'operation' => 'act_runs_last_requestQueue_get',
    'slug' => 'apify_act_runs_last_request_queue_get',
    'class' => 'ApifyActRunsLastRequestQueueGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue',
    'name' => 'Get last run\'s default request queue',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last/request-queue.',
    'type' => 'read',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  49 =>
  [
    'operation' => 'act_runs_last_requestQueue_put',
    'slug' => 'apify_act_runs_last_request_queue_put',
    'class' => 'ApifyActRunsLastRequestQueuePut',
    'method' => 'PUT',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue',
    'name' => 'Update last run\'s default request queue',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_put`.

Endpoint: PUT /v2/acts/{actorId}/runs/last/request-queue.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  50 =>
  [
    'operation' => 'act_runs_last_requestQueue_delete',
    'slug' => 'apify_act_runs_last_request_queue_delete',
    'class' => 'ApifyActRunsLastRequestQueueDelete',
    'method' => 'DELETE',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue',
    'name' => 'Delete last run\'s default request queue',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_delete`.

Endpoint: DELETE /v2/acts/{actorId}/runs/last/request-queue.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  51 =>
  [
    'operation' => 'act_runs_last_requestQueue_requests_get',
    'slug' => 'apify_act_runs_last_request_queue_requests_get',
    'class' => 'ApifyActRunsLastRequestQueueRequestsGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue/requests',
    'name' => 'List last run\'s default request queue\'s requests',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_requests_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last/request-queue/requests.',
    'type' => 'read',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      3 =>
      [
        'name' => 'exclusiveStartId',
        'param' => 'exclusive_start_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'All requests up to this one (including) are skipped from the result. (Deprecated, use `cursor` instead.)',
      ],
      4 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of keys to be returned. Maximum value is `10000`.',
      ],
      5 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A cursor string for pagination, returned in the previous response as `nextCursor`. Use this to retrieve the next page of requests.',
      ],
      6 =>
      [
        'name' => 'filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Filter requests by their state. Possible values are `locked` and `pending`. You can combine multiple values separated by commas, which will mean the union of these filters - r...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  52 =>
  [
    'operation' => 'act_runs_last_requestQueue_requests_post',
    'slug' => 'apify_act_runs_last_request_queue_requests_post',
    'class' => 'ApifyActRunsLastRequestQueueRequestsPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue/requests',
    'name' => 'Add request to last run\'s default request queue',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_requests_post`.

Endpoint: POST /v2/acts/{actorId}/runs/last/request-queue/requests.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      3 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end. Default value is `false` (end of queue).',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  53 =>
  [
    'operation' => 'act_runs_last_requestQueue_requests_batch_post',
    'slug' => 'apify_act_runs_last_request_queue_requests_batch_post',
    'class' => 'ApifyActRunsLastRequestQueueRequestsBatchPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue/requests/batch',
    'name' => 'Batch add requests to last run\'s default request queue',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_requests_batch_post`.

Endpoint: POST /v2/acts/{actorId}/runs/last/request-queue/requests/batch.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      3 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end. Default value is `false` (end of queue).',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  54 =>
  [
    'operation' => 'act_runs_last_requestQueue_requests_batch_delete',
    'slug' => 'apify_act_runs_last_request_queue_requests_batch_delete',
    'class' => 'ApifyActRunsLastRequestQueueRequestsBatchDelete',
    'method' => 'DELETE',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue/requests/batch',
    'name' => 'Batch delete requests from last run\'s default request queue',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_requests_batch_delete`.

Endpoint: DELETE /v2/acts/{actorId}/runs/last/request-queue/requests/batch.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  55 =>
  [
    'operation' => 'act_runs_last_requestQueue_requests_unlock_post',
    'slug' => 'apify_act_runs_last_request_queue_requests_unlock_post',
    'class' => 'ApifyActRunsLastRequestQueueRequestsUnlockPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue/requests/unlock',
    'name' => 'Unlock requests in last run\'s default request queue',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_requests_unlock_post`.

Endpoint: POST /v2/acts/{actorId}/runs/last/request-queue/requests/unlock.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  56 =>
  [
    'operation' => 'act_runs_last_requestQueue_request_get',
    'slug' => 'apify_act_runs_last_request_queue_request_get',
    'class' => 'ApifyActRunsLastRequestQueueRequestGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue/requests/{requestId}',
    'name' => 'Get request from last run\'s default request queue',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_request_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last/request-queue/requests/{requestId}.',
    'type' => 'read',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  57 =>
  [
    'operation' => 'act_runs_last_requestQueue_request_put',
    'slug' => 'apify_act_runs_last_request_queue_request_put',
    'class' => 'ApifyActRunsLastRequestQueueRequestPut',
    'method' => 'PUT',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue/requests/{requestId}',
    'name' => 'Update request in last run\'s default request queue',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_request_put`.

Endpoint: PUT /v2/acts/{actorId}/runs/last/request-queue/requests/{requestId}.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      3 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end. Default value is `false` (end of queue).',
      ],
      4 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      5 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  58 =>
  [
    'operation' => 'act_runs_last_requestQueue_request_delete',
    'slug' => 'apify_act_runs_last_request_queue_request_delete',
    'class' => 'ApifyActRunsLastRequestQueueRequestDelete',
    'method' => 'DELETE',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue/requests/{requestId}',
    'name' => 'Delete request from last run\'s default request queue',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_request_delete`.

Endpoint: DELETE /v2/acts/{actorId}/runs/last/request-queue/requests/{requestId}.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      3 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  59 =>
  [
    'operation' => 'act_runs_last_requestQueue_request_lock_put',
    'slug' => 'apify_act_runs_last_request_queue_request_lock_put',
    'class' => 'ApifyActRunsLastRequestQueueRequestLockPut',
    'method' => 'PUT',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue/requests/{requestId}/lock',
    'name' => 'Prolong lock on request in last run\'s default request queue',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_request_lock_put`.

Endpoint: PUT /v2/acts/{actorId}/runs/last/request-queue/requests/{requestId}/lock.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      3 =>
      [
        'name' => 'lockSecs',
        'param' => 'lock_secs',
        'in' => 'query',
        'type' => 'number',
        'required' => true,
        'description' => 'How long the requests will be locked for (in seconds).',
      ],
      4 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      5 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end after lock expires.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  60 =>
  [
    'operation' => 'act_runs_last_requestQueue_request_lock_delete',
    'slug' => 'apify_act_runs_last_request_queue_request_lock_delete',
    'class' => 'ApifyActRunsLastRequestQueueRequestLockDelete',
    'method' => 'DELETE',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue/requests/{requestId}/lock',
    'name' => 'Delete lock on request in last run\'s default request queue',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_request_lock_delete`.

Endpoint: DELETE /v2/acts/{actorId}/runs/last/request-queue/requests/{requestId}/lock.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      3 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      4 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end after lock was removed.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  61 =>
  [
    'operation' => 'act_runs_last_requestQueue_head_get',
    'slug' => 'apify_act_runs_last_request_queue_head_get',
    'class' => 'ApifyActRunsLastRequestQueueHeadGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue/head',
    'name' => 'Get last run\'s default request queue head',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_head_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last/request-queue/head.',
    'type' => 'read',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'How many items from queue should be returned.',
      ],
      3 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  62 =>
  [
    'operation' => 'act_runs_last_requestQueue_head_lock_post',
    'slug' => 'apify_act_runs_last_request_queue_head_lock_post',
    'class' => 'ApifyActRunsLastRequestQueueHeadLockPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/runs/last/request-queue/head/lock',
    'name' => 'Get and lock last run\'s default request queue head',
    'description' => 'Execute official Apify API operation `act_runs_last_requestQueue_head_lock_post`.

Endpoint: POST /v2/acts/{actorId}/runs/last/request-queue/head/lock.',
    'type' => 'write',
    'tag' => 'Last Actor run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'lockSecs',
        'param' => 'lock_secs',
        'in' => 'query',
        'type' => 'number',
        'required' => true,
        'description' => 'How long the requests will be locked for (in seconds).',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'How many items from the queue should be returned.',
      ],
      4 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  63 =>
  [
    'operation' => 'act_runs_last_log_get',
    'slug' => 'apify_act_runs_last_log_get',
    'class' => 'ApifyActRunsLastLogGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/last/log',
    'name' => 'Get last Actor run\'s log',
    'description' => 'Execute official Apify API operation `act_runs_last_log_get`.

Endpoint: GET /v2/acts/{actorId}/runs/last/log.',
    'type' => 'read',
    'tag' => 'Last Actor run\'s log',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'stream',
        'param' => 'stream',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the logs will be streamed as long as the run or build is running.',
      ],
      2 =>
      [
        'name' => 'download',
        'param' => 'download',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the web browser will download the log file rather than open it in a tab.',
      ],
      3 =>
      [
        'name' => 'raw',
        'param' => 'raw',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the logs will be kept verbatim. By default, the API removes ANSI escape codes from the logs, keeping only printable characters.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  64 =>
  [
    'operation' => 'act_run_get',
    'slug' => 'apify_act_run_get',
    'class' => 'ApifyActRunGet',
    'method' => 'GET',
    'path' => '/v2/acts/{actorId}/runs/{runId}',
    'name' => 'Get run',
    'description' => 'Execute official Apify API operation `act_run_get`.

Endpoint: GET /v2/acts/{actorId}/runs/{runId}.',
    'type' => 'read',
    'tag' => 'Actors/Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      2 =>
      [
        'name' => 'waitForFinish',
        'param' => 'wait_for_finish',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'The maximum number of seconds the server waits for the run to finish. By default it is `0`, the maximum value is `60`. <!-- MAX_ACTOR_JOB_ASYNC_WAIT_SECS --> If the run finishes...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  65 =>
  [
    'operation' => 'act_run_abort_post',
    'slug' => 'apify_act_run_abort_post',
    'class' => 'ApifyActRunAbortPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/runs/{runId}/abort',
    'name' => 'Abort run',
    'description' => 'Execute official Apify API operation `act_run_abort_post`.

Endpoint: POST /v2/acts/{actorId}/runs/{runId}/abort.',
    'type' => 'write',
    'tag' => 'Actors/Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      2 =>
      [
        'name' => 'gracefully',
        'param' => 'gracefully',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If true passed, the Actor run will abort gracefully. It will send `aborting` and `persistState` event into run and force-stop the run after 30 seconds. It is helpful in cases wh...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  66 =>
  [
    'operation' => 'act_run_metamorph_post',
    'slug' => 'apify_act_run_metamorph_post',
    'class' => 'ApifyActRunMetamorphPost',
    'method' => 'POST',
    'path' => '/v2/acts/{actorId}/runs/{runId}/metamorph',
    'name' => 'Metamorph run',
    'description' => 'Execute official Apify API operation `act_run_metamorph_post`.

Endpoint: POST /v2/acts/{actorId}/runs/{runId}/metamorph.',
    'type' => 'write',
    'tag' => 'Actors/Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorId',
        'param' => 'actor_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor ID or a tilde-separated owner\'s username and Actor name.',
      ],
      1 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      2 =>
      [
        'name' => 'targetActorId',
        'param' => 'target_actor_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of a target Actor that the run should be transformed into.',
      ],
      3 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional build of the target Actor. It can be either a build tag or build number. By default, the run uses the build specified in the default run configuration for the target Ac...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  67 =>
  [
    'operation' => 'actorTasks_get',
    'slug' => 'apify_actor_tasks_get',
    'class' => 'ApifyActorTasksGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks',
    'name' => 'Get list of tasks',
    'description' => 'Execute official Apify API operation `actorTasks_get`.

Endpoint: GET /v2/actor-tasks.',
    'type' => 'read',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      2 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `createdAt` field in descending order. By default, they are sorted in ascending order.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  68 =>
  [
    'operation' => 'actorTasks_post',
    'slug' => 'apify_actor_tasks_post',
    'class' => 'ApifyActorTasksPost',
    'method' => 'POST',
    'path' => '/v2/actor-tasks',
    'name' => 'Create task',
    'description' => 'Execute official Apify API operation `actorTasks_post`.

Endpoint: POST /v2/actor-tasks.',
    'type' => 'write',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  69 =>
  [
    'operation' => 'actorTask_get',
    'slug' => 'apify_actor_task_get',
    'class' => 'ApifyActorTaskGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}',
    'name' => 'Get task',
    'description' => 'Execute official Apify API operation `actorTask_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}.',
    'type' => 'read',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  70 =>
  [
    'operation' => 'actorTask_put',
    'slug' => 'apify_actor_task_put',
    'class' => 'ApifyActorTaskPut',
    'method' => 'PUT',
    'path' => '/v2/actor-tasks/{actorTaskId}',
    'name' => 'Update task',
    'description' => 'Execute official Apify API operation `actorTask_put`.

Endpoint: PUT /v2/actor-tasks/{actorTaskId}.',
    'type' => 'write',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  71 =>
  [
    'operation' => 'actorTask_delete',
    'slug' => 'apify_actor_task_delete',
    'class' => 'ApifyActorTaskDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-tasks/{actorTaskId}',
    'name' => 'Delete task',
    'description' => 'Execute official Apify API operation `actorTask_delete`.

Endpoint: DELETE /v2/actor-tasks/{actorTaskId}.',
    'type' => 'write',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  72 =>
  [
    'operation' => 'actorTask_input_get',
    'slug' => 'apify_actor_task_input_get',
    'class' => 'ApifyActorTaskInputGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/input',
    'name' => 'Get task input',
    'description' => 'Execute official Apify API operation `actorTask_input_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/input.',
    'type' => 'read',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  73 =>
  [
    'operation' => 'actorTask_input_put',
    'slug' => 'apify_actor_task_input_put',
    'class' => 'ApifyActorTaskInputPut',
    'method' => 'PUT',
    'path' => '/v2/actor-tasks/{actorTaskId}/input',
    'name' => 'Update task input',
    'description' => 'Execute official Apify API operation `actorTask_input_put`.

Endpoint: PUT /v2/actor-tasks/{actorTaskId}/input.',
    'type' => 'write',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  74 =>
  [
    'operation' => 'actorTask_webhooks_get',
    'slug' => 'apify_actor_task_webhooks_get',
    'class' => 'ApifyActorTaskWebhooksGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/webhooks',
    'name' => 'Get list of webhooks',
    'description' => 'Execute official Apify API operation `actorTask_webhooks_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/webhooks.',
    'type' => 'read',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      3 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `createdAt` field in descending order. By default, they are sorted in ascending order.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  75 =>
  [
    'operation' => 'actorTask_runs_get',
    'slug' => 'apify_actor_task_runs_get',
    'class' => 'ApifyActorTaskRunsGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs',
    'name' => 'Get list of task runs',
    'description' => 'Execute official Apify API operation `actorTask_runs_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs.',
    'type' => 'read',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      3 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `startedAt` field in descending order. By default, they are sorted in ascending order.',
      ],
      4 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Single status or comma-separated list of statuses, see ([available statuses](https://docs.apify.com/platform/actors/running/runs-and-builds#lifecycle)). Used to filter runs by t...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  76 =>
  [
    'operation' => 'actorTask_runs_post',
    'slug' => 'apify_actor_task_runs_post',
    'class' => 'ApifyActorTaskRunsPost',
    'method' => 'POST',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs',
    'name' => 'Run task',
    'description' => 'Execute official Apify API operation `actorTask_runs_post`.

Endpoint: POST /v2/actor-tasks/{actorTaskId}/runs.',
    'type' => 'write',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'timeout',
        'param' => 'timeout',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optional timeout for the run, in seconds. By default, the run uses the timeout from its configuration.',
      ],
      2 =>
      [
        'name' => 'memory',
        'param' => 'memory',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Memory limit for the run, in megabytes. The amount of memory can be set to a power of 2 with a minimum of 128. By default, the run uses the memory limit from its configuration.',
      ],
      3 =>
      [
        'name' => 'maxItems',
        'param' => 'max_items',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum number of dataset items that will be charged for pay-per-result Actors. This does NOT guarantee that the Actor will return only this many items. It only en...',
      ],
      4 =>
      [
        'name' => 'maxTotalChargeUsd',
        'param' => 'max_total_charge_usd',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum cost of the run. This parameter is useful for pay-per-event Actors, as it allows you to limit the amount charged to your subscription. You can access the m...',
      ],
      5 =>
      [
        'name' => 'restartOnError',
        'param' => 'restart_on_error',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Determines whether the run will be restarted if it fails.',
      ],
      6 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the Actor build to run. It can be either a build tag or build number. By default, the run uses the build from its configuration (typically `latest`).',
      ],
      7 =>
      [
        'name' => 'waitForFinish',
        'param' => 'wait_for_finish',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'The maximum number of seconds the server waits for the run to finish. By default it is `0`, the maximum value is `60`. <!-- MAX_ACTOR_JOB_ASYNC_WAIT_SECS --> If the run finishes...',
      ],
      8 =>
      [
        'name' => 'webhooks',
        'param' => 'webhooks',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies optional webhooks associated with the Actor run, which can be used to receive a notification e.g. when the Actor finished or failed. The value is a Base64-encoded JSON...',
      ],
      9 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  77 =>
  [
    'operation' => 'actorTask_runSync_get',
    'slug' => 'apify_actor_task_run_sync_get',
    'class' => 'ApifyActorTaskRunSyncGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/run-sync',
    'name' => 'Run task synchronously',
    'description' => 'Execute official Apify API operation `actorTask_runSync_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/run-sync.',
    'type' => 'read',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'timeout',
        'param' => 'timeout',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optional timeout for the run, in seconds. By default, the run uses the timeout from its configuration.',
      ],
      2 =>
      [
        'name' => 'memory',
        'param' => 'memory',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Memory limit for the run, in megabytes. The amount of memory can be set to a power of 2 with a minimum of 128. By default, the run uses the memory limit from its configuration.',
      ],
      3 =>
      [
        'name' => 'maxItems',
        'param' => 'max_items',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum number of dataset items that will be charged for pay-per-result Actors. This does NOT guarantee that the Actor will return only this many items. It only en...',
      ],
      4 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the Actor build to run. It can be either a build tag or build number. By default, the run uses the build from its configuration (typically `latest`).',
      ],
      5 =>
      [
        'name' => 'outputRecordKey',
        'param' => 'output_record_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Key of the record from run\'s default key-value store to be returned in the response. By default, it is `OUTPUT`.',
      ],
      6 =>
      [
        'name' => 'webhooks',
        'param' => 'webhooks',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies optional webhooks associated with the Actor run, which can be used to receive a notification e.g. when the Actor finished or failed. The value is a Base64-encoded JSON...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  78 =>
  [
    'operation' => 'actorTask_runSync_post',
    'slug' => 'apify_actor_task_run_sync_post',
    'class' => 'ApifyActorTaskRunSyncPost',
    'method' => 'POST',
    'path' => '/v2/actor-tasks/{actorTaskId}/run-sync',
    'name' => 'Run task synchronously',
    'description' => 'Execute official Apify API operation `actorTask_runSync_post`.

Endpoint: POST /v2/actor-tasks/{actorTaskId}/run-sync.',
    'type' => 'write',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'timeout',
        'param' => 'timeout',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optional timeout for the run, in seconds. By default, the run uses the timeout from its configuration.',
      ],
      2 =>
      [
        'name' => 'memory',
        'param' => 'memory',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Memory limit for the run, in megabytes. The amount of memory can be set to a power of 2 with a minimum of 128. By default, the run uses the memory limit from its configuration.',
      ],
      3 =>
      [
        'name' => 'maxItems',
        'param' => 'max_items',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum number of dataset items that will be charged for pay-per-result Actors. This does NOT guarantee that the Actor will return only this many items. It only en...',
      ],
      4 =>
      [
        'name' => 'maxTotalChargeUsd',
        'param' => 'max_total_charge_usd',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum cost of the run. This parameter is useful for pay-per-event Actors, as it allows you to limit the amount charged to your subscription. You can access the m...',
      ],
      5 =>
      [
        'name' => 'restartOnError',
        'param' => 'restart_on_error',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Determines whether the run will be restarted if it fails.',
      ],
      6 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the Actor build to run. It can be either a build tag or build number. By default, the run uses the build from its configuration (typically `latest`).',
      ],
      7 =>
      [
        'name' => 'outputRecordKey',
        'param' => 'output_record_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Key of the record from run\'s default key-value store to be returned in the response. By default, it is `OUTPUT`.',
      ],
      8 =>
      [
        'name' => 'webhooks',
        'param' => 'webhooks',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies optional webhooks associated with the Actor run, which can be used to receive a notification e.g. when the Actor finished or failed. The value is a Base64-encoded JSON...',
      ],
      9 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  79 =>
  [
    'operation' => 'actorTask_runSyncGetDatasetItems_get',
    'slug' => 'apify_actor_task_run_sync_get_dataset_items_get',
    'class' => 'ApifyActorTaskRunSyncGetDatasetItemsGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/run-sync-get-dataset-items',
    'name' => 'Run task synchronously and get dataset items',
    'description' => 'Execute official Apify API operation `actorTask_runSyncGetDatasetItems_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/run-sync-get-dataset-items.',
    'type' => 'read',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'timeout',
        'param' => 'timeout',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optional timeout for the run, in seconds. By default, the run uses the timeout from its configuration.',
      ],
      2 =>
      [
        'name' => 'memory',
        'param' => 'memory',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Memory limit for the run, in megabytes. The amount of memory can be set to a power of 2 with a minimum of 128. By default, the run uses the memory limit from its configuration.',
      ],
      3 =>
      [
        'name' => 'maxItems',
        'param' => 'max_items',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum number of dataset items that will be charged for pay-per-result Actors. This does NOT guarantee that the Actor will return only this many items. It only en...',
      ],
      4 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the Actor build to run. It can be either a build tag or build number. By default, the run uses the build from its configuration (typically `latest`).',
      ],
      5 =>
      [
        'name' => 'webhooks',
        'param' => 'webhooks',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies optional webhooks associated with the Actor run, which can be used to receive a notification e.g. when the Actor finished or failed. The value is a Base64-encoded JSON...',
      ],
      6 =>
      [
        'name' => 'format',
        'param' => 'format',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Format of the results, possible values are: `json`, `jsonl`, `csv`, `html`, `xlsx`, `xml` and `rss`. The default value is `json`.',
      ],
      7 =>
      [
        'name' => 'clean',
        'param' => 'clean',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the API endpoint returns only non-empty items and skips hidden fields (i.e. fields starting with the # character). The `clean` parameter is just a shortcut...',
      ],
      8 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      9 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. By default there is no limit.',
      ],
      10 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be picked from the items, only these fields will remain in the resulting record objects. Note that the fields in the outputted item...',
      ],
      11 =>
      [
        'name' => 'omit',
        'param' => 'omit',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be omitted from the items.',
      ],
      12 =>
      [
        'name' => 'unwind',
        'param' => 'unwind',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be unwound, in order which they should be processed. Each field should be either an array or an object. If the field is an array th...',
      ],
      13 =>
      [
        'name' => 'flatten',
        'param' => 'flatten',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should transform nested objects into flat structures. For example, with `flatten="foo"` the object `{"foo":{"bar": "hello"}}` is turned in...',
      ],
      14 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'By default, results are returned in the same order as they were stored. To reverse the order, set this parameter to `true` or `1`.',
      ],
      15 =>
      [
        'name' => 'attachment',
        'param' => 'attachment',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the response will define the `Content-Disposition: attachment` header, forcing a web browser to download the file rather than to display it. By default thi...',
      ],
      16 =>
      [
        'name' => 'delimiter',
        'param' => 'delimiter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A delimiter character for CSV files, only used if `format=csv`. You might need to URL-encode the character (e.g. use `%09` for tab or `%3B` for semicolon). The default delimiter...',
      ],
      17 =>
      [
        'name' => 'bom',
        'param' => 'bom',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'All text responses are encoded in UTF-8 encoding. By default, the `format=csv` files are prefixed with the UTF-8 Byte Order Mark (BOM), while `json`, `jsonl`, `xml`, `html` and...',
      ],
      18 =>
      [
        'name' => 'xmlRoot',
        'param' => 'xml_root',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default root element name of `xml` output. By default the root element is `items`.',
      ],
      19 =>
      [
        'name' => 'xmlRow',
        'param' => 'xml_row',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default element name that wraps each page or page function result object in `xml` output. By default the element name is `item`.',
      ],
      20 =>
      [
        'name' => 'skipHeaderRow',
        'param' => 'skip_header_row',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then header row in the `csv` format is skipped.',
      ],
      21 =>
      [
        'name' => 'skipHidden',
        'param' => 'skip_hidden',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then hidden fields are skipped from the output, i.e. fields starting with the `#` character.',
      ],
      22 =>
      [
        'name' => 'skipEmpty',
        'param' => 'skip_empty',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then empty items are skipped from the output. Note that if used, the results might contain less items than the limit value.',
      ],
      23 =>
      [
        'name' => 'simplified',
        'param' => 'simplified',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the endpoint applies the `fields=url,pageFunctionResult,errorInfo` and `unwind=pageFunctionResult` query parameters. This feature is used to emulate simpl...',
      ],
      24 =>
      [
        'name' => 'view',
        'param' => 'view',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the view configuration for dataset items based on the schema definition. This parameter determines how the data will be filtered and presented. For complete specificatio...',
      ],
      25 =>
      [
        'name' => 'skipFailedPages',
        'param' => 'skip_failed_pages',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the all the items with errorInfo property will be skipped from the output. This feature is here to emulate functionality of API version 1 used for the leg...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  80 =>
  [
    'operation' => 'actorTask_runSyncGetDatasetItems_post',
    'slug' => 'apify_actor_task_run_sync_get_dataset_items_post',
    'class' => 'ApifyActorTaskRunSyncGetDatasetItemsPost',
    'method' => 'POST',
    'path' => '/v2/actor-tasks/{actorTaskId}/run-sync-get-dataset-items',
    'name' => 'Run task synchronously and get dataset items',
    'description' => 'Execute official Apify API operation `actorTask_runSyncGetDatasetItems_post`.

Endpoint: POST /v2/actor-tasks/{actorTaskId}/run-sync-get-dataset-items.',
    'type' => 'write',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'timeout',
        'param' => 'timeout',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optional timeout for the run, in seconds. By default, the run uses the timeout from its configuration.',
      ],
      2 =>
      [
        'name' => 'memory',
        'param' => 'memory',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Memory limit for the run, in megabytes. The amount of memory can be set to a power of 2 with a minimum of 128. By default, the run uses the memory limit from its configuration.',
      ],
      3 =>
      [
        'name' => 'maxItems',
        'param' => 'max_items',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum number of dataset items that will be charged for pay-per-result Actors. This does NOT guarantee that the Actor will return only this many items. It only en...',
      ],
      4 =>
      [
        'name' => 'maxTotalChargeUsd',
        'param' => 'max_total_charge_usd',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum cost of the run. This parameter is useful for pay-per-event Actors, as it allows you to limit the amount charged to your subscription. You can access the m...',
      ],
      5 =>
      [
        'name' => 'restartOnError',
        'param' => 'restart_on_error',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Determines whether the run will be restarted if it fails.',
      ],
      6 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the Actor build to run. It can be either a build tag or build number. By default, the run uses the build from its configuration (typically `latest`).',
      ],
      7 =>
      [
        'name' => 'webhooks',
        'param' => 'webhooks',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies optional webhooks associated with the Actor run, which can be used to receive a notification e.g. when the Actor finished or failed. The value is a Base64-encoded JSON...',
      ],
      8 =>
      [
        'name' => 'format',
        'param' => 'format',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Format of the results, possible values are: `json`, `jsonl`, `csv`, `html`, `xlsx`, `xml` and `rss`. The default value is `json`.',
      ],
      9 =>
      [
        'name' => 'clean',
        'param' => 'clean',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the API endpoint returns only non-empty items and skips hidden fields (i.e. fields starting with the # character). The `clean` parameter is just a shortcut...',
      ],
      10 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      11 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. By default there is no limit.',
      ],
      12 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be picked from the items, only these fields will remain in the resulting record objects. Note that the fields in the outputted item...',
      ],
      13 =>
      [
        'name' => 'omit',
        'param' => 'omit',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be omitted from the items.',
      ],
      14 =>
      [
        'name' => 'unwind',
        'param' => 'unwind',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be unwound, in order which they should be processed. Each field should be either an array or an object. If the field is an array th...',
      ],
      15 =>
      [
        'name' => 'flatten',
        'param' => 'flatten',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should transform nested objects into flat structures. For example, with `flatten="foo"` the object `{"foo":{"bar": "hello"}}` is turned in...',
      ],
      16 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'By default, results are returned in the same order as they were stored. To reverse the order, set this parameter to `true` or `1`.',
      ],
      17 =>
      [
        'name' => 'attachment',
        'param' => 'attachment',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the response will define the `Content-Disposition: attachment` header, forcing a web browser to download the file rather than to display it. By default thi...',
      ],
      18 =>
      [
        'name' => 'delimiter',
        'param' => 'delimiter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A delimiter character for CSV files, only used if `format=csv`. You might need to URL-encode the character (e.g. use `%09` for tab or `%3B` for semicolon). The default delimiter...',
      ],
      19 =>
      [
        'name' => 'bom',
        'param' => 'bom',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'All text responses are encoded in UTF-8 encoding. By default, the `format=csv` files are prefixed with the UTF-8 Byte Order Mark (BOM), while `json`, `jsonl`, `xml`, `html` and...',
      ],
      20 =>
      [
        'name' => 'xmlRoot',
        'param' => 'xml_root',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default root element name of `xml` output. By default the root element is `items`.',
      ],
      21 =>
      [
        'name' => 'xmlRow',
        'param' => 'xml_row',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default element name that wraps each page or page function result object in `xml` output. By default the element name is `item`.',
      ],
      22 =>
      [
        'name' => 'skipHeaderRow',
        'param' => 'skip_header_row',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then header row in the `csv` format is skipped.',
      ],
      23 =>
      [
        'name' => 'skipHidden',
        'param' => 'skip_hidden',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then hidden fields are skipped from the output, i.e. fields starting with the `#` character.',
      ],
      24 =>
      [
        'name' => 'skipEmpty',
        'param' => 'skip_empty',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then empty items are skipped from the output. Note that if used, the results might contain less items than the limit value.',
      ],
      25 =>
      [
        'name' => 'simplified',
        'param' => 'simplified',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the endpoint applies the `fields=url,pageFunctionResult,errorInfo` and `unwind=pageFunctionResult` query parameters. This feature is used to emulate simpl...',
      ],
      26 =>
      [
        'name' => 'view',
        'param' => 'view',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the view configuration for dataset items based on the schema definition. This parameter determines how the data will be filtered and presented. For complete specificatio...',
      ],
      27 =>
      [
        'name' => 'skipFailedPages',
        'param' => 'skip_failed_pages',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the all the items with errorInfo property will be skipped from the output. This feature is here to emulate functionality of API version 1 used for the leg...',
      ],
      28 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  81 =>
  [
    'operation' => 'actorTask_runs_last_get',
    'slug' => 'apify_actor_task_runs_last_get',
    'class' => 'ApifyActorTaskRunsLastGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last',
    'name' => 'Get last run',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last.',
    'type' => 'read',
    'tag' => 'Actor tasks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'waitForFinish',
        'param' => 'wait_for_finish',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'The maximum number of seconds the server waits for the run to finish. By default it is `0`, the maximum value is `60`. <!-- MAX_ACTOR_JOB_ASYNC_WAIT_SECS --> If the run finishes...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  82 =>
  [
    'operation' => 'actorTask_last_log_get',
    'slug' => 'apify_actor_task_last_log_get',
    'class' => 'ApifyActorTaskLastLogGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/log',
    'name' => 'Get last Actor task run\'s log',
    'description' => 'Execute official Apify API operation `actorTask_last_log_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last/log.',
    'type' => 'read',
    'tag' => 'Last Actor task run\'s log',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'stream',
        'param' => 'stream',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the logs will be streamed as long as the run or build is running.',
      ],
      2 =>
      [
        'name' => 'download',
        'param' => 'download',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the web browser will download the log file rather than open it in a tab.',
      ],
      3 =>
      [
        'name' => 'raw',
        'param' => 'raw',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the logs will be kept verbatim. By default, the API removes ANSI escape codes from the logs, keeping only printable characters.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  83 =>
  [
    'operation' => 'actorTask_runs_last_dataset_get',
    'slug' => 'apify_actor_task_runs_last_dataset_get',
    'class' => 'ApifyActorTaskRunsLastDatasetGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/dataset',
    'name' => 'Get last task run\'s default dataset',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_dataset_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last/dataset.',
    'type' => 'read',
    'tag' => 'Last Actor task run\'s default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  84 =>
  [
    'operation' => 'actorTask_runs_last_dataset_put',
    'slug' => 'apify_actor_task_runs_last_dataset_put',
    'class' => 'ApifyActorTaskRunsLastDatasetPut',
    'method' => 'PUT',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/dataset',
    'name' => 'Update last task run\'s default dataset',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_dataset_put`.

Endpoint: PUT /v2/actor-tasks/{actorTaskId}/runs/last/dataset.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  85 =>
  [
    'operation' => 'actorTask_runs_last_dataset_delete',
    'slug' => 'apify_actor_task_runs_last_dataset_delete',
    'class' => 'ApifyActorTaskRunsLastDatasetDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/dataset',
    'name' => 'Delete last task run\'s default dataset',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_dataset_delete`.

Endpoint: DELETE /v2/actor-tasks/{actorTaskId}/runs/last/dataset.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  86 =>
  [
    'operation' => 'actorTask_runs_last_dataset_items_get',
    'slug' => 'apify_actor_task_runs_last_dataset_items_get',
    'class' => 'ApifyActorTaskRunsLastDatasetItemsGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/dataset/items',
    'name' => 'Get last task run\'s dataset items',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_dataset_items_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last/dataset/items.',
    'type' => 'read',
    'tag' => 'Last Actor task run\'s default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'format',
        'param' => 'format',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Format of the results, possible values are: `json`, `jsonl`, `csv`, `html`, `xlsx`, `xml` and `rss`. The default value is `json`.',
      ],
      3 =>
      [
        'name' => 'clean',
        'param' => 'clean',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the API endpoint returns only non-empty items and skips hidden fields (i.e. fields starting with the # character). The `clean` parameter is just a shortcut...',
      ],
      4 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      5 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. By default there is no limit.',
      ],
      6 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be picked from the items, only these fields will remain in the resulting record objects. Note that the fields in the outputted item...',
      ],
      7 =>
      [
        'name' => 'omit',
        'param' => 'omit',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be omitted from the items.',
      ],
      8 =>
      [
        'name' => 'unwind',
        'param' => 'unwind',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be unwound, in order which they should be processed. Each field should be either an array or an object. If the field is an array th...',
      ],
      9 =>
      [
        'name' => 'flatten',
        'param' => 'flatten',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should transform nested objects into flat structures. For example, with `flatten="foo"` the object `{"foo":{"bar": "hello"}}` is turned in...',
      ],
      10 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'By default, results are returned in the same order as they were stored. To reverse the order, set this parameter to `true` or `1`.',
      ],
      11 =>
      [
        'name' => 'attachment',
        'param' => 'attachment',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the response will define the `Content-Disposition: attachment` header, forcing a web browser to download the file rather than to display it. By default thi...',
      ],
      12 =>
      [
        'name' => 'delimiter',
        'param' => 'delimiter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A delimiter character for CSV files, only used if `format=csv`. You might need to URL-encode the character (e.g. use `%09` for tab or `%3B` for semicolon). The default delimiter...',
      ],
      13 =>
      [
        'name' => 'bom',
        'param' => 'bom',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'All text responses are encoded in UTF-8 encoding. By default, the `format=csv` files are prefixed with the UTF-8 Byte Order Mark (BOM), while `json`, `jsonl`, `xml`, `html` and...',
      ],
      14 =>
      [
        'name' => 'xmlRoot',
        'param' => 'xml_root',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default root element name of `xml` output. By default the root element is `items`.',
      ],
      15 =>
      [
        'name' => 'xmlRow',
        'param' => 'xml_row',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default element name that wraps each page or page function result object in `xml` output. By default the element name is `item`.',
      ],
      16 =>
      [
        'name' => 'skipHeaderRow',
        'param' => 'skip_header_row',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then header row in the `csv` format is skipped.',
      ],
      17 =>
      [
        'name' => 'skipHidden',
        'param' => 'skip_hidden',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then hidden fields are skipped from the output, i.e. fields starting with the `#` character.',
      ],
      18 =>
      [
        'name' => 'skipEmpty',
        'param' => 'skip_empty',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then empty items are skipped from the output. Note that if used, the results might contain less items than the limit value.',
      ],
      19 =>
      [
        'name' => 'simplified',
        'param' => 'simplified',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the endpoint applies the `fields=url,pageFunctionResult,errorInfo` and `unwind=pageFunctionResult` query parameters. This feature is used to emulate simpl...',
      ],
      20 =>
      [
        'name' => 'view',
        'param' => 'view',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the view configuration for dataset items based on the schema definition. This parameter determines how the data will be filtered and presented. For complete specificatio...',
      ],
      21 =>
      [
        'name' => 'skipFailedPages',
        'param' => 'skip_failed_pages',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the all the items with errorInfo property will be skipped from the output. This feature is here to emulate functionality of API version 1 used for the leg...',
      ],
      22 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  87 =>
  [
    'operation' => 'actorTask_runs_last_dataset_items_post',
    'slug' => 'apify_actor_task_runs_last_dataset_items_post',
    'class' => 'ApifyActorTaskRunsLastDatasetItemsPost',
    'method' => 'POST',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/dataset/items',
    'name' => 'Store items in last task run\'s dataset',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_dataset_items_post`.

Endpoint: POST /v2/actor-tasks/{actorTaskId}/runs/last/dataset/items.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  88 =>
  [
    'operation' => 'actorTask_runs_last_dataset_statistics_get',
    'slug' => 'apify_actor_task_runs_last_dataset_statistics_get',
    'class' => 'ApifyActorTaskRunsLastDatasetStatisticsGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/dataset/statistics',
    'name' => 'Get last task run\'s dataset statistics',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_dataset_statistics_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last/dataset/statistics.',
    'type' => 'read',
    'tag' => 'Last Actor task run\'s default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  89 =>
  [
    'operation' => 'actorTask_runs_last_keyValueStore_get',
    'slug' => 'apify_actor_task_runs_last_key_value_store_get',
    'class' => 'ApifyActorTaskRunsLastKeyValueStoreGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/key-value-store',
    'name' => 'Get last task run\'s default store',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_keyValueStore_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last/key-value-store.',
    'type' => 'read',
    'tag' => 'Last Actor task run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  90 =>
  [
    'operation' => 'actorTask_runs_last_keyValueStore_put',
    'slug' => 'apify_actor_task_runs_last_key_value_store_put',
    'class' => 'ApifyActorTaskRunsLastKeyValueStorePut',
    'method' => 'PUT',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/key-value-store',
    'name' => 'Update last task run\'s default store',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_keyValueStore_put`.

Endpoint: PUT /v2/actor-tasks/{actorTaskId}/runs/last/key-value-store.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  91 =>
  [
    'operation' => 'actorTask_runs_last_keyValueStore_delete',
    'slug' => 'apify_actor_task_runs_last_key_value_store_delete',
    'class' => 'ApifyActorTaskRunsLastKeyValueStoreDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/key-value-store',
    'name' => 'Delete last task run\'s default store',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_keyValueStore_delete`.

Endpoint: DELETE /v2/actor-tasks/{actorTaskId}/runs/last/key-value-store.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  92 =>
  [
    'operation' => 'actorTask_runs_last_keyValueStore_keys_get',
    'slug' => 'apify_actor_task_runs_last_key_value_store_keys_get',
    'class' => 'ApifyActorTaskRunsLastKeyValueStoreKeysGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/key-value-store/keys',
    'name' => 'Get last task run\'s default store\'s list of keys',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_keyValueStore_keys_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last/key-value-store/keys.',
    'type' => 'read',
    'tag' => 'Last Actor task run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'exclusiveStartKey',
        'param' => 'exclusive_start_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'All keys up to this one (including) are skipped from the result.',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of keys to be returned. Maximum value is `1000`.',
      ],
      4 =>
      [
        'name' => 'collection',
        'param' => 'collection',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limit the results to keys that belong to a specific collection from the key-value store schema. The key-value store need to have a schema defined for this parameter to work.',
      ],
      5 =>
      [
        'name' => 'prefix',
        'param' => 'prefix',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limit the results to keys that start with a specific prefix.',
      ],
      6 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  93 =>
  [
    'operation' => 'actorTask_runs_last_keyValueStore_records_get',
    'slug' => 'apify_actor_task_runs_last_key_value_store_records_get',
    'class' => 'ApifyActorTaskRunsLastKeyValueStoreRecordsGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/key-value-store/records',
    'name' => 'Download last task run\'s default store\'s records',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_keyValueStore_records_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last/key-value-store/records.',
    'type' => 'read',
    'tag' => 'Last Actor task run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'collection',
        'param' => 'collection',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If specified, only records belonging to a specific collection from the key-value store schema. The key-value store need to have a schema defined for this parameter to work.',
      ],
      3 =>
      [
        'name' => 'prefix',
        'param' => 'prefix',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If specified, only records whose key starts with the given prefix are included in the archive.',
      ],
      4 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  94 =>
  [
    'operation' => 'actorTask_runs_last_keyValueStore_record_get',
    'slug' => 'apify_actor_task_runs_last_key_value_store_record_get',
    'class' => 'ApifyActorTaskRunsLastKeyValueStoreRecordGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/key-value-store/records/{recordKey}',
    'name' => 'Get last task run\'s default store\'s record',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_keyValueStore_record_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last/key-value-store/records/{recordKey}.',
    'type' => 'read',
    'tag' => 'Last Actor task run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
      3 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
      4 =>
      [
        'name' => 'attachment',
        'param' => 'attachment',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the response will be served with `Content-Disposition: attachment` header, causing web browsers to offer downloading HTML records instead of displaying them.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  95 =>
  [
    'operation' => 'actorTask_runs_last_keyValueStore_record_put',
    'slug' => 'apify_actor_task_runs_last_key_value_store_record_put',
    'class' => 'ApifyActorTaskRunsLastKeyValueStoreRecordPut',
    'method' => 'PUT',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/key-value-store/records/{recordKey}',
    'name' => 'Store record in last task run\'s default store',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_keyValueStore_record_put`.

Endpoint: PUT /v2/actor-tasks/{actorTaskId}/runs/last/key-value-store/records/{recordKey}.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  96 =>
  [
    'operation' => 'actorTask_runs_last_keyValueStore_record_post',
    'slug' => 'apify_actor_task_runs_last_key_value_store_record_post',
    'class' => 'ApifyActorTaskRunsLastKeyValueStoreRecordPost',
    'method' => 'POST',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/key-value-store/records/{recordKey}',
    'name' => 'Store record in last task run\'s default store (POST)',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_keyValueStore_record_post`.

Endpoint: POST /v2/actor-tasks/{actorTaskId}/runs/last/key-value-store/records/{recordKey}.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  97 =>
  [
    'operation' => 'actorTask_runs_last_keyValueStore_record_delete',
    'slug' => 'apify_actor_task_runs_last_key_value_store_record_delete',
    'class' => 'ApifyActorTaskRunsLastKeyValueStoreRecordDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/key-value-store/records/{recordKey}',
    'name' => 'Delete last task run\'s default store\'s record',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_keyValueStore_record_delete`.

Endpoint: DELETE /v2/actor-tasks/{actorTaskId}/runs/last/key-value-store/records/{recordKey}.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  98 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_get',
    'slug' => 'apify_actor_task_runs_last_request_queue_get',
    'class' => 'ApifyActorTaskRunsLastRequestQueueGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue',
    'name' => 'Get last task run\'s default request queue',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last/request-queue.',
    'type' => 'read',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  99 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_put',
    'slug' => 'apify_actor_task_runs_last_request_queue_put',
    'class' => 'ApifyActorTaskRunsLastRequestQueuePut',
    'method' => 'PUT',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue',
    'name' => 'Update last task run\'s default request queue',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_put`.

Endpoint: PUT /v2/actor-tasks/{actorTaskId}/runs/last/request-queue.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  100 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_delete',
    'slug' => 'apify_actor_task_runs_last_request_queue_delete',
    'class' => 'ApifyActorTaskRunsLastRequestQueueDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue',
    'name' => 'Delete last task run\'s default request queue',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_delete`.

Endpoint: DELETE /v2/actor-tasks/{actorTaskId}/runs/last/request-queue.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  101 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_head_get',
    'slug' => 'apify_actor_task_runs_last_request_queue_head_get',
    'class' => 'ApifyActorTaskRunsLastRequestQueueHeadGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue/head',
    'name' => 'Get last task run\'s default request queue head',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_head_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last/request-queue/head.',
    'type' => 'read',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'How many items from queue should be returned.',
      ],
      3 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  102 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_head_lock_post',
    'slug' => 'apify_actor_task_runs_last_request_queue_head_lock_post',
    'class' => 'ApifyActorTaskRunsLastRequestQueueHeadLockPost',
    'method' => 'POST',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue/head/lock',
    'name' => 'Get and lock last task run\'s default request queue head',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_head_lock_post`.

Endpoint: POST /v2/actor-tasks/{actorTaskId}/runs/last/request-queue/head/lock.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'lockSecs',
        'param' => 'lock_secs',
        'in' => 'query',
        'type' => 'number',
        'required' => true,
        'description' => 'How long the requests will be locked for (in seconds).',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'How many items from the queue should be returned.',
      ],
      4 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  103 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_requests_get',
    'slug' => 'apify_actor_task_runs_last_request_queue_requests_get',
    'class' => 'ApifyActorTaskRunsLastRequestQueueRequestsGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests',
    'name' => 'List last task run\'s default request queue\'s requests',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_requests_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests.',
    'type' => 'read',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      3 =>
      [
        'name' => 'exclusiveStartId',
        'param' => 'exclusive_start_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'All requests up to this one (including) are skipped from the result. (Deprecated, use `cursor` instead.)',
      ],
      4 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of keys to be returned. Maximum value is `10000`.',
      ],
      5 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A cursor string for pagination, returned in the previous response as `nextCursor`. Use this to retrieve the next page of requests.',
      ],
      6 =>
      [
        'name' => 'filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Filter requests by their state. Possible values are `locked` and `pending`. You can combine multiple values separated by commas, which will mean the union of these filters - r...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  104 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_requests_post',
    'slug' => 'apify_actor_task_runs_last_request_queue_requests_post',
    'class' => 'ApifyActorTaskRunsLastRequestQueueRequestsPost',
    'method' => 'POST',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests',
    'name' => 'Add request to last task run\'s default request queue',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_requests_post`.

Endpoint: POST /v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      3 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end. Default value is `false` (end of queue).',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  105 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_requests_batch_post',
    'slug' => 'apify_actor_task_runs_last_request_queue_requests_batch_post',
    'class' => 'ApifyActorTaskRunsLastRequestQueueRequestsBatchPost',
    'method' => 'POST',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/batch',
    'name' => 'Batch add requests to last task run\'s default request queue',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_requests_batch_post`.

Endpoint: POST /v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/batch.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      3 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end. Default value is `false` (end of queue).',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  106 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_requests_batch_delete',
    'slug' => 'apify_actor_task_runs_last_request_queue_requests_batch_delete',
    'class' => 'ApifyActorTaskRunsLastRequestQueueRequestsBatchDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/batch',
    'name' => 'Batch delete requests from last task run\'s default request queue',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_requests_batch_delete`.

Endpoint: DELETE /v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/batch.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  107 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_requests_unlock_post',
    'slug' => 'apify_actor_task_runs_last_request_queue_requests_unlock_post',
    'class' => 'ApifyActorTaskRunsLastRequestQueueRequestsUnlockPost',
    'method' => 'POST',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/unlock',
    'name' => 'Unlock requests in last task run\'s default request queue',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_requests_unlock_post`.

Endpoint: POST /v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/unlock.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  108 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_request_get',
    'slug' => 'apify_actor_task_runs_last_request_queue_request_get',
    'class' => 'ApifyActorTaskRunsLastRequestQueueRequestGet',
    'method' => 'GET',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/{requestId}',
    'name' => 'Get request from last task run\'s default request queue',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_request_get`.

Endpoint: GET /v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/{requestId}.',
    'type' => 'read',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  109 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_request_put',
    'slug' => 'apify_actor_task_runs_last_request_queue_request_put',
    'class' => 'ApifyActorTaskRunsLastRequestQueueRequestPut',
    'method' => 'PUT',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/{requestId}',
    'name' => 'Update request in last task run\'s default request queue',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_request_put`.

Endpoint: PUT /v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/{requestId}.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      3 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end. Default value is `false` (end of queue).',
      ],
      4 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      5 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  110 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_request_delete',
    'slug' => 'apify_actor_task_runs_last_request_queue_request_delete',
    'class' => 'ApifyActorTaskRunsLastRequestQueueRequestDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/{requestId}',
    'name' => 'Delete request from last task run\'s default request queue',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_request_delete`.

Endpoint: DELETE /v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/{requestId}.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      3 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  111 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_request_lock_put',
    'slug' => 'apify_actor_task_runs_last_request_queue_request_lock_put',
    'class' => 'ApifyActorTaskRunsLastRequestQueueRequestLockPut',
    'method' => 'PUT',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/{requestId}/lock',
    'name' => 'Prolong lock on request in last task run\'s default request queue',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_request_lock_put`.

Endpoint: PUT /v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/{requestId}/lock.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      3 =>
      [
        'name' => 'lockSecs',
        'param' => 'lock_secs',
        'in' => 'query',
        'type' => 'number',
        'required' => true,
        'description' => 'How long the requests will be locked for (in seconds).',
      ],
      4 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      5 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end after lock expires.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  112 =>
  [
    'operation' => 'actorTask_runs_last_requestQueue_request_lock_delete',
    'slug' => 'apify_actor_task_runs_last_request_queue_request_lock_delete',
    'class' => 'ApifyActorTaskRunsLastRequestQueueRequestLockDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/{requestId}/lock',
    'name' => 'Delete lock on request in last task run\'s default request queue',
    'description' => 'Execute official Apify API operation `actorTask_runs_last_requestQueue_request_lock_delete`.

Endpoint: DELETE /v2/actor-tasks/{actorTaskId}/runs/last/request-queue/requests/{requestId}/lock.',
    'type' => 'write',
    'tag' => 'Last Actor task run\'s default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'actorTaskId',
        'param' => 'actor_task_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Task ID or a tilde-separated owner\'s username and task\'s name.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter for the run status.',
      ],
      2 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      3 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      4 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end after lock was removed.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  113 =>
  [
    'operation' => 'actorRuns_get',
    'slug' => 'apify_actor_runs_get',
    'class' => 'ApifyActorRunsGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs',
    'name' => 'Get user runs list',
    'description' => 'Execute official Apify API operation `actorRuns_get`.

Endpoint: GET /v2/actor-runs.',
    'type' => 'read',
    'tag' => 'Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      2 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `startedAt` field in descending order. By default, they are sorted in ascending order.',
      ],
      3 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Single status or comma-separated list of statuses, see ([available statuses](https://docs.apify.com/platform/actors/running/runs-and-builds#lifecycle)). Used to filter runs by t...',
      ],
      4 =>
      [
        'name' => 'startedAfter',
        'param' => 'started_after',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter runs that started after the specified date and time (inclusive). The value must be a valid ISO 8601 datetime string (UTC).',
      ],
      5 =>
      [
        'name' => 'startedBefore',
        'param' => 'started_before',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter runs that started before the specified date and time (inclusive). The value must be a valid ISO 8601 datetime string (UTC).',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  114 =>
  [
    'operation' => 'actorRun_get',
    'slug' => 'apify_actor_run_get',
    'class' => 'ApifyActorRunGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}',
    'name' => 'Get run',
    'description' => 'Execute official Apify API operation `actorRun_get`.

Endpoint: GET /v2/actor-runs/{runId}.',
    'type' => 'read',
    'tag' => 'Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'waitForFinish',
        'param' => 'wait_for_finish',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'The maximum number of seconds the server waits for the run to finish. By default it is `0`, the maximum value is `60`. <!-- MAX_ACTOR_JOB_ASYNC_WAIT_SECS --> If the run finishes...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  115 =>
  [
    'operation' => 'actorRun_put',
    'slug' => 'apify_actor_run_put',
    'class' => 'ApifyActorRunPut',
    'method' => 'PUT',
    'path' => '/v2/actor-runs/{runId}',
    'name' => 'Update run',
    'description' => 'Execute official Apify API operation `actorRun_put`.

Endpoint: PUT /v2/actor-runs/{runId}.',
    'type' => 'write',
    'tag' => 'Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  116 =>
  [
    'operation' => 'actorRun_delete',
    'slug' => 'apify_actor_run_delete',
    'class' => 'ApifyActorRunDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-runs/{runId}',
    'name' => 'Delete run',
    'description' => 'Execute official Apify API operation `actorRun_delete`.

Endpoint: DELETE /v2/actor-runs/{runId}.',
    'type' => 'write',
    'tag' => 'Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  117 =>
  [
    'operation' => 'actorRun_abort_post',
    'slug' => 'apify_actor_run_abort_post',
    'class' => 'ApifyActorRunAbortPost',
    'method' => 'POST',
    'path' => '/v2/actor-runs/{runId}/abort',
    'name' => 'Abort run',
    'description' => 'Execute official Apify API operation `actorRun_abort_post`.

Endpoint: POST /v2/actor-runs/{runId}/abort.',
    'type' => 'write',
    'tag' => 'Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'gracefully',
        'param' => 'gracefully',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If true passed, the Actor run will abort gracefully. It will send `aborting` and `persistState` event into run and force-stop the run after 30 seconds. It is helpful in cases wh...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  118 =>
  [
    'operation' => 'actorRun_metamorph_post',
    'slug' => 'apify_actor_run_metamorph_post',
    'class' => 'ApifyActorRunMetamorphPost',
    'method' => 'POST',
    'path' => '/v2/actor-runs/{runId}/metamorph',
    'name' => 'Metamorph run',
    'description' => 'Execute official Apify API operation `actorRun_metamorph_post`.

Endpoint: POST /v2/actor-runs/{runId}/metamorph.',
    'type' => 'write',
    'tag' => 'Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'targetActorId',
        'param' => 'target_actor_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of a target Actor that the run should be transformed into.',
      ],
      2 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional build of the target Actor. It can be either a build tag or build number. By default, the run uses the build specified in the default run configuration for the target Ac...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  119 =>
  [
    'operation' => 'actorRun_reboot_post',
    'slug' => 'apify_actor_run_reboot_post',
    'class' => 'ApifyActorRunRebootPost',
    'method' => 'POST',
    'path' => '/v2/actor-runs/{runId}/reboot',
    'name' => 'Reboot run',
    'description' => 'Execute official Apify API operation `actorRun_reboot_post`.

Endpoint: POST /v2/actor-runs/{runId}/reboot.',
    'type' => 'write',
    'tag' => 'Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  120 =>
  [
    'operation' => 'PostResurrectRun',
    'slug' => 'apify_post_resurrect_run',
    'class' => 'ApifyPostResurrectRun',
    'method' => 'POST',
    'path' => '/v2/actor-runs/{runId}/resurrect',
    'name' => 'Resurrect run',
    'description' => 'Execute official Apify API operation `PostResurrectRun`.

Endpoint: POST /v2/actor-runs/{runId}/resurrect.',
    'type' => 'write',
    'tag' => 'Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'build',
        'param' => 'build',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the Actor build to run. It can be either a build tag or build number. By default, the run is resurrected with the same build it originally used. Specifically, if a run...',
      ],
      2 =>
      [
        'name' => 'timeout',
        'param' => 'timeout',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optional timeout for the run, in seconds. By default, the run uses the timeout specified in the run that is being resurrected.',
      ],
      3 =>
      [
        'name' => 'memory',
        'param' => 'memory',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Memory limit for the run, in megabytes. The amount of memory can be set to a power of 2 with a minimum of 128. By default, the run uses the memory limit specified in the run tha...',
      ],
      4 =>
      [
        'name' => 'maxItems',
        'param' => 'max_items',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum number of dataset items that will be charged for pay-per-result Actors. This does NOT guarantee that the Actor will return only this many items. It only en...',
      ],
      5 =>
      [
        'name' => 'maxTotalChargeUsd',
        'param' => 'max_total_charge_usd',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Specifies the maximum cost of the run. This parameter is useful for pay-per-event Actors, as it allows you to limit the amount charged to your subscription. You can access the m...',
      ],
      6 =>
      [
        'name' => 'restartOnError',
        'param' => 'restart_on_error',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Determines whether the resurrected run will be restarted if it fails. By default, the resurrected run uses the same setting as before.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  121 =>
  [
    'operation' => 'PostChargeRun',
    'slug' => 'apify_post_charge_run',
    'class' => 'ApifyPostChargeRun',
    'method' => 'POST',
    'path' => '/v2/actor-runs/{runId}/charge',
    'name' => 'Charge events in run',
    'description' => 'Execute official Apify API operation `PostChargeRun`.

Endpoint: POST /v2/actor-runs/{runId}/charge.',
    'type' => 'write',
    'tag' => 'Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  122 =>
  [
    'operation' => 'actorRun_dataset_get',
    'slug' => 'apify_actor_run_dataset_get',
    'class' => 'ApifyActorRunDatasetGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}/dataset',
    'name' => 'Get default dataset',
    'description' => 'Execute official Apify API operation `actorRun_dataset_get`.

Endpoint: GET /v2/actor-runs/{runId}/dataset.',
    'type' => 'read',
    'tag' => 'Default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  123 =>
  [
    'operation' => 'actorRun_dataset_put',
    'slug' => 'apify_actor_run_dataset_put',
    'class' => 'ApifyActorRunDatasetPut',
    'method' => 'PUT',
    'path' => '/v2/actor-runs/{runId}/dataset',
    'name' => 'Update default dataset',
    'description' => 'Execute official Apify API operation `actorRun_dataset_put`.

Endpoint: PUT /v2/actor-runs/{runId}/dataset.',
    'type' => 'write',
    'tag' => 'Default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  124 =>
  [
    'operation' => 'actorRun_dataset_delete',
    'slug' => 'apify_actor_run_dataset_delete',
    'class' => 'ApifyActorRunDatasetDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-runs/{runId}/dataset',
    'name' => 'Delete default dataset',
    'description' => 'Execute official Apify API operation `actorRun_dataset_delete`.

Endpoint: DELETE /v2/actor-runs/{runId}/dataset.',
    'type' => 'write',
    'tag' => 'Default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  125 =>
  [
    'operation' => 'actorRun_dataset_items_get',
    'slug' => 'apify_actor_run_dataset_items_get',
    'class' => 'ApifyActorRunDatasetItemsGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}/dataset/items',
    'name' => 'Get default dataset items',
    'description' => 'Execute official Apify API operation `actorRun_dataset_items_get`.

Endpoint: GET /v2/actor-runs/{runId}/dataset/items.',
    'type' => 'read',
    'tag' => 'Default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'format',
        'param' => 'format',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Format of the results, possible values are: `json`, `jsonl`, `csv`, `html`, `xlsx`, `xml` and `rss`. The default value is `json`.',
      ],
      2 =>
      [
        'name' => 'clean',
        'param' => 'clean',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the API endpoint returns only non-empty items and skips hidden fields (i.e. fields starting with the # character). The `clean` parameter is just a shortcut...',
      ],
      3 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      4 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. By default there is no limit.',
      ],
      5 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be picked from the items, only these fields will remain in the resulting record objects. Note that the fields in the outputted item...',
      ],
      6 =>
      [
        'name' => 'omit',
        'param' => 'omit',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be omitted from the items.',
      ],
      7 =>
      [
        'name' => 'unwind',
        'param' => 'unwind',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be unwound, in order which they should be processed. Each field should be either an array or an object. If the field is an array th...',
      ],
      8 =>
      [
        'name' => 'flatten',
        'param' => 'flatten',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should transform nested objects into flat structures. For example, with `flatten="foo"` the object `{"foo":{"bar": "hello"}}` is turned in...',
      ],
      9 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'By default, results are returned in the same order as they were stored. To reverse the order, set this parameter to `true` or `1`.',
      ],
      10 =>
      [
        'name' => 'attachment',
        'param' => 'attachment',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the response will define the `Content-Disposition: attachment` header, forcing a web browser to download the file rather than to display it. By default thi...',
      ],
      11 =>
      [
        'name' => 'delimiter',
        'param' => 'delimiter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A delimiter character for CSV files, only used if `format=csv`. You might need to URL-encode the character (e.g. use `%09` for tab or `%3B` for semicolon). The default delimiter...',
      ],
      12 =>
      [
        'name' => 'bom',
        'param' => 'bom',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'All text responses are encoded in UTF-8 encoding. By default, the `format=csv` files are prefixed with the UTF-8 Byte Order Mark (BOM), while `json`, `jsonl`, `xml`, `html` and...',
      ],
      13 =>
      [
        'name' => 'xmlRoot',
        'param' => 'xml_root',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default root element name of `xml` output. By default the root element is `items`.',
      ],
      14 =>
      [
        'name' => 'xmlRow',
        'param' => 'xml_row',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default element name that wraps each page or page function result object in `xml` output. By default the element name is `item`.',
      ],
      15 =>
      [
        'name' => 'skipHeaderRow',
        'param' => 'skip_header_row',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then header row in the `csv` format is skipped.',
      ],
      16 =>
      [
        'name' => 'skipHidden',
        'param' => 'skip_hidden',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then hidden fields are skipped from the output, i.e. fields starting with the `#` character.',
      ],
      17 =>
      [
        'name' => 'skipEmpty',
        'param' => 'skip_empty',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then empty items are skipped from the output. Note that if used, the results might contain less items than the limit value.',
      ],
      18 =>
      [
        'name' => 'simplified',
        'param' => 'simplified',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the endpoint applies the `fields=url,pageFunctionResult,errorInfo` and `unwind=pageFunctionResult` query parameters. This feature is used to emulate simpl...',
      ],
      19 =>
      [
        'name' => 'view',
        'param' => 'view',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the view configuration for dataset items based on the schema definition. This parameter determines how the data will be filtered and presented. For complete specificatio...',
      ],
      20 =>
      [
        'name' => 'skipFailedPages',
        'param' => 'skip_failed_pages',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the all the items with errorInfo property will be skipped from the output. This feature is here to emulate functionality of API version 1 used for the leg...',
      ],
      21 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  126 =>
  [
    'operation' => 'actorRun_dataset_items_post',
    'slug' => 'apify_actor_run_dataset_items_post',
    'class' => 'ApifyActorRunDatasetItemsPost',
    'method' => 'POST',
    'path' => '/v2/actor-runs/{runId}/dataset/items',
    'name' => 'Store items',
    'description' => 'Execute official Apify API operation `actorRun_dataset_items_post`.

Endpoint: POST /v2/actor-runs/{runId}/dataset/items.',
    'type' => 'write',
    'tag' => 'Default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  127 =>
  [
    'operation' => 'actorRun_dataset_statistics_get',
    'slug' => 'apify_actor_run_dataset_statistics_get',
    'class' => 'ApifyActorRunDatasetStatisticsGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}/dataset/statistics',
    'name' => 'Get default dataset statistics',
    'description' => 'Execute official Apify API operation `actorRun_dataset_statistics_get`.

Endpoint: GET /v2/actor-runs/{runId}/dataset/statistics.',
    'type' => 'read',
    'tag' => 'Default dataset',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  128 =>
  [
    'operation' => 'actorRun_keyValueStore_get',
    'slug' => 'apify_actor_run_key_value_store_get',
    'class' => 'ApifyActorRunKeyValueStoreGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}/key-value-store',
    'name' => 'Get default store',
    'description' => 'Execute official Apify API operation `actorRun_keyValueStore_get`.

Endpoint: GET /v2/actor-runs/{runId}/key-value-store.',
    'type' => 'read',
    'tag' => 'Default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  129 =>
  [
    'operation' => 'actorRun_keyValueStore_put',
    'slug' => 'apify_actor_run_key_value_store_put',
    'class' => 'ApifyActorRunKeyValueStorePut',
    'method' => 'PUT',
    'path' => '/v2/actor-runs/{runId}/key-value-store',
    'name' => 'Update default store',
    'description' => 'Execute official Apify API operation `actorRun_keyValueStore_put`.

Endpoint: PUT /v2/actor-runs/{runId}/key-value-store.',
    'type' => 'write',
    'tag' => 'Default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  130 =>
  [
    'operation' => 'actorRun_keyValueStore_delete',
    'slug' => 'apify_actor_run_key_value_store_delete',
    'class' => 'ApifyActorRunKeyValueStoreDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-runs/{runId}/key-value-store',
    'name' => 'Delete default store',
    'description' => 'Execute official Apify API operation `actorRun_keyValueStore_delete`.

Endpoint: DELETE /v2/actor-runs/{runId}/key-value-store.',
    'type' => 'write',
    'tag' => 'Default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  131 =>
  [
    'operation' => 'actorRun_keyValueStore_keys_get',
    'slug' => 'apify_actor_run_key_value_store_keys_get',
    'class' => 'ApifyActorRunKeyValueStoreKeysGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}/key-value-store/keys',
    'name' => 'Get default store\'s list of keys',
    'description' => 'Execute official Apify API operation `actorRun_keyValueStore_keys_get`.

Endpoint: GET /v2/actor-runs/{runId}/key-value-store/keys.',
    'type' => 'read',
    'tag' => 'Default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'exclusiveStartKey',
        'param' => 'exclusive_start_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'All keys up to this one (including) are skipped from the result.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of keys to be returned. Maximum value is `1000`.',
      ],
      3 =>
      [
        'name' => 'collection',
        'param' => 'collection',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limit the results to keys that belong to a specific collection from the key-value store schema. The key-value store need to have a schema defined for this parameter to work.',
      ],
      4 =>
      [
        'name' => 'prefix',
        'param' => 'prefix',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limit the results to keys that start with a specific prefix.',
      ],
      5 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  132 =>
  [
    'operation' => 'actorRun_keyValueStore_records_get',
    'slug' => 'apify_actor_run_key_value_store_records_get',
    'class' => 'ApifyActorRunKeyValueStoreRecordsGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}/key-value-store/records',
    'name' => 'Download default store\'s records',
    'description' => 'Execute official Apify API operation `actorRun_keyValueStore_records_get`.

Endpoint: GET /v2/actor-runs/{runId}/key-value-store/records.',
    'type' => 'read',
    'tag' => 'Default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'collection',
        'param' => 'collection',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If specified, only records belonging to a specific collection from the key-value store schema. The key-value store need to have a schema defined for this parameter to work.',
      ],
      2 =>
      [
        'name' => 'prefix',
        'param' => 'prefix',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If specified, only records whose key starts with the given prefix are included in the archive.',
      ],
      3 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  133 =>
  [
    'operation' => 'actorRun_keyValueStore_record_get',
    'slug' => 'apify_actor_run_key_value_store_record_get',
    'class' => 'ApifyActorRunKeyValueStoreRecordGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}/key-value-store/records/{recordKey}',
    'name' => 'Get default store\'s record',
    'description' => 'Execute official Apify API operation `actorRun_keyValueStore_record_get`.

Endpoint: GET /v2/actor-runs/{runId}/key-value-store/records/{recordKey}.',
    'type' => 'read',
    'tag' => 'Default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
      2 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
      3 =>
      [
        'name' => 'attachment',
        'param' => 'attachment',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the response will be served with `Content-Disposition: attachment` header, causing web browsers to offer downloading HTML records instead of displaying them.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  134 =>
  [
    'operation' => 'actorRun_keyValueStore_record_put',
    'slug' => 'apify_actor_run_key_value_store_record_put',
    'class' => 'ApifyActorRunKeyValueStoreRecordPut',
    'method' => 'PUT',
    'path' => '/v2/actor-runs/{runId}/key-value-store/records/{recordKey}',
    'name' => 'Store record in default store',
    'description' => 'Execute official Apify API operation `actorRun_keyValueStore_record_put`.

Endpoint: PUT /v2/actor-runs/{runId}/key-value-store/records/{recordKey}.',
    'type' => 'write',
    'tag' => 'Default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  135 =>
  [
    'operation' => 'actorRun_keyValueStore_record_post',
    'slug' => 'apify_actor_run_key_value_store_record_post',
    'class' => 'ApifyActorRunKeyValueStoreRecordPost',
    'method' => 'POST',
    'path' => '/v2/actor-runs/{runId}/key-value-store/records/{recordKey}',
    'name' => 'Store record in default store (POST)',
    'description' => 'Execute official Apify API operation `actorRun_keyValueStore_record_post`.

Endpoint: POST /v2/actor-runs/{runId}/key-value-store/records/{recordKey}.',
    'type' => 'write',
    'tag' => 'Default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  136 =>
  [
    'operation' => 'actorRun_keyValueStore_record_delete',
    'slug' => 'apify_actor_run_key_value_store_record_delete',
    'class' => 'ApifyActorRunKeyValueStoreRecordDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-runs/{runId}/key-value-store/records/{recordKey}',
    'name' => 'Delete default store\'s record',
    'description' => 'Execute official Apify API operation `actorRun_keyValueStore_record_delete`.

Endpoint: DELETE /v2/actor-runs/{runId}/key-value-store/records/{recordKey}.',
    'type' => 'write',
    'tag' => 'Default key-value store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  137 =>
  [
    'operation' => 'actorRun_requestQueue_get',
    'slug' => 'apify_actor_run_request_queue_get',
    'class' => 'ApifyActorRunRequestQueueGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}/request-queue',
    'name' => 'Get default request queue',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_get`.

Endpoint: GET /v2/actor-runs/{runId}/request-queue.',
    'type' => 'read',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  138 =>
  [
    'operation' => 'actorRun_requestQueue_put',
    'slug' => 'apify_actor_run_request_queue_put',
    'class' => 'ApifyActorRunRequestQueuePut',
    'method' => 'PUT',
    'path' => '/v2/actor-runs/{runId}/request-queue',
    'name' => 'Update default request queue',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_put`.

Endpoint: PUT /v2/actor-runs/{runId}/request-queue.',
    'type' => 'write',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  139 =>
  [
    'operation' => 'actorRun_requestQueue_delete',
    'slug' => 'apify_actor_run_request_queue_delete',
    'class' => 'ApifyActorRunRequestQueueDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-runs/{runId}/request-queue',
    'name' => 'Delete default request queue',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_delete`.

Endpoint: DELETE /v2/actor-runs/{runId}/request-queue.',
    'type' => 'write',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  140 =>
  [
    'operation' => 'actorRun_requestQueue_requests_get',
    'slug' => 'apify_actor_run_request_queue_requests_get',
    'class' => 'ApifyActorRunRequestQueueRequestsGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}/request-queue/requests',
    'name' => 'List default request queue\'s requests',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_requests_get`.

Endpoint: GET /v2/actor-runs/{runId}/request-queue/requests.',
    'type' => 'read',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      2 =>
      [
        'name' => 'exclusiveStartId',
        'param' => 'exclusive_start_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'All requests up to this one (including) are skipped from the result. (Deprecated, use `cursor` instead.)',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of keys to be returned. Maximum value is `10000`.',
      ],
      4 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A cursor string for pagination, returned in the previous response as `nextCursor`. Use this to retrieve the next page of requests.',
      ],
      5 =>
      [
        'name' => 'filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Filter requests by their state. Possible values are `locked` and `pending`. You can combine multiple values separated by commas, which will mean the union of these filters - r...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  141 =>
  [
    'operation' => 'actorRun_requestQueue_requests_post',
    'slug' => 'apify_actor_run_request_queue_requests_post',
    'class' => 'ApifyActorRunRequestQueueRequestsPost',
    'method' => 'POST',
    'path' => '/v2/actor-runs/{runId}/request-queue/requests',
    'name' => 'Add request to default request queue',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_requests_post`.

Endpoint: POST /v2/actor-runs/{runId}/request-queue/requests.',
    'type' => 'write',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      2 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end. Default value is `false` (end of queue).',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  142 =>
  [
    'operation' => 'actorRun_requestQueue_requests_batch_post',
    'slug' => 'apify_actor_run_request_queue_requests_batch_post',
    'class' => 'ApifyActorRunRequestQueueRequestsBatchPost',
    'method' => 'POST',
    'path' => '/v2/actor-runs/{runId}/request-queue/requests/batch',
    'name' => 'Batch add requests to default request queue',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_requests_batch_post`.

Endpoint: POST /v2/actor-runs/{runId}/request-queue/requests/batch.',
    'type' => 'write',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      2 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end. Default value is `false` (end of queue).',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  143 =>
  [
    'operation' => 'actorRun_requestQueue_requests_batch_delete',
    'slug' => 'apify_actor_run_request_queue_requests_batch_delete',
    'class' => 'ApifyActorRunRequestQueueRequestsBatchDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-runs/{runId}/request-queue/requests/batch',
    'name' => 'Batch delete requests from default request queue',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_requests_batch_delete`.

Endpoint: DELETE /v2/actor-runs/{runId}/request-queue/requests/batch.',
    'type' => 'write',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  144 =>
  [
    'operation' => 'actorRun_requestQueue_requests_unlock_post',
    'slug' => 'apify_actor_run_request_queue_requests_unlock_post',
    'class' => 'ApifyActorRunRequestQueueRequestsUnlockPost',
    'method' => 'POST',
    'path' => '/v2/actor-runs/{runId}/request-queue/requests/unlock',
    'name' => 'Unlock requests in default request queue',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_requests_unlock_post`.

Endpoint: POST /v2/actor-runs/{runId}/request-queue/requests/unlock.',
    'type' => 'write',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  145 =>
  [
    'operation' => 'actorRun_requestQueue_request_get',
    'slug' => 'apify_actor_run_request_queue_request_get',
    'class' => 'ApifyActorRunRequestQueueRequestGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}/request-queue/requests/{requestId}',
    'name' => 'Get request from default request queue',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_request_get`.

Endpoint: GET /v2/actor-runs/{runId}/request-queue/requests/{requestId}.',
    'type' => 'read',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  146 =>
  [
    'operation' => 'actorRun_requestQueue_request_put',
    'slug' => 'apify_actor_run_request_queue_request_put',
    'class' => 'ApifyActorRunRequestQueueRequestPut',
    'method' => 'PUT',
    'path' => '/v2/actor-runs/{runId}/request-queue/requests/{requestId}',
    'name' => 'Update request in default request queue',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_request_put`.

Endpoint: PUT /v2/actor-runs/{runId}/request-queue/requests/{requestId}.',
    'type' => 'write',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      2 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end. Default value is `false` (end of queue).',
      ],
      3 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  147 =>
  [
    'operation' => 'actorRun_requestQueue_request_delete',
    'slug' => 'apify_actor_run_request_queue_request_delete',
    'class' => 'ApifyActorRunRequestQueueRequestDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-runs/{runId}/request-queue/requests/{requestId}',
    'name' => 'Delete request from default request queue',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_request_delete`.

Endpoint: DELETE /v2/actor-runs/{runId}/request-queue/requests/{requestId}.',
    'type' => 'write',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  148 =>
  [
    'operation' => 'actorRun_requestQueue_request_lock_put',
    'slug' => 'apify_actor_run_request_queue_request_lock_put',
    'class' => 'ApifyActorRunRequestQueueRequestLockPut',
    'method' => 'PUT',
    'path' => '/v2/actor-runs/{runId}/request-queue/requests/{requestId}/lock',
    'name' => 'Prolong lock on request in default request queue',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_request_lock_put`.

Endpoint: PUT /v2/actor-runs/{runId}/request-queue/requests/{requestId}/lock.',
    'type' => 'write',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      2 =>
      [
        'name' => 'lockSecs',
        'param' => 'lock_secs',
        'in' => 'query',
        'type' => 'number',
        'required' => true,
        'description' => 'How long the requests will be locked for (in seconds).',
      ],
      3 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      4 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end after lock expires.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  149 =>
  [
    'operation' => 'actorRun_requestQueue_request_lock_delete',
    'slug' => 'apify_actor_run_request_queue_request_lock_delete',
    'class' => 'ApifyActorRunRequestQueueRequestLockDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-runs/{runId}/request-queue/requests/{requestId}/lock',
    'name' => 'Delete lock on request in default request queue',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_request_lock_delete`.

Endpoint: DELETE /v2/actor-runs/{runId}/request-queue/requests/{requestId}/lock.',
    'type' => 'write',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      3 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end after lock was removed.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  150 =>
  [
    'operation' => 'actorRun_requestQueue_head_get',
    'slug' => 'apify_actor_run_request_queue_head_get',
    'class' => 'ApifyActorRunRequestQueueHeadGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}/request-queue/head',
    'name' => 'Get default request queue head',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_head_get`.

Endpoint: GET /v2/actor-runs/{runId}/request-queue/head.',
    'type' => 'read',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'How many items from queue should be returned.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  151 =>
  [
    'operation' => 'actorRun_requestQueue_head_lock_post',
    'slug' => 'apify_actor_run_request_queue_head_lock_post',
    'class' => 'ApifyActorRunRequestQueueHeadLockPost',
    'method' => 'POST',
    'path' => '/v2/actor-runs/{runId}/request-queue/head/lock',
    'name' => 'Get and lock default request queue head',
    'description' => 'Execute official Apify API operation `actorRun_requestQueue_head_lock_post`.

Endpoint: POST /v2/actor-runs/{runId}/request-queue/head/lock.',
    'type' => 'write',
    'tag' => 'Default request queue',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'lockSecs',
        'param' => 'lock_secs',
        'in' => 'query',
        'type' => 'number',
        'required' => true,
        'description' => 'How long the requests will be locked for (in seconds).',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'How many items from the queue should be returned.',
      ],
      3 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  152 =>
  [
    'operation' => 'actorRun_log_get',
    'slug' => 'apify_actor_run_log_get',
    'class' => 'ApifyActorRunLogGet',
    'method' => 'GET',
    'path' => '/v2/actor-runs/{runId}/log',
    'name' => 'Get run\'s log',
    'description' => 'Execute official Apify API operation `actorRun_log_get`.

Endpoint: GET /v2/actor-runs/{runId}/log.',
    'type' => 'read',
    'tag' => 'Actor runs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'runId',
        'param' => 'run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Actor run ID.',
      ],
      1 =>
      [
        'name' => 'stream',
        'param' => 'stream',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the logs will be streamed as long as the run or build is running.',
      ],
      2 =>
      [
        'name' => 'download',
        'param' => 'download',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the web browser will download the log file rather than open it in a tab.',
      ],
      3 =>
      [
        'name' => 'raw',
        'param' => 'raw',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the logs will be kept verbatim. By default, the API removes ANSI escape codes from the logs, keeping only printable characters.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  153 =>
  [
    'operation' => 'actorBuilds_get',
    'slug' => 'apify_actor_builds_get',
    'class' => 'ApifyActorBuildsGet',
    'method' => 'GET',
    'path' => '/v2/actor-builds',
    'name' => 'Get user builds list',
    'description' => 'Execute official Apify API operation `actorBuilds_get`.

Endpoint: GET /v2/actor-builds.',
    'type' => 'read',
    'tag' => 'Actor builds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      2 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `startedAt` field in descending order. By default, they are sorted in ascending order.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  154 =>
  [
    'operation' => 'actorBuild_get',
    'slug' => 'apify_actor_build_get',
    'class' => 'ApifyActorBuildGet',
    'method' => 'GET',
    'path' => '/v2/actor-builds/{buildId}',
    'name' => 'Get build',
    'description' => 'Execute official Apify API operation `actorBuild_get`.

Endpoint: GET /v2/actor-builds/{buildId}.',
    'type' => 'read',
    'tag' => 'Actor builds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'buildId',
        'param' => 'build_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the build, found in the build\'s Info tab.',
      ],
      1 =>
      [
        'name' => 'waitForFinish',
        'param' => 'wait_for_finish',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'The maximum number of seconds the server waits for the build to finish. By default it is `0`, the maximum value is `60`. <!-- MAX_ACTOR_JOB_ASYNC_WAIT_SECS --> If the build fini...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  155 =>
  [
    'operation' => 'actorBuild_delete',
    'slug' => 'apify_actor_build_delete',
    'class' => 'ApifyActorBuildDelete',
    'method' => 'DELETE',
    'path' => '/v2/actor-builds/{buildId}',
    'name' => 'Delete build',
    'description' => 'Execute official Apify API operation `actorBuild_delete`.

Endpoint: DELETE /v2/actor-builds/{buildId}.',
    'type' => 'write',
    'tag' => 'Actor builds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'buildId',
        'param' => 'build_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the build, found in the build\'s Info tab.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  156 =>
  [
    'operation' => 'actorBuild_abort_post',
    'slug' => 'apify_actor_build_abort_post',
    'class' => 'ApifyActorBuildAbortPost',
    'method' => 'POST',
    'path' => '/v2/actor-builds/{buildId}/abort',
    'name' => 'Abort build',
    'description' => 'Execute official Apify API operation `actorBuild_abort_post`.

Endpoint: POST /v2/actor-builds/{buildId}/abort.',
    'type' => 'write',
    'tag' => 'Actor builds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'buildId',
        'param' => 'build_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the build, found in the build\'s Info tab.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  157 =>
  [
    'operation' => 'actorBuild_log_get',
    'slug' => 'apify_actor_build_log_get',
    'class' => 'ApifyActorBuildLogGet',
    'method' => 'GET',
    'path' => '/v2/actor-builds/{buildId}/log',
    'name' => 'Get build\'s Log',
    'description' => 'Execute official Apify API operation `actorBuild_log_get`.

Endpoint: GET /v2/actor-builds/{buildId}/log.',
    'type' => 'read',
    'tag' => 'Actor builds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'buildId',
        'param' => 'build_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the build, found in the build\'s Info tab.',
      ],
      1 =>
      [
        'name' => 'stream',
        'param' => 'stream',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the logs will be streamed as long as the run or build is running.',
      ],
      2 =>
      [
        'name' => 'download',
        'param' => 'download',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the web browser will download the log file rather than open it in a tab.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  158 =>
  [
    'operation' => 'actorBuild_openapi_json_get',
    'slug' => 'apify_actor_build_openapi_json_get',
    'class' => 'ApifyActorBuildOpenapiJsonGet',
    'method' => 'GET',
    'path' => '/v2/actor-builds/{buildId}/openapi.json',
    'name' => 'Get OpenAPI definition',
    'description' => 'Execute official Apify API operation `actorBuild_openapi_json_get`.

Endpoint: GET /v2/actor-builds/{buildId}/openapi.json.',
    'type' => 'read',
    'tag' => 'Actor builds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'buildId',
        'param' => 'build_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the build, found in the build\'s Info tab. Use the special value `default` to get the OpenAPI schema for the Actor\'s default build.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  159 =>
  [
    'operation' => 'keyValueStores_get',
    'slug' => 'apify_key_value_stores_get',
    'class' => 'ApifyKeyValueStoresGet',
    'method' => 'GET',
    'path' => '/v2/key-value-stores',
    'name' => 'Get list of key-value stores',
    'description' => 'Execute official Apify API operation `keyValueStores_get`.

Endpoint: GET /v2/key-value-stores.',
    'type' => 'read',
    'tag' => 'Storage/Key-value stores',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      2 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `createdAt` field in descending order. By default, they are sorted in ascending order.',
      ],
      3 =>
      [
        'name' => 'unnamed',
        'param' => 'unnamed',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then all the storages are returned. By default, only named storages are returned.',
      ],
      4 =>
      [
        'name' => 'ownership',
        'param' => 'ownership',
        'in' => 'query',
        'type' => 'object',
        'required' => false,
        'description' => 'Filter by ownership. If this parameter is omitted, all accessible key-value stores are returned. - `ownedByMe`: Return only key-value stores owned by the user. - `sharedWithMe`:...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  160 =>
  [
    'operation' => 'keyValueStores_post',
    'slug' => 'apify_key_value_stores_post',
    'class' => 'ApifyKeyValueStoresPost',
    'method' => 'POST',
    'path' => '/v2/key-value-stores',
    'name' => 'Create key-value store',
    'description' => 'Execute official Apify API operation `keyValueStores_post`.

Endpoint: POST /v2/key-value-stores.',
    'type' => 'write',
    'tag' => 'Storage/Key-value stores',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'name',
        'param' => 'name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Custom unique name to easily identify the store in the future.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  161 =>
  [
    'operation' => 'keyValueStore_get',
    'slug' => 'apify_key_value_store_get',
    'class' => 'ApifyKeyValueStoreGet',
    'method' => 'GET',
    'path' => '/v2/key-value-stores/{storeId}',
    'name' => 'Get store',
    'description' => 'Execute official Apify API operation `keyValueStore_get`.

Endpoint: GET /v2/key-value-stores/{storeId}.',
    'type' => 'read',
    'tag' => 'Storage/Key-value stores',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key-value store ID or `username~store-name`.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  162 =>
  [
    'operation' => 'keyValueStore_put',
    'slug' => 'apify_key_value_store_put',
    'class' => 'ApifyKeyValueStorePut',
    'method' => 'PUT',
    'path' => '/v2/key-value-stores/{storeId}',
    'name' => 'Update store',
    'description' => 'Execute official Apify API operation `keyValueStore_put`.

Endpoint: PUT /v2/key-value-stores/{storeId}.',
    'type' => 'write',
    'tag' => 'Storage/Key-value stores',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key-value store ID or `username~store-name`.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  163 =>
  [
    'operation' => 'keyValueStore_delete',
    'slug' => 'apify_key_value_store_delete',
    'class' => 'ApifyKeyValueStoreDelete',
    'method' => 'DELETE',
    'path' => '/v2/key-value-stores/{storeId}',
    'name' => 'Delete store',
    'description' => 'Execute official Apify API operation `keyValueStore_delete`.

Endpoint: DELETE /v2/key-value-stores/{storeId}.',
    'type' => 'write',
    'tag' => 'Storage/Key-value stores',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key-value store ID or `username~store-name`.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  164 =>
  [
    'operation' => 'keyValueStore_keys_get',
    'slug' => 'apify_key_value_store_keys_get',
    'class' => 'ApifyKeyValueStoreKeysGet',
    'method' => 'GET',
    'path' => '/v2/key-value-stores/{storeId}/keys',
    'name' => 'Get list of keys',
    'description' => 'Execute official Apify API operation `keyValueStore_keys_get`.

Endpoint: GET /v2/key-value-stores/{storeId}/keys.',
    'type' => 'read',
    'tag' => 'Storage/Key-value stores',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key-value store ID or `username~store-name`.',
      ],
      1 =>
      [
        'name' => 'exclusiveStartKey',
        'param' => 'exclusive_start_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'All keys up to this one (including) are skipped from the result.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of keys to be returned. Maximum value is `1000`.',
      ],
      3 =>
      [
        'name' => 'collection',
        'param' => 'collection',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limit the results to keys that belong to a specific collection from the key-value store schema. The key-value store need to have a schema defined for this parameter to work.',
      ],
      4 =>
      [
        'name' => 'prefix',
        'param' => 'prefix',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Limit the results to keys that start with a specific prefix.',
      ],
      5 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  165 =>
  [
    'operation' => 'keyValueStore_records_get',
    'slug' => 'apify_key_value_store_records_get',
    'class' => 'ApifyKeyValueStoreRecordsGet',
    'method' => 'GET',
    'path' => '/v2/key-value-stores/{storeId}/records',
    'name' => 'Download records',
    'description' => 'Execute official Apify API operation `keyValueStore_records_get`.

Endpoint: GET /v2/key-value-stores/{storeId}/records.',
    'type' => 'read',
    'tag' => 'Storage/Key-value stores',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key-value store ID or `username~store-name`.',
      ],
      1 =>
      [
        'name' => 'collection',
        'param' => 'collection',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If specified, only records belonging to a specific collection from the key-value store schema. The key-value store need to have a schema defined for this parameter to work.',
      ],
      2 =>
      [
        'name' => 'prefix',
        'param' => 'prefix',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If specified, only records whose key starts with the given prefix are included in the archive.',
      ],
      3 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  166 =>
  [
    'operation' => 'keyValueStore_record_get',
    'slug' => 'apify_key_value_store_record_get',
    'class' => 'ApifyKeyValueStoreRecordGet',
    'method' => 'GET',
    'path' => '/v2/key-value-stores/{storeId}/records/{recordKey}',
    'name' => 'Get record',
    'description' => 'Execute official Apify API operation `keyValueStore_record_get`.

Endpoint: GET /v2/key-value-stores/{storeId}/records/{recordKey}.',
    'type' => 'read',
    'tag' => 'Storage/Key-value stores',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key-value store ID or `username~store-name`.',
      ],
      1 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
      2 =>
      [
        'name' => 'attachment',
        'param' => 'attachment',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the response will be served with `Content-Disposition: attachment` header, causing web browsers to offer downloading HTML records instead of displaying them.',
      ],
      3 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  167 =>
  [
    'operation' => 'keyValueStore_record_put',
    'slug' => 'apify_key_value_store_record_put',
    'class' => 'ApifyKeyValueStoreRecordPut',
    'method' => 'PUT',
    'path' => '/v2/key-value-stores/{storeId}/records/{recordKey}',
    'name' => 'Store record',
    'description' => 'Execute official Apify API operation `keyValueStore_record_put`.

Endpoint: PUT /v2/key-value-stores/{storeId}/records/{recordKey}.',
    'type' => 'write',
    'tag' => 'Storage/Key-value stores',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key-value store ID or `username~store-name`.',
      ],
      1 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  168 =>
  [
    'operation' => 'keyValueStore_record_post',
    'slug' => 'apify_key_value_store_record_post',
    'class' => 'ApifyKeyValueStoreRecordPost',
    'method' => 'POST',
    'path' => '/v2/key-value-stores/{storeId}/records/{recordKey}',
    'name' => 'Store record (POST)',
    'description' => 'Execute official Apify API operation `keyValueStore_record_post`.

Endpoint: POST /v2/key-value-stores/{storeId}/records/{recordKey}.',
    'type' => 'write',
    'tag' => 'Storage/Key-value stores',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key-value store ID or `username~store-name`.',
      ],
      1 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  169 =>
  [
    'operation' => 'keyValueStore_record_delete',
    'slug' => 'apify_key_value_store_record_delete',
    'class' => 'ApifyKeyValueStoreRecordDelete',
    'method' => 'DELETE',
    'path' => '/v2/key-value-stores/{storeId}/records/{recordKey}',
    'name' => 'Delete record',
    'description' => 'Execute official Apify API operation `keyValueStore_record_delete`.

Endpoint: DELETE /v2/key-value-stores/{storeId}/records/{recordKey}.',
    'type' => 'write',
    'tag' => 'Storage/Key-value stores',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key-value store ID or `username~store-name`.',
      ],
      1 =>
      [
        'name' => 'recordKey',
        'param' => 'record_key',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Key of the record.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  170 =>
  [
    'operation' => 'datasets_get',
    'slug' => 'apify_datasets_get',
    'class' => 'ApifyDatasetsGet',
    'method' => 'GET',
    'path' => '/v2/datasets',
    'name' => 'Get list of datasets',
    'description' => 'Execute official Apify API operation `datasets_get`.

Endpoint: GET /v2/datasets.',
    'type' => 'read',
    'tag' => 'Storage/Datasets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      2 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `createdAt` field in descending order. By default, they are sorted in ascending order.',
      ],
      3 =>
      [
        'name' => 'unnamed',
        'param' => 'unnamed',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then all the storages are returned. By default, only named storages are returned.',
      ],
      4 =>
      [
        'name' => 'ownership',
        'param' => 'ownership',
        'in' => 'query',
        'type' => 'object',
        'required' => false,
        'description' => 'Filter by ownership. If this parameter is omitted, all accessible datasets are returned. - `ownedByMe`: Return only datasets owned by the user. - `sharedWithMe`: Return only dat...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  171 =>
  [
    'operation' => 'datasets_post',
    'slug' => 'apify_datasets_post',
    'class' => 'ApifyDatasetsPost',
    'method' => 'POST',
    'path' => '/v2/datasets',
    'name' => 'Create dataset',
    'description' => 'Execute official Apify API operation `datasets_post`.

Endpoint: POST /v2/datasets.',
    'type' => 'write',
    'tag' => 'Storage/Datasets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'name',
        'param' => 'name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Custom unique name to easily identify the dataset in the future.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  172 =>
  [
    'operation' => 'dataset_get',
    'slug' => 'apify_dataset_get',
    'class' => 'ApifyDatasetGet',
    'method' => 'GET',
    'path' => '/v2/datasets/{datasetId}',
    'name' => 'Get dataset',
    'description' => 'Execute official Apify API operation `dataset_get`.

Endpoint: GET /v2/datasets/{datasetId}.',
    'type' => 'read',
    'tag' => 'Storage/Datasets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'datasetId',
        'param' => 'dataset_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Dataset ID or `username~dataset-name`.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  173 =>
  [
    'operation' => 'dataset_put',
    'slug' => 'apify_dataset_put',
    'class' => 'ApifyDatasetPut',
    'method' => 'PUT',
    'path' => '/v2/datasets/{datasetId}',
    'name' => 'Update dataset',
    'description' => 'Execute official Apify API operation `dataset_put`.

Endpoint: PUT /v2/datasets/{datasetId}.',
    'type' => 'write',
    'tag' => 'Storage/Datasets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'datasetId',
        'param' => 'dataset_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Dataset ID or `username~dataset-name`.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  174 =>
  [
    'operation' => 'dataset_delete',
    'slug' => 'apify_dataset_delete',
    'class' => 'ApifyDatasetDelete',
    'method' => 'DELETE',
    'path' => '/v2/datasets/{datasetId}',
    'name' => 'Delete dataset',
    'description' => 'Execute official Apify API operation `dataset_delete`.

Endpoint: DELETE /v2/datasets/{datasetId}.',
    'type' => 'write',
    'tag' => 'Storage/Datasets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'datasetId',
        'param' => 'dataset_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Dataset ID or `username~dataset-name`.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  175 =>
  [
    'operation' => 'dataset_items_get',
    'slug' => 'apify_dataset_items_get',
    'class' => 'ApifyDatasetItemsGet',
    'method' => 'GET',
    'path' => '/v2/datasets/{datasetId}/items',
    'name' => 'Get dataset items',
    'description' => 'Execute official Apify API operation `dataset_items_get`.

Endpoint: GET /v2/datasets/{datasetId}/items.',
    'type' => 'read',
    'tag' => 'Storage/Datasets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'datasetId',
        'param' => 'dataset_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Dataset ID or `username~dataset-name`.',
      ],
      1 =>
      [
        'name' => 'format',
        'param' => 'format',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Format of the results, possible values are: `json`, `jsonl`, `csv`, `html`, `xlsx`, `xml` and `rss`. The default value is `json`.',
      ],
      2 =>
      [
        'name' => 'clean',
        'param' => 'clean',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the API endpoint returns only non-empty items and skips hidden fields (i.e. fields starting with the # character). The `clean` parameter is just a shortcut...',
      ],
      3 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      4 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. By default there is no limit.',
      ],
      5 =>
      [
        'name' => 'fields',
        'param' => 'fields',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be picked from the items, only these fields will remain in the resulting record objects. Note that the fields in the outputted item...',
      ],
      6 =>
      [
        'name' => 'omit',
        'param' => 'omit',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be omitted from the items.',
      ],
      7 =>
      [
        'name' => 'unwind',
        'param' => 'unwind',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should be unwound, in order which they should be processed. Each field should be either an array or an object. If the field is an array th...',
      ],
      8 =>
      [
        'name' => 'flatten',
        'param' => 'flatten',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of fields which should transform nested objects into flat structures. For example, with `flatten="foo"` the object `{"foo":{"bar": "hello"}}` is turned in...',
      ],
      9 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'By default, results are returned in the same order as they were stored. To reverse the order, set this parameter to `true` or `1`.',
      ],
      10 =>
      [
        'name' => 'attachment',
        'param' => 'attachment',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the response will define the `Content-Disposition: attachment` header, forcing a web browser to download the file rather than to display it. By default thi...',
      ],
      11 =>
      [
        'name' => 'delimiter',
        'param' => 'delimiter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A delimiter character for CSV files, only used if `format=csv`. You might need to URL-encode the character (e.g. use `%09` for tab or `%3B` for semicolon). The default delimiter...',
      ],
      12 =>
      [
        'name' => 'bom',
        'param' => 'bom',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'All text responses are encoded in UTF-8 encoding. By default, the `format=csv` files are prefixed with the UTF-8 Byte Order Mark (BOM), while `json`, `jsonl`, `xml`, `html` and...',
      ],
      13 =>
      [
        'name' => 'xmlRoot',
        'param' => 'xml_root',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default root element name of `xml` output. By default the root element is `items`.',
      ],
      14 =>
      [
        'name' => 'xmlRow',
        'param' => 'xml_row',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Overrides default element name that wraps each page or page function result object in `xml` output. By default the element name is `item`.',
      ],
      15 =>
      [
        'name' => 'skipHeaderRow',
        'param' => 'skip_header_row',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then header row in the `csv` format is skipped.',
      ],
      16 =>
      [
        'name' => 'skipHidden',
        'param' => 'skip_hidden',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then hidden fields are skipped from the output, i.e. fields starting with the `#` character.',
      ],
      17 =>
      [
        'name' => 'skipEmpty',
        'param' => 'skip_empty',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then empty items are skipped from the output. Note that if used, the results might contain less items than the limit value.',
      ],
      18 =>
      [
        'name' => 'simplified',
        'param' => 'simplified',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the endpoint applies the `fields=url,pageFunctionResult,errorInfo` and `unwind=pageFunctionResult` query parameters. This feature is used to emulate simpl...',
      ],
      19 =>
      [
        'name' => 'view',
        'param' => 'view',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Defines the view configuration for dataset items based on the schema definition. This parameter determines how the data will be filtered and presented. For complete specificatio...',
      ],
      20 =>
      [
        'name' => 'skipFailedPages',
        'param' => 'skip_failed_pages',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then, the all the items with errorInfo property will be skipped from the output. This feature is here to emulate functionality of API version 1 used for the leg...',
      ],
      21 =>
      [
        'name' => 'signature',
        'param' => 'signature',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Signature used for the access.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  176 =>
  [
    'operation' => 'dataset_items_post',
    'slug' => 'apify_dataset_items_post',
    'class' => 'ApifyDatasetItemsPost',
    'method' => 'POST',
    'path' => '/v2/datasets/{datasetId}/items',
    'name' => 'Store items',
    'description' => 'Execute official Apify API operation `dataset_items_post`.

Endpoint: POST /v2/datasets/{datasetId}/items.',
    'type' => 'write',
    'tag' => 'Storage/Datasets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'datasetId',
        'param' => 'dataset_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Dataset ID or `username~dataset-name`.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  177 =>
  [
    'operation' => 'dataset_statistics_get',
    'slug' => 'apify_dataset_statistics_get',
    'class' => 'ApifyDatasetStatisticsGet',
    'method' => 'GET',
    'path' => '/v2/datasets/{datasetId}/statistics',
    'name' => 'Get dataset statistics',
    'description' => 'Execute official Apify API operation `dataset_statistics_get`.

Endpoint: GET /v2/datasets/{datasetId}/statistics.',
    'type' => 'read',
    'tag' => 'Storage/Datasets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'datasetId',
        'param' => 'dataset_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Dataset ID or `username~dataset-name`.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  178 =>
  [
    'operation' => 'requestQueues_get',
    'slug' => 'apify_request_queues_get',
    'class' => 'ApifyRequestQueuesGet',
    'method' => 'GET',
    'path' => '/v2/request-queues',
    'name' => 'Get list of request queues',
    'description' => 'Execute official Apify API operation `requestQueues_get`.

Endpoint: GET /v2/request-queues.',
    'type' => 'read',
    'tag' => 'Storage/Request queues',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      2 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `createdAt` field in descending order. By default, they are sorted in ascending order.',
      ],
      3 =>
      [
        'name' => 'unnamed',
        'param' => 'unnamed',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then all the storages are returned. By default, only named storages are returned.',
      ],
      4 =>
      [
        'name' => 'ownership',
        'param' => 'ownership',
        'in' => 'query',
        'type' => 'object',
        'required' => false,
        'description' => 'Filter by ownership. If this parameter is omitted, all accessible request queues are returned. - `ownedByMe`: Return only request queues owned by the user. - `sharedWithMe`: Ret...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  179 =>
  [
    'operation' => 'requestQueues_post',
    'slug' => 'apify_request_queues_post',
    'class' => 'ApifyRequestQueuesPost',
    'method' => 'POST',
    'path' => '/v2/request-queues',
    'name' => 'Create request queue',
    'description' => 'Execute official Apify API operation `requestQueues_post`.

Endpoint: POST /v2/request-queues.',
    'type' => 'write',
    'tag' => 'Storage/Request queues',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'name',
        'param' => 'name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Custom unique name to easily identify the queue in the future.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  180 =>
  [
    'operation' => 'requestQueue_get',
    'slug' => 'apify_request_queue_get',
    'class' => 'ApifyRequestQueueGet',
    'method' => 'GET',
    'path' => '/v2/request-queues/{queueId}',
    'name' => 'Get request queue',
    'description' => 'Execute official Apify API operation `requestQueue_get`.

Endpoint: GET /v2/request-queues/{queueId}.',
    'type' => 'read',
    'tag' => 'Storage/Request queues',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  181 =>
  [
    'operation' => 'requestQueue_put',
    'slug' => 'apify_request_queue_put',
    'class' => 'ApifyRequestQueuePut',
    'method' => 'PUT',
    'path' => '/v2/request-queues/{queueId}',
    'name' => 'Update request queue',
    'description' => 'Execute official Apify API operation `requestQueue_put`.

Endpoint: PUT /v2/request-queues/{queueId}.',
    'type' => 'write',
    'tag' => 'Storage/Request queues',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  182 =>
  [
    'operation' => 'requestQueue_delete',
    'slug' => 'apify_request_queue_delete',
    'class' => 'ApifyRequestQueueDelete',
    'method' => 'DELETE',
    'path' => '/v2/request-queues/{queueId}',
    'name' => 'Delete request queue',
    'description' => 'Execute official Apify API operation `requestQueue_delete`.

Endpoint: DELETE /v2/request-queues/{queueId}.',
    'type' => 'write',
    'tag' => 'Storage/Request queues',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  183 =>
  [
    'operation' => 'requestQueue_requests_batch_post',
    'slug' => 'apify_request_queue_requests_batch_post',
    'class' => 'ApifyRequestQueueRequestsBatchPost',
    'method' => 'POST',
    'path' => '/v2/request-queues/{queueId}/requests/batch',
    'name' => 'Add requests',
    'description' => 'Execute official Apify API operation `requestQueue_requests_batch_post`.

Endpoint: POST /v2/request-queues/{queueId}/requests/batch.',
    'type' => 'write',
    'tag' => 'Storage/Request queues',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      2 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end. Default value is `false` (end of queue).',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  184 =>
  [
    'operation' => 'requestQueue_requests_batch_delete',
    'slug' => 'apify_request_queue_requests_batch_delete',
    'class' => 'ApifyRequestQueueRequestsBatchDelete',
    'method' => 'DELETE',
    'path' => '/v2/request-queues/{queueId}/requests/batch',
    'name' => 'Delete requests',
    'description' => 'Execute official Apify API operation `requestQueue_requests_batch_delete`.

Endpoint: DELETE /v2/request-queues/{queueId}/requests/batch.',
    'type' => 'write',
    'tag' => 'Storage/Request queues',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  185 =>
  [
    'operation' => 'requestQueue_requests_unlock_post',
    'slug' => 'apify_request_queue_requests_unlock_post',
    'class' => 'ApifyRequestQueueRequestsUnlockPost',
    'method' => 'POST',
    'path' => '/v2/request-queues/{queueId}/requests/unlock',
    'name' => 'Unlock requests',
    'description' => 'Execute official Apify API operation `requestQueue_requests_unlock_post`.

Endpoint: POST /v2/request-queues/{queueId}/requests/unlock.',
    'type' => 'write',
    'tag' => 'Storage/Request queues/Requests locks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  186 =>
  [
    'operation' => 'requestQueue_requests_get',
    'slug' => 'apify_request_queue_requests_get',
    'class' => 'ApifyRequestQueueRequestsGet',
    'method' => 'GET',
    'path' => '/v2/request-queues/{queueId}/requests',
    'name' => 'List requests',
    'description' => 'Execute official Apify API operation `requestQueue_requests_get`.

Endpoint: GET /v2/request-queues/{queueId}/requests.',
    'type' => 'read',
    'tag' => 'Storage/Request queues/Requests',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      2 =>
      [
        'name' => 'exclusiveStartId',
        'param' => 'exclusive_start_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'All requests up to this one (including) are skipped from the result. (Deprecated, use `cursor` instead.)',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of keys to be returned. Maximum value is `10000`.',
      ],
      4 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A cursor string for pagination, returned in the previous response as `nextCursor`. Use this to retrieve the next page of requests.',
      ],
      5 =>
      [
        'name' => 'filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Filter requests by their state. Possible values are `locked` and `pending`. You can combine multiple values separated by commas, which will mean the union of these filters - r...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  187 =>
  [
    'operation' => 'requestQueue_requests_post',
    'slug' => 'apify_request_queue_requests_post',
    'class' => 'ApifyRequestQueueRequestsPost',
    'method' => 'POST',
    'path' => '/v2/request-queues/{queueId}/requests',
    'name' => 'Add request',
    'description' => 'Execute official Apify API operation `requestQueue_requests_post`.

Endpoint: POST /v2/request-queues/{queueId}/requests.',
    'type' => 'write',
    'tag' => 'Storage/Request queues/Requests',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      2 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end. Default value is `false` (end of queue).',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  188 =>
  [
    'operation' => 'requestQueue_request_get',
    'slug' => 'apify_request_queue_request_get',
    'class' => 'ApifyRequestQueueRequestGet',
    'method' => 'GET',
    'path' => '/v2/request-queues/{queueId}/requests/{requestId}',
    'name' => 'Get request',
    'description' => 'Execute official Apify API operation `requestQueue_request_get`.

Endpoint: GET /v2/request-queues/{queueId}/requests/{requestId}.',
    'type' => 'read',
    'tag' => 'Storage/Request queues/Requests',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  189 =>
  [
    'operation' => 'requestQueue_request_put',
    'slug' => 'apify_request_queue_request_put',
    'class' => 'ApifyRequestQueueRequestPut',
    'method' => 'PUT',
    'path' => '/v2/request-queues/{queueId}/requests/{requestId}',
    'name' => 'Update request',
    'description' => 'Execute official Apify API operation `requestQueue_request_put`.

Endpoint: PUT /v2/request-queues/{queueId}/requests/{requestId}.',
    'type' => 'write',
    'tag' => 'Storage/Request queues/Requests',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      2 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end. Default value is `false` (end of queue).',
      ],
      3 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  190 =>
  [
    'operation' => 'requestQueue_request_delete',
    'slug' => 'apify_request_queue_request_delete',
    'class' => 'ApifyRequestQueueRequestDelete',
    'method' => 'DELETE',
    'path' => '/v2/request-queues/{queueId}/requests/{requestId}',
    'name' => 'Delete request',
    'description' => 'Execute official Apify API operation `requestQueue_request_delete`.

Endpoint: DELETE /v2/request-queues/{queueId}/requests/{requestId}.',
    'type' => 'write',
    'tag' => 'Storage/Request queues/Requests',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  191 =>
  [
    'operation' => 'requestQueue_head_get',
    'slug' => 'apify_request_queue_head_get',
    'class' => 'ApifyRequestQueueHeadGet',
    'method' => 'GET',
    'path' => '/v2/request-queues/{queueId}/head',
    'name' => 'Get head',
    'description' => 'Execute official Apify API operation `requestQueue_head_get`.

Endpoint: GET /v2/request-queues/{queueId}/head.',
    'type' => 'read',
    'tag' => 'Storage/Request queues/Requests locks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'How many items from queue should be returned.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  192 =>
  [
    'operation' => 'requestQueue_head_lock_post',
    'slug' => 'apify_request_queue_head_lock_post',
    'class' => 'ApifyRequestQueueHeadLockPost',
    'method' => 'POST',
    'path' => '/v2/request-queues/{queueId}/head/lock',
    'name' => 'Get head and lock',
    'description' => 'Execute official Apify API operation `requestQueue_head_lock_post`.

Endpoint: POST /v2/request-queues/{queueId}/head/lock.',
    'type' => 'write',
    'tag' => 'Storage/Request queues/Requests locks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'lockSecs',
        'param' => 'lock_secs',
        'in' => 'query',
        'type' => 'number',
        'required' => true,
        'description' => 'How long the requests will be locked for (in seconds).',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'How many items from the queue should be returned.',
      ],
      3 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  193 =>
  [
    'operation' => 'requestQueue_request_lock_put',
    'slug' => 'apify_request_queue_request_lock_put',
    'class' => 'ApifyRequestQueueRequestLockPut',
    'method' => 'PUT',
    'path' => '/v2/request-queues/{queueId}/requests/{requestId}/lock',
    'name' => 'Prolong request lock',
    'description' => 'Execute official Apify API operation `requestQueue_request_lock_put`.

Endpoint: PUT /v2/request-queues/{queueId}/requests/{requestId}/lock.',
    'type' => 'write',
    'tag' => 'Storage/Request queues/Requests locks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      2 =>
      [
        'name' => 'lockSecs',
        'param' => 'lock_secs',
        'in' => 'query',
        'type' => 'number',
        'required' => true,
        'description' => 'How long the requests will be locked for (in seconds).',
      ],
      3 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      4 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end after lock expires.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  194 =>
  [
    'operation' => 'requestQueue_request_lock_delete',
    'slug' => 'apify_request_queue_request_lock_delete',
    'class' => 'ApifyRequestQueueRequestLockDelete',
    'method' => 'DELETE',
    'path' => '/v2/request-queues/{queueId}/requests/{requestId}/lock',
    'name' => 'Delete request lock',
    'description' => 'Execute official Apify API operation `requestQueue_request_lock_delete`.

Endpoint: DELETE /v2/request-queues/{queueId}/requests/{requestId}/lock.',
    'type' => 'write',
    'tag' => 'Storage/Request queues/Requests locks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'queueId',
        'param' => 'queue_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Queue ID or `username~queue-name`.',
      ],
      1 =>
      [
        'name' => 'requestId',
        'param' => 'request_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID.',
      ],
      2 =>
      [
        'name' => 'clientKey',
        'param' => 'client_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A unique identifier of the client accessing the request queue. It must be a string between 1 and 32 characters long. This identifier is used to determine whether the queue was a...',
      ],
      3 =>
      [
        'name' => 'forefront',
        'param' => 'forefront',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Determines if request should be added to the head of the queue or to the end after lock was removed.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  195 =>
  [
    'operation' => 'webhooks_get',
    'slug' => 'apify_webhooks_get',
    'class' => 'ApifyWebhooksGet',
    'method' => 'GET',
    'path' => '/v2/webhooks',
    'name' => 'Get list of webhooks',
    'description' => 'Execute official Apify API operation `webhooks_get`.

Endpoint: GET /v2/webhooks.',
    'type' => 'read',
    'tag' => 'Webhooks/Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      2 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `createdAt` field in descending order. By default, they are sorted in ascending order.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  196 =>
  [
    'operation' => 'webhooks_post',
    'slug' => 'apify_webhooks_post',
    'class' => 'ApifyWebhooksPost',
    'method' => 'POST',
    'path' => '/v2/webhooks',
    'name' => 'Create webhook',
    'description' => 'Execute official Apify API operation `webhooks_post`.

Endpoint: POST /v2/webhooks.',
    'type' => 'write',
    'tag' => 'Webhooks/Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  197 =>
  [
    'operation' => 'webhook_get',
    'slug' => 'apify_webhook_get',
    'class' => 'ApifyWebhookGet',
    'method' => 'GET',
    'path' => '/v2/webhooks/{webhookId}',
    'name' => 'Get webhook',
    'description' => 'Execute official Apify API operation `webhook_get`.

Endpoint: GET /v2/webhooks/{webhookId}.',
    'type' => 'read',
    'tag' => 'Webhooks/Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  198 =>
  [
    'operation' => 'webhook_put',
    'slug' => 'apify_webhook_put',
    'class' => 'ApifyWebhookPut',
    'method' => 'PUT',
    'path' => '/v2/webhooks/{webhookId}',
    'name' => 'Update webhook',
    'description' => 'Execute official Apify API operation `webhook_put`.

Endpoint: PUT /v2/webhooks/{webhookId}.',
    'type' => 'write',
    'tag' => 'Webhooks/Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook ID.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  199 =>
  [
    'operation' => 'webhook_delete',
    'slug' => 'apify_webhook_delete',
    'class' => 'ApifyWebhookDelete',
    'method' => 'DELETE',
    'path' => '/v2/webhooks/{webhookId}',
    'name' => 'Delete webhook',
    'description' => 'Execute official Apify API operation `webhook_delete`.

Endpoint: DELETE /v2/webhooks/{webhookId}.',
    'type' => 'write',
    'tag' => 'Webhooks/Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  200 =>
  [
    'operation' => 'webhook_test_post',
    'slug' => 'apify_webhook_test_post',
    'class' => 'ApifyWebhookTestPost',
    'method' => 'POST',
    'path' => '/v2/webhooks/{webhookId}/test',
    'name' => 'Test webhook',
    'description' => 'Execute official Apify API operation `webhook_test_post`.

Endpoint: POST /v2/webhooks/{webhookId}/test.',
    'type' => 'write',
    'tag' => 'Webhooks/Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  201 =>
  [
    'operation' => 'webhook_webhookDispatches_get',
    'slug' => 'apify_webhook_webhook_dispatches_get',
    'class' => 'ApifyWebhookWebhookDispatchesGet',
    'method' => 'GET',
    'path' => '/v2/webhooks/{webhookId}/dispatches',
    'name' => 'Get collection',
    'description' => 'Execute official Apify API operation `webhook_webhookDispatches_get`.

Endpoint: GET /v2/webhooks/{webhookId}/dispatches.',
    'type' => 'read',
    'tag' => 'Webhooks/Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  202 =>
  [
    'operation' => 'webhookDispatches_get',
    'slug' => 'apify_webhook_dispatches_get',
    'class' => 'ApifyWebhookDispatchesGet',
    'method' => 'GET',
    'path' => '/v2/webhook-dispatches',
    'name' => 'Get list of webhook dispatches',
    'description' => 'Execute official Apify API operation `webhookDispatches_get`.

Endpoint: GET /v2/webhook-dispatches.',
    'type' => 'read',
    'tag' => 'Webhooks/Webhook dispatches',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      2 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `createdAt` field in descending order. By default, they are sorted in ascending order.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  203 =>
  [
    'operation' => 'webhookDispatch_get',
    'slug' => 'apify_webhook_dispatch_get',
    'class' => 'ApifyWebhookDispatchGet',
    'method' => 'GET',
    'path' => '/v2/webhook-dispatches/{dispatchId}',
    'name' => 'Get webhook dispatch',
    'description' => 'Execute official Apify API operation `webhookDispatch_get`.

Endpoint: GET /v2/webhook-dispatches/{dispatchId}.',
    'type' => 'read',
    'tag' => 'Webhooks/Webhook dispatches',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'dispatchId',
        'param' => 'dispatch_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook dispatch ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  204 =>
  [
    'operation' => 'schedules_get',
    'slug' => 'apify_schedules_get',
    'class' => 'ApifySchedulesGet',
    'method' => 'GET',
    'path' => '/v2/schedules',
    'name' => 'Get list of schedules',
    'description' => 'Execute official Apify API operation `schedules_get`.

Endpoint: GET /v2/schedules.',
    'type' => 'read',
    'tag' => 'Schedules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      2 =>
      [
        'name' => 'desc',
        'param' => 'desc',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the objects are sorted by the `createdAt` field in descending order. By default, they are sorted in ascending order.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  205 =>
  [
    'operation' => 'schedules_post',
    'slug' => 'apify_schedules_post',
    'class' => 'ApifySchedulesPost',
    'method' => 'POST',
    'path' => '/v2/schedules',
    'name' => 'Create schedule',
    'description' => 'Execute official Apify API operation `schedules_post`.

Endpoint: POST /v2/schedules.',
    'type' => 'write',
    'tag' => 'Schedules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  206 =>
  [
    'operation' => 'schedule_get',
    'slug' => 'apify_schedule_get',
    'class' => 'ApifyScheduleGet',
    'method' => 'GET',
    'path' => '/v2/schedules/{scheduleId}',
    'name' => 'Get schedule',
    'description' => 'Execute official Apify API operation `schedule_get`.

Endpoint: GET /v2/schedules/{scheduleId}.',
    'type' => 'read',
    'tag' => 'Schedules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'scheduleId',
        'param' => 'schedule_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Schedule ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  207 =>
  [
    'operation' => 'schedule_put',
    'slug' => 'apify_schedule_put',
    'class' => 'ApifySchedulePut',
    'method' => 'PUT',
    'path' => '/v2/schedules/{scheduleId}',
    'name' => 'Update schedule',
    'description' => 'Execute official Apify API operation `schedule_put`.

Endpoint: PUT /v2/schedules/{scheduleId}.',
    'type' => 'write',
    'tag' => 'Schedules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'scheduleId',
        'param' => 'schedule_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Schedule ID.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  208 =>
  [
    'operation' => 'schedule_delete',
    'slug' => 'apify_schedule_delete',
    'class' => 'ApifyScheduleDelete',
    'method' => 'DELETE',
    'path' => '/v2/schedules/{scheduleId}',
    'name' => 'Delete schedule',
    'description' => 'Execute official Apify API operation `schedule_delete`.

Endpoint: DELETE /v2/schedules/{scheduleId}.',
    'type' => 'write',
    'tag' => 'Schedules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'scheduleId',
        'param' => 'schedule_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Schedule ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  209 =>
  [
    'operation' => 'schedule_log_get',
    'slug' => 'apify_schedule_log_get',
    'class' => 'ApifyScheduleLogGet',
    'method' => 'GET',
    'path' => '/v2/schedules/{scheduleId}/log',
    'name' => 'Get schedule log',
    'description' => 'Execute official Apify API operation `schedule_log_get`.

Endpoint: GET /v2/schedules/{scheduleId}/log.',
    'type' => 'read',
    'tag' => 'Schedules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'scheduleId',
        'param' => 'schedule_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Schedule ID.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  210 =>
  [
    'operation' => 'store_get',
    'slug' => 'apify_store_get',
    'class' => 'ApifyStoreGet',
    'method' => 'GET',
    'path' => '/v2/store',
    'name' => 'Get list of Actors in Store',
    'description' => 'Execute official Apify API operation `store_get`.

Endpoint: GET /v2/store.',
    'type' => 'read',
    'tag' => 'Store',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Maximum number of items to return. The default value as well as the maximum is `1000`.',
      ],
      1 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Number of items that should be skipped at the start. The default value is `0`.',
      ],
      2 =>
      [
        'name' => 'search',
        'param' => 'search',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'String to search by. The search runs on the following fields: `title`, `name`, `description`, `username`, `readme`.',
      ],
      3 =>
      [
        'name' => 'sortBy',
        'param' => 'sort_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies the field by which to sort the results. The supported values are `relevance` (default), `popularity`, `newest` and `lastUpdate`.',
      ],
      4 =>
      [
        'name' => 'category',
        'param' => 'category',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters the results by the specified category.',
      ],
      5 =>
      [
        'name' => 'username',
        'param' => 'username',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filters the results by the specified username.',
      ],
      6 =>
      [
        'name' => 'pricingModel',
        'param' => 'pricing_model',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Only return Actors with the specified pricing model.',
      ],
      7 =>
      [
        'name' => 'allowsAgenticUsers',
        'param' => 'allows_agentic_users',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If true, only return Actors that allow agentic users. If false, only return Actors that do not allow agentic users.',
      ],
      8 =>
      [
        'name' => 'responseFormat',
        'param' => 'response_format',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Controls the shape of the response. Use `full` (default) for the complete response including image URLs and all fields. Use `agent` for a reduced field set optimized for LLM con...',
      ],
      9 =>
      [
        'name' => 'includeUnrunnableActors',
        'param' => 'include_unrunnable_actors',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'By default, search results exclude Actors that are not safe to run automatically (e.g. Actors from developers who haven\'t passed KYC, or full-permission Actors without a large u...',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  211 =>
  [
    'operation' => 'log_get',
    'slug' => 'apify_log_get',
    'class' => 'ApifyLogGet',
    'method' => 'GET',
    'path' => '/v2/logs/{buildOrRunId}',
    'name' => 'Get log',
    'description' => 'Execute official Apify API operation `log_get`.

Endpoint: GET /v2/logs/{buildOrRunId}.',
    'type' => 'read',
    'tag' => 'Logs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'buildOrRunId',
        'param' => 'build_or_run_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the Actor build or run.',
      ],
      1 =>
      [
        'name' => 'stream',
        'param' => 'stream',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the logs will be streamed as long as the run or build is running.',
      ],
      2 =>
      [
        'name' => 'download',
        'param' => 'download',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1` then the web browser will download the log file rather than open it in a tab.',
      ],
      3 =>
      [
        'name' => 'raw',
        'param' => 'raw',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the logs will be kept verbatim. By default, the API removes ANSI escape codes from the logs, keeping only printable characters.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  212 =>
  [
    'operation' => 'user_get',
    'slug' => 'apify_user_get',
    'class' => 'ApifyUserGet',
    'method' => 'GET',
    'path' => '/v2/users/{userId}',
    'name' => 'Get public user data',
    'description' => 'Execute official Apify API operation `user_get`.

Endpoint: GET /v2/users/{userId}.',
    'type' => 'read',
    'tag' => 'Users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'userId',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'User ID or username.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  213 =>
  [
    'operation' => 'users_me_get',
    'slug' => 'apify_users_me_get',
    'class' => 'ApifyUsersMeGet',
    'method' => 'GET',
    'path' => '/v2/users/me',
    'name' => 'Get private user data',
    'description' => 'Execute official Apify API operation `users_me_get`.

Endpoint: GET /v2/users/me.',
    'type' => 'read',
    'tag' => 'Users',
    'parameters' =>
    [
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  214 =>
  [
    'operation' => 'users_me_usage_monthly_get',
    'slug' => 'apify_users_me_usage_monthly_get',
    'class' => 'ApifyUsersMeUsageMonthlyGet',
    'method' => 'GET',
    'path' => '/v2/users/me/usage/monthly',
    'name' => 'Get monthly usage',
    'description' => 'Execute official Apify API operation `users_me_usage_monthly_get`.

Endpoint: GET /v2/users/me/usage/monthly.',
    'type' => 'read',
    'tag' => 'Users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'date',
        'param' => 'date',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Date in the YYYY-MM-DD format.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  215 =>
  [
    'operation' => 'users_me_limits_get',
    'slug' => 'apify_users_me_limits_get',
    'class' => 'ApifyUsersMeLimitsGet',
    'method' => 'GET',
    'path' => '/v2/users/me/limits',
    'name' => 'Get limits',
    'description' => 'Execute official Apify API operation `users_me_limits_get`.

Endpoint: GET /v2/users/me/limits.',
    'type' => 'read',
    'tag' => 'Users',
    'parameters' =>
    [
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  216 =>
  [
    'operation' => 'users_me_limits_put',
    'slug' => 'apify_users_me_limits_put',
    'class' => 'ApifyUsersMeLimitsPut',
    'method' => 'PUT',
    'path' => '/v2/users/me/limits',
    'name' => 'Update limits',
    'description' => 'Execute official Apify API operation `users_me_limits_put`.

Endpoint: PUT /v2/users/me/limits.',
    'type' => 'write',
    'tag' => 'Users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  217 =>
  [
    'operation' => 'tools_browser_info_get',
    'slug' => 'apify_tools_browser_info_get',
    'class' => 'ApifyToolsBrowserInfoGet',
    'method' => 'GET',
    'path' => '/v2/browser-info',
    'name' => 'Get browser info',
    'description' => 'Execute official Apify API operation `tools_browser_info_get`.

Endpoint: GET /v2/browser-info.',
    'type' => 'read',
    'tag' => 'Tools',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'skipHeaders',
        'param' => 'skip_headers',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the response omits the `headers` field.',
      ],
      1 =>
      [
        'name' => 'rawHeaders',
        'param' => 'raw_headers',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the response includes the `rawHeaders` field with the raw request headers.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  218 =>
  [
    'operation' => 'tools_browser_info_post',
    'slug' => 'apify_tools_browser_info_post',
    'class' => 'ApifyToolsBrowserInfoPost',
    'method' => 'POST',
    'path' => '/v2/browser-info',
    'name' => 'Get browser info',
    'description' => 'Execute official Apify API operation `tools_browser_info_post`.

Endpoint: POST /v2/browser-info.',
    'type' => 'write',
    'tag' => 'Tools',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'skipHeaders',
        'param' => 'skip_headers',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the response omits the `headers` field.',
      ],
      1 =>
      [
        'name' => 'rawHeaders',
        'param' => 'raw_headers',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the response includes the `rawHeaders` field with the raw request headers.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  219 =>
  [
    'operation' => 'tools_browser_info_put',
    'slug' => 'apify_tools_browser_info_put',
    'class' => 'ApifyToolsBrowserInfoPut',
    'method' => 'PUT',
    'path' => '/v2/browser-info',
    'name' => 'Get browser info',
    'description' => 'Execute official Apify API operation `tools_browser_info_put`.

Endpoint: PUT /v2/browser-info.',
    'type' => 'write',
    'tag' => 'Tools',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'skipHeaders',
        'param' => 'skip_headers',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the response omits the `headers` field.',
      ],
      1 =>
      [
        'name' => 'rawHeaders',
        'param' => 'raw_headers',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the response includes the `rawHeaders` field with the raw request headers.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  220 =>
  [
    'operation' => 'tools_browser_info_delete',
    'slug' => 'apify_tools_browser_info_delete',
    'class' => 'ApifyToolsBrowserInfoDelete',
    'method' => 'DELETE',
    'path' => '/v2/browser-info',
    'name' => 'Get browser info',
    'description' => 'Execute official Apify API operation `tools_browser_info_delete`.

Endpoint: DELETE /v2/browser-info.',
    'type' => 'write',
    'tag' => 'Tools',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'skipHeaders',
        'param' => 'skip_headers',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the response omits the `headers` field.',
      ],
      1 =>
      [
        'name' => 'rawHeaders',
        'param' => 'raw_headers',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If `true` or `1`, the response includes the `rawHeaders` field with the raw request headers.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  221 =>
  [
    'operation' => 'tools_encode_and_sign_post',
    'slug' => 'apify_tools_encode_and_sign_post',
    'class' => 'ApifyToolsEncodeAndSignPost',
    'method' => 'POST',
    'path' => '/v2/tools/encode-and-sign',
    'name' => 'Encode and sign object',
    'description' => 'Execute official Apify API operation `tools_encode_and_sign_post`.

Endpoint: POST /v2/tools/encode-and-sign.',
    'type' => 'write',
    'tag' => 'Tools',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
  222 =>
  [
    'operation' => 'tools_decode_and_verify_post',
    'slug' => 'apify_tools_decode_and_verify_post',
    'class' => 'ApifyToolsDecodeAndVerifyPost',
    'method' => 'POST',
    'path' => '/v2/tools/decode-and-verify',
    'name' => 'Decode and verify object',
    'description' => 'Execute official Apify API operation `tools_decode_and_verify_post`.

Endpoint: POST /v2/tools/decode-and-verify.',
    'type' => 'write',
    'tag' => 'Tools',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Apify OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://docs.apify.com/api/openapi.json',
  ],
];
    }
}
