<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a single statement..
 *
 * Maps to the official Plaid endpoint post /statements/download.
 */
class PlaidStatementsDownload extends AbstractPlaidTool
{
    protected const NAME = 'plaid_statements_download';
    protected const DESCRIPTION = 'Retrieve a single statement.

Official Plaid endpoint: POST /statements/download

The `/statements/download` endpoint retrieves a single statement PDF in binary format. The response will contain a `Plaid-Content-Hash` header containing a SHA 256 checksum of the statement. This can be used to verify that the file being sent by Plaid is the same file that was downloaded to your system.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/statements/download';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}