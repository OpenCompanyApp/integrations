<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get transfer product configuration.
 *
 * Maps to the official Plaid endpoint post /transfer/configuration/get.
 */
class PlaidTransferConfigurationGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_configuration_get';
    protected const DESCRIPTION = 'Get transfer product configuration

Official Plaid endpoint: POST /transfer/configuration/get

Use the `/transfer/configuration/get` endpoint to view your transfer product configurations.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/configuration/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}