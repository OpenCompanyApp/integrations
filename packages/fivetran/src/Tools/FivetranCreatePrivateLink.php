<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Create a Private Link.
 *
 * Maps to the official Fivetran endpoint post /v1/private-links.
 */
class FivetranCreatePrivateLink extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_create_private_link';
    protected const DESCRIPTION = 'Create a Private Link

Official Fivetran endpoint: POST /v1/private-links

Creates a new private link in your Fivetran account. > NOTE: See the [Set Up a Connection With Private Links tutorial](/docs/rest-api/tutorials/set-up-connection-with-private-links) to learn how to use this endpoint to set up a [database connection](/docs/connectors/databases) with [private networking](/docs/using-fivetran/features#privatenetworking).';
    protected const PARAMETERS = array (
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/private-links';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
