<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves image urls of all visible pages of a document associated with a library document.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /libraryDocuments/{libraryDocumentId}/documents/{documentId}/imageUrls.
 */
class AdobeAcrobatSignLibraryDocumentsGetLibraryDocumentImageUrls extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_library_documents_get_library_document_image_urls';
    protected const DESCRIPTION = 'Retrieves image urls of all visible pages of a document associated with a library document.

Official Adobe Acrobat Sign endpoint: GET /libraryDocuments/{libraryDocumentId}/documents/{documentId}/imageUrls

Retrieves image urls of all visible pages of a document associated with a library document.';
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
  'if_none_match' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Pass the value of the e-tag header obtained from the previous response to the same request to get a RESOURCE_NOT_MODIFIED(304) if the resource hasn\'t changed.',
  ),
  'library_document_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
  ),
  'document_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The document identifier, as retrieved from the API which fetches the documents of a specified library document',
  ),
  'image_sizes' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma separated list of image sizes i.e. {FIXED_WIDTH_50px, FIXED_WIDTH_250px, FIXED_WIDTH_675px, ZOOM_50_PERCENT, ZOOM_75_PERCENT, ZOOM_100_PERCENT, ZOOM_125_PERCENT, ZOOM_150_PERCENT, ZOOM_200_PERCENT}. Default sizes returned are {FI...',
  ),
  'start_page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Start of page number range for which imageUrls are requested. Starting page number should be greater than 0.',
  ),
  'end_page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'End of page number range for which imageUrls are requested.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/libraryDocuments/{libraryDocumentId}/documents/{documentId}/imageUrls';
    protected const PATH_PARAMS = array (
  'libraryDocumentId' => 'library_document_id',
  'documentId' => 'document_id',
);
    protected const QUERY_PARAMS = array (
  'imageSizes' => 'image_sizes',
  'startPage' => 'start_page',
  'endPage' => 'end_page',
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
  'If-None-Match' => 'if_none_match',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
