<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Share an agreement with someone.
 *
 * Maps to the official Adobe Acrobat Sign endpoint post /agreements/{agreementId}/members/share.
 */
class AdobeAcrobatSignAgreementsCreateShareOnAgreement extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_create_share_on_agreement';
    protected const DESCRIPTION = 'Share an agreement with someone.

Official Adobe Acrobat Sign endpoint: POST /agreements/{agreementId}/members/share

Share an agreement with someone.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'List of agreement share creation information objects.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/agreements/{agreementId}/members/share';
    protected const PATH_PARAMS = array (
  'agreementId' => 'agreement_id',
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
