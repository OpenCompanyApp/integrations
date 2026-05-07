<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a card's sensitive details.
 *
 * Maps to the official Ramp endpoint get /developer/v1/vault/cards/{card_id}.
 */
class RampGetCardVaultResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_card_vault_resource';
    protected const DESCRIPTION = 'Fetch a card\'s sensitive details

Official Ramp endpoint: GET /developer/v1/vault/cards/{card_id}

Accepts a card\'s ID and returns its sensitive details. Vault API access is required to use this endpoint.';
    protected const PARAMETERS = array (
  'card_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `card_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/vault/cards/{card_id}';
    protected const PATH_PARAMS = array (
  'card_id' => 'card_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
