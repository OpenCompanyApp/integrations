<?php

namespace OpenCompany\Integrations\GoogleDocs\Tools;

/**
 * Documents Get.
 *
 * Maps to the official Google Docs endpoint GET /v1/documents/{documentId}.
 */
class GoogleDocsDocumentsGet extends AbstractGoogleDocsTool
{
    protected const NAME = 'google_docs_documents_get';
    protected const DESCRIPTION = 'Documents Get

Official Google Docs endpoint: GET /v1/documents/{documentId}
Gets the latest version of the specified document.';
    protected const PARAMETERS = array (
  'documentId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `documentId` from the official Google Docs API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Docs method. Known keys: includeTabsContent, suggestionsViewMode.',
  ),
  'includeTabsContent' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether to populate the Document.tabs field instead of the text content fields like `body` and `documentStyle` on Document. - When `True`: Document content populates in the Document.tabs field instead of the text content fields in Document. - When `False`: The content of the document\'s first tab populates the content fields in Document excluding Document.tabs. If a document has only one tab, then that tab is used to populate the document content. Document.tabs will be empty.',
  ),
  'suggestionsViewMode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The suggestions view mode to apply to the document. This allows viewing the document with all suggestions inline, accepted or rejected. If one is not specified, DEFAULT_FOR_CURRENT_ACCESS is used.',
    'enum' =>
    array (
      0 => 'DEFAULT_FOR_CURRENT_ACCESS',
      1 => 'SUGGESTIONS_INLINE',
      2 => 'PREVIEW_SUGGESTIONS_ACCEPTED',
      3 => 'PREVIEW_WITHOUT_SUGGESTIONS',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/documents/{documentId}';
    protected const PATH_PARAMS = array (
  0 => 'documentId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'includeTabsContent',
  1 => 'suggestionsViewMode',
);
    protected const BODY_REQUIRED = false;
}
