<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update a card.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/cards/{card_id}.
 */
class RampPatchCardResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_card_resource';
    protected const DESCRIPTION = 'Update a card

Official Ramp endpoint: PATCH /developer/v1/cards/{card_id}

This endpoint allow you update the owner, display name, and spend restrictions of a card.';
    protected const PARAMETERS = array (
  'card_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `card_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/cards/{card_id}';
    protected const PATH_PARAMS = array (
  'card_id' => 'card_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
