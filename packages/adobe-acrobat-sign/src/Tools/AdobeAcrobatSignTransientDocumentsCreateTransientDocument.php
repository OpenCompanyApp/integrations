<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Uploads a document and obtains the document's ID.
 *
 * Maps to the official Adobe Acrobat Sign endpoint post /transientDocuments.
 */
class AdobeAcrobatSignTransientDocumentsCreateTransientDocument extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_transient_documents_create_transient_document';
    protected const DESCRIPTION = 'Uploads a document and obtains the document\'s ID.

Official Adobe Acrobat Sign endpoint: POST /transientDocuments

The document uploaded through this call is referred to as transient since it is available only for 7 days after the upload. The returned transient document ID can be used in the API calls where the uploaded file needs to be referred. The transient document...';
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
  'file_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A name for the document being uploaded. Maximum number of characters in the name is restricted to 255.',
  ),
  'mime_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The mime type of the document being uploaded. If not specified here then mime type is picked up from the file object. If mime type is not present there either then mime type is inferred from file name extension.',
  ),
  'file' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The file part of the multipart request for document upload. You can upload only one file at a time. Provide a local file path, or a string/array accepted by the host for multipart upload.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/transientDocuments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
);
    protected const FORM_PARAMS = array (
  'File-Name' => 'file_name',
  'Mime-Type' => 'mime_type',
  'File' => 'file',
);
    protected const FILE_PARAMS = array (
  'File' => 'file',
);
    protected const BODY_REQUIRED = false;
}
