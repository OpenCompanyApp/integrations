<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Updates the library document's state.
 *
 * Maps to the official Adobe Acrobat Sign endpoint put /libraryDocuments/{libraryDocumentId}/state.
 */
class AdobeAcrobatSignLibraryDocumentsUpdateLibraryDocumentState extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_library_documents_update_library_document_state';
    protected const DESCRIPTION = 'Updates the library document\'s state.

Official Adobe Acrobat Sign endpoint: PUT /libraryDocuments/{libraryDocumentId}/state

Currently state can be changed from AUTHORING to ACTIVE.';
    protected const PARAMETERS = array (
  'x_api_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
  ),
  'x_on_behalf_of_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email in the format userid:{userId} OR email:{email}. of the user that has shared his/her account',
  ),
  'if_match' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
  ),
  'library_document_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Information about the state of library document to which you want to update',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/libraryDocuments/{libraryDocumentId}/state';
    protected const PATH_PARAMS = array (
  'libraryDocumentId' => 'library_document_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
  'If-Match' => 'if_match',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
