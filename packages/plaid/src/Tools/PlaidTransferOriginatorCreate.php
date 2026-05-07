<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a new originator.
 *
 * Maps to the official Plaid endpoint post /transfer/originator/create.
 */
class PlaidTransferOriginatorCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_originator_create';
    protected const DESCRIPTION = 'Create a new originator

Official Plaid endpoint: POST /transfer/originator/create

Use the `/transfer/originator/create` endpoint to create a new originator and return an `originator_client_id`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/originator/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}