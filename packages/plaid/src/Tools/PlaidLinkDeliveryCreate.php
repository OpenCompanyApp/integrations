<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create Hosted Link session.
 *
 * Maps to the official Plaid endpoint post /link_delivery/create.
 */
class PlaidLinkDeliveryCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_link_delivery_create';
    protected const DESCRIPTION = 'Create Hosted Link session

Official Plaid endpoint: POST /link_delivery/create

Use the `/link_delivery/create` endpoint to create a Hosted Link session.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/link_delivery/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}