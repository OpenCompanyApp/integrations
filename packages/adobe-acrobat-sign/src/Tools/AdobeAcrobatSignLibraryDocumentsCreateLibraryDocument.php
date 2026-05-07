<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Creates a template that is placed in the library of the user for reuse.
 *
 * Maps to the official Adobe Acrobat Sign endpoint post /libraryDocuments.
 */
class AdobeAcrobatSignLibraryDocumentsCreateLibraryDocument extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_library_documents_create_library_document';
    protected const DESCRIPTION = 'Creates a template that is placed in the library of the user for reuse.

Official Adobe Acrobat Sign endpoint: POST /libraryDocuments

Creates a template that is placed in the library of the user for reuse.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Information about the library document that you want to create.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/libraryDocuments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
