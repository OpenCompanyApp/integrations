<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete a Private Link.
 *
 * Maps to the official Fivetran endpoint delete /v1/private-links/{privateLinkId}.
 */
class FivetranDeletePrivateLink extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_private_link';
    protected const DESCRIPTION = 'Delete a Private Link

Official Fivetran endpoint: DELETE /v1/private-links/{privateLinkId}

Deletes a private link from your Fivetran account.';
    protected const PARAMETERS = array (
  'private_link_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `privateLinkId` from the official Fivetran API operation. The unique identifier for the private link within the Fivetran system',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/private-links/{privateLinkId}';
    protected const PATH_PARAMS = array (
  'privateLinkId' => 'private_link_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
