<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves library documents for a user.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /libraryDocuments.
 */
class AdobeAcrobatSignLibraryDocumentsGetLibraryDocuments extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_library_documents_get_library_documents';
    protected const DESCRIPTION = 'Retrieves library documents for a user.

Official Adobe Acrobat Sign endpoint: GET /libraryDocuments

Retrieves library documents for a user.';
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
  'show_hidden_library_documents' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'A query parameter to fetch all the hidden library documents along with the visible library documents.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Used to navigate through the pages. If not provided, returns the first page.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Number of intended items in the response page.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/libraryDocuments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'showHiddenLibraryDocuments' => 'show_hidden_library_documents',
  'cursor' => 'cursor',
  'pageSize' => 'page_size',
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
