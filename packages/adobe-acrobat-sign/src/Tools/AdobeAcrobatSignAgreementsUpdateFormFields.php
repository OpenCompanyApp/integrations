<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Updates form fields of an agreement.
 *
 * Maps to the official Adobe Acrobat Sign endpoint put /agreements/{agreementId}/formFields.
 */
class AdobeAcrobatSignAgreementsUpdateFormFields extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_update_form_fields';
    protected const DESCRIPTION = 'Updates form fields of an agreement.

Official Adobe Acrobat Sign endpoint: PUT /agreements/{agreementId}/formFields

Updates form fields of an agreement.';
    protected const PARAMETERS = array (
  'x_api_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
  ),
  'if_match' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
  ),
  'agreement_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'List of form fields to add or replace',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/agreements/{agreementId}/formFields';
    protected const PATH_PARAMS = array (
  'agreementId' => 'agreement_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'If-Match' => 'if_match',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
