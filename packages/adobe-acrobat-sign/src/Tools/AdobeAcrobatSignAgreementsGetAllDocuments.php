<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves the IDs of the documents of an agreement identified by agreementId.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /agreements/{agreementId}/documents.
 */
class AdobeAcrobatSignAgreementsGetAllDocuments extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_get_all_documents';
    protected const DESCRIPTION = 'Retrieves the IDs of the documents of an agreement identified by agreementId.

Official Adobe Acrobat Sign endpoint: GET /agreements/{agreementId}/documents

Retrieves the IDs of the documents of an agreement identified by agreementId.';
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
  'agreement_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
  ),
  'version_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The version identifier of agreement as provided by the API which retrieves information of a specific agreement. If not provided then latest version will be used.',
  ),
  'participant_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The participant identifier to be used to retrieve documents.',
  ),
  'supporting_document_content_format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Content format of the supported documents. It can have two possible values ORIGINAL or CONVERTED_PDF.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/agreements/{agreementId}/documents';
    protected const PATH_PARAMS = array (
  'agreementId' => 'agreement_id',
);
    protected const QUERY_PARAMS = array (
  'versionId' => 'version_id',
  'participantId' => 'participant_id',
  'supportingDocumentContentFormat' => 'supporting_document_content_format',
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
