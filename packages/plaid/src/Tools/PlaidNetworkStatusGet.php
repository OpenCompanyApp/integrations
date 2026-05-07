<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Check a user's Plaid Network status.
 *
 * Maps to the official Plaid endpoint post /network/status/get.
 */
class PlaidNetworkStatusGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_network_status_get';
    protected const DESCRIPTION = 'Check a user\'s Plaid Network status

Official Plaid endpoint: POST /network/status/get

The `/network/status/get` endpoint can be used to check whether Plaid has a matching profile for the user. This is useful for determining if a user is eligible for a streamlined experience, such as Layer. To access this endpoint, contact your Plaid Account Manager. Note: it is strongly recommended to check for Layer eligibility in the frontend. `/network/status/get` should only be used for checking Layer eligibility if a frontend check is not possible for your use case. For instructions on performing a frontend eligibility check, see the [Layer documentation](https://plaid.com/docs/layer/#integration-overview).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/network/status/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}