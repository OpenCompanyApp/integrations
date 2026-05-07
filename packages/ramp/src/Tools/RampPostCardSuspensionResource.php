<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Suspend a card.
 *
 * Maps to the official Ramp endpoint post /developer/v1/cards/{card_id}/deferred/suspension.
 */
class RampPostCardSuspensionResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_card_suspension_resource';
    protected const DESCRIPTION = 'Suspend a card

Official Ramp endpoint: POST /developer/v1/cards/{card_id}/deferred/suspension

Call this endpoint to create an async task to suspend a card so that it is locked from use. The suspension is revertable.';
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
    protected const PATH = '/developer/v1/cards/{card_id}/deferred/suspension';
    protected const PATH_PARAMS = array (
  'card_id' => 'card_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
