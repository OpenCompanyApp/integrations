<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves the participant set of an agreement identified by agreementId in the path.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /agreements/{agreementId}/members/participantSets/{participantSetId}.
 */
class AdobeAcrobatSignAgreementsGetParticipantSet extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_get_participant_set';
    protected const DESCRIPTION = 'Retrieves the participant set of an agreement identified by agreementId in the path.

Official Adobe Acrobat Sign endpoint: GET /agreements/{agreementId}/members/participantSets/{participantSetId}

Retrieves the participant set of an agreement identified by agreementId in the path.';
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
  'participant_set_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The participant set identifier',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/agreements/{agreementId}/members/participantSets/{participantSetId}';
    protected const PATH_PARAMS = array (
  'agreementId' => 'agreement_id',
  'participantSetId' => 'participant_set_id',
);
    protected const QUERY_PARAMS = array (
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
