<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Returns uploaded document identity.
 *
 * Maps to the official Plaid endpoint post /identity/documents/uploads/get.
 */
class PlaidIdentityDocumentsUploadsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_identity_documents_uploads_get';
    protected const DESCRIPTION = 'Returns uploaded document identity

Official Plaid endpoint: POST /identity/documents/uploads/get

Use `/identity/documents/uploads/get` to retrieve identity details when using [Identity Document Upload](https://plaid.com/docs/identity/identity-document-upload/).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/identity/documents/uploads/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}