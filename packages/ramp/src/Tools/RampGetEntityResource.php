<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Get a business entity.
 *
 * Maps to the official Ramp endpoint get /developer/v1/entities/{entity_id}.
 */
class RampGetEntityResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_entity_resource';
    protected const DESCRIPTION = 'Get a business entity

Official Ramp endpoint: GET /developer/v1/entities/{entity_id}';
    protected const PARAMETERS = array (
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `entity_id` from the official Ramp API operation.',
  ),
  'hide_inactive' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `hide_inactive` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/entities/{entity_id}';
    protected const PATH_PARAMS = array (
  'entity_id' => 'entity_id',
);
    protected const QUERY_PARAMS = array (
  'hide_inactive' => 'hide_inactive',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
