<?php

namespace OpenCompany\Integrations\GoogleDocs\Tools;

/**
 * Documents Batch Update.
 *
 * Maps to the official Google Docs endpoint POST /v1/documents/{documentId}:batchUpdate.
 */
class GoogleDocsDocumentsBatchUpdate extends AbstractGoogleDocsTool
{
    protected const NAME = 'google_docs_documents_batch_update';
    protected const DESCRIPTION = 'Documents Batch Update

Official Google Docs endpoint: POST /v1/documents/{documentId}:batchUpdate
Applies one or more updates to the document. Each request is validated before being applied. If any request is not valid, then the entire request will fail and nothing will be applied. Some requests have replies to give you some information about how they are applied. Other requests do not need to return information; these each return an empty reply. The order of replies matches that of the requests. For example, suppose you call batchUpdate with four updates, and only the third one returns information. The response would have two empty replies, the reply to the third request, and another empty reply, in that order. Because other users may be editing the document, the document might not exactly reflect your changes: your changes may be altered with respect to collaborator changes. If there are no collaborators, the document should reflect your changes. In any case, the updates in your request are guaranteed to be applied together atomically.';
    protected const PARAMETERS = array (
  'documentId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `documentId` from the official Google Docs API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Docs API `BatchUpdateDocumentRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/documents/{documentId}:batchUpdate';
    protected const PATH_PARAMS = array (
  0 => 'documentId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
