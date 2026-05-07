<?php

namespace OpenCompany\Integrations\GoogleDocs\Tools;

/**
 * Documents Create.
 *
 * Maps to the official Google Docs endpoint POST /v1/documents.
 */
class GoogleDocsDocumentsCreate extends AbstractGoogleDocsTool
{
    protected const NAME = 'google_docs_documents_create';
    protected const DESCRIPTION = 'Documents Create

Official Google Docs endpoint: POST /v1/documents
Creates a blank document using the title given in the request. Other fields in the request, including any provided content, are ignored. Returns the created document.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Docs API `Document` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/documents';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
