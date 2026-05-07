<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves a single combined PDF document for the documents associated with an agreement.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /agreements/{agreementId}/combinedDocument.
 */
class AdobeAcrobatSignAgreementsGetCombinedDocument extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_get_combined_document';
    protected const DESCRIPTION = 'Retrieves a single combined PDF document for the documents associated with an agreement.

Official Adobe Acrobat Sign endpoint: GET /agreements/{agreementId}/combinedDocument

Retrieves a single combined PDF document for the documents associated with an agreement.';
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
  'attach_supporting_documents' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'When set to true, attach corresponding supporting documents to the signed agreement PDF. Default value of this parameter is true.',
  ),
  'attach_audit_report' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'When set to true, attach an audit report to the signed agreement PDF. Default value is false',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/agreements/{agreementId}/combinedDocument';
    protected const PATH_PARAMS = array (
  'agreementId' => 'agreement_id',
);
    protected const QUERY_PARAMS = array (
  'versionId' => 'version_id',
  'participantId' => 'participant_id',
  'attachSupportingDocuments' => 'attach_supporting_documents',
  'attachAuditReport' => 'attach_audit_report',
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
