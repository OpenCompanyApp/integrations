<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get Hosted Link session.
 *
 * Maps to the official Plaid endpoint post /link_delivery/get.
 */
class PlaidLinkDeliveryGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_link_delivery_get';
    protected const DESCRIPTION = 'Get Hosted Link session

Official Plaid endpoint: POST /link_delivery/get

Use the `/link_delivery/get` endpoint to get the status of a Hosted Link session.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/link_delivery/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}