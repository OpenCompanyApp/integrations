<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create an embed init token for a card.
 *
 * Maps to the official Ramp endpoint post /developer/v1/embedded/cards/{card_id}/embed.
 */
class RampPostRampEmbeddedCardResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_ramp_embedded_card_resource';
    protected const DESCRIPTION = 'Create an embed init token for a card

Official Ramp endpoint: POST /developer/v1/embedded/cards/{card_id}/embed

The specified card must be activated and currently active';
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
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/embedded/cards/{card_id}/embed';
    protected const PATH_PARAMS = array (
  'card_id' => 'card_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
