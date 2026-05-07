<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a spend limit and retrieve sensitive card details.
 *
 * Maps to the official Ramp endpoint post /developer/v1/vault/cards.
 */
class RampPostCardVaultCreation extends AbstractRampTool
{
    protected const NAME = 'ramp_post_card_vault_creation';
    protected const DESCRIPTION = 'Create a spend limit and retrieve sensitive card details

Official Ramp endpoint: POST /developer/v1/vault/cards

Vault API access is required to use this endpoint.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/vault/cards';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
