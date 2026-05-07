<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Update the organization's current subscription for Password Manager and/or Secrets Manager.
 *
 * Maps to the official Bitwarden Public API endpoint put /public/organization/subscription.
 */
class BitwardenOrganizationPostSubscription extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_organization_post_subscription';
    protected const DESCRIPTION = 'Update the organization\'s current subscription for Password Manager and/or Secrets Manager.

Official Bitwarden Public API endpoint: PUT /public/organization/subscription

Update the organization\'s current subscription for Password Manager and/or Secrets Manager.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/public/organization/subscription';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
