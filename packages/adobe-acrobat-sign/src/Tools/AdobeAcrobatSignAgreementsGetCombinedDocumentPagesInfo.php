<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves info of all pages of a combined PDF document for the documents associated with an agreement.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /agreements/{agreementId}/combinedDocument/pagesInfo.
 */
class AdobeAcrobatSignAgreementsGetCombinedDocumentPagesInfo extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_get_combined_document_pages_info';
    protected const DESCRIPTION = 'Retrieves info of all pages of a combined PDF document for the documents associated with an agreement.

Official Adobe Acrobat Sign endpoint: GET /agreements/{agreementId}/combinedDocument/pagesInfo

Retrieves info of all pages of a combined PDF document for the documents associated with an agreement.';
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
  'include_supporting_documents_pages_info' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'When set to true, returns info of all pages of supporting documents as well. Else, return the info of pages of only the original document.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/agreements/{agreementId}/combinedDocument/pagesInfo';
    protected const PATH_PARAMS = array (
  'agreementId' => 'agreement_id',
);
    protected const QUERY_PARAMS = array (
  'includeSupportingDocumentsPagesInfo' => 'include_supporting_documents_pages_info',
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
