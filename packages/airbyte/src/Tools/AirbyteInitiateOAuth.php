<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Initiate OAuth for a source.
 *
 * Maps to the official Airbyte endpoint post /sources/initiateOAuth.
 */
class AirbyteInitiateOAuth extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_initiate_oauth';
    protected const DESCRIPTION = 'Initiate OAuth for a source

Official Airbyte endpoint: POST /sources/initiateOAuth

Given a source ID, workspace ID, and redirect URL, initiates OAuth for the source. This returns a fully formed URL for performing user authentication against the relevant source identity provider (IdP). Once authentication has been completed, the IdP will redirect to an Airbyte endpoint which will save the access and refresh tokens off as a secret and return the secret ID to the redirect URL specified in the `secret_id` query string parameter. That secret ID can be used to create a source with credentials in place of actual tokens.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Airbyte API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sources/initiateOAuth';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
