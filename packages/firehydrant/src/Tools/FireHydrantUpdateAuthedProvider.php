<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an authed provider.
 *
 * Maps to the official FireHydrant endpoint patch /v1/integrations/authed_providers/{integration_slug}/{connection_id}/{authed_provider_id}.
 */
class FireHydrantUpdateAuthedProvider extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_authed_provider';
    protected const DESCRIPTION = 'Get an authed provider

Official FireHydrant endpoint: PATCH /v1/integrations/authed_providers/{integration_slug}/{connection_id}/{authed_provider_id}

Retrieve a single authed provider';
    protected const PARAMETERS = array (
  'integration_slug' =>
  array (
    'type' => 'string',
    'description' => 'Integration slug',
    'required' => true,
  ),
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'Connection ID',
    'required' => true,
  ),
  'authed_provider_id' =>
  array (
    'type' => 'string',
    'description' => 'Authed provider ID',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/integrations/authed_providers/{integration_slug}/{connection_id}/{authed_provider_id}';
    protected const PATH_PARAMS = array (
  'integration_slug' => 'integration_slug',
  'connection_id' => 'connection_id',
  'authed_provider_id' => 'authed_provider_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
