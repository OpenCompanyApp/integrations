<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Set API resource as default.
 *
 * Maps to PATCH /api/resources/{id}/is-default in the official Logto OpenAPI source.
 */
class LogtoUpdateResourceIsDefault extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_resource_is_default',
  'class' => 'LogtoUpdateResourceIsDefault',
  'method' => 'PATCH',
  'path' => '/api/resources/{id}/is-default',
  'operation_id' => 'UpdateResourceIsDefault',
  'summary' => 'Set API resource as default',
  'description' => 'Set an API resource as the default resource for the current tenant. Each tenant can have only one default API resource. If an API resource is set as default, the previously set default API resource will be set as non-default. See [this section](https://docs.logto.io/docs/references/resources/#default-api) for more information.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the resource.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
