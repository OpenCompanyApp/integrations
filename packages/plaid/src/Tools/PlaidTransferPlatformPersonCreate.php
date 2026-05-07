<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a person associated with an originator.
 *
 * Maps to the official Plaid endpoint post /transfer/platform/person/create.
 */
class PlaidTransferPlatformPersonCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_platform_person_create';
    protected const DESCRIPTION = 'Create a person associated with an originator

Official Plaid endpoint: POST /transfer/platform/person/create

Use the `/transfer/platform/person/create` endpoint to create a person associated with an originator (e.g. beneficial owner or control person) and optionally submit personal identification information for them.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/platform/person/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}