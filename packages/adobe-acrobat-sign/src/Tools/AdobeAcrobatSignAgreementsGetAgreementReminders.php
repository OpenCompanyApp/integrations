<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves the reminders of an agreement, identified by agreementId in the path.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /agreements/{agreementId}/reminders.
 */
class AdobeAcrobatSignAgreementsGetAgreementReminders extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_get_agreement_reminders';
    protected const DESCRIPTION = 'Retrieves the reminders of an agreement, identified by agreementId in the path.

Official Adobe Acrobat Sign endpoint: GET /agreements/{agreementId}/reminders

Retrieves the reminders of an agreement, identified by agreementId in the path.';
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
  'agreement_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma-separated list of reminder statuses of the reminders which should be returned in the response. Currently supported values are ACTIVE, CANCELED, COMPLETE',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/agreements/{agreementId}/reminders';
    protected const PATH_PARAMS = array (
  'agreementId' => 'agreement_id',
);
    protected const QUERY_PARAMS = array (
  'status' => 'status',
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
