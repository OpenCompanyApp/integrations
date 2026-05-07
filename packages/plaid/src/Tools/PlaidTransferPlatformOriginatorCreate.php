<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create an originator for Transfer for Platforms customers.
 *
 * Maps to the official Plaid endpoint post /transfer/platform/originator/create.
 */
class PlaidTransferPlatformOriginatorCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_platform_originator_create';
    protected const DESCRIPTION = 'Create an originator for Transfer for Platforms customers

Official Plaid endpoint: POST /transfer/platform/originator/create

Use the `/transfer/platform/originator/create` endpoint to submit information about the originator you are onboarding, including the originator\'s agreement to the required legal terms.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/platform/originator/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}