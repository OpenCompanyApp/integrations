<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves details of form fields of an agreement.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /agreements/{agreementId}/formFields.
 */
class AdobeAcrobatSignAgreementsGetFormFields extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_get_form_fields';
    protected const DESCRIPTION = 'Retrieves details of form fields of an agreement.

Official Adobe Acrobat Sign endpoint: GET /agreements/{agreementId}/formFields

Retrieves details of form fields of an agreement.';
    protected const PARAMETERS = array (
  'x_api_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
  ),
  'participant_email' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The email address of the participant to be used to retrieve its associated form fields.',
  ),
  'agreement_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/agreements/{agreementId}/formFields';
    protected const PATH_PARAMS = array (
  'agreementId' => 'agreement_id',
);
    protected const QUERY_PARAMS = array (
  'participantEmail' => 'participant_email',
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
