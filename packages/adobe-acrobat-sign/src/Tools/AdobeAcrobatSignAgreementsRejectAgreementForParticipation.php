<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Rejects the agreement for a participant.
 *
 * Maps to the official Adobe Acrobat Sign endpoint put /agreements/{agreementId}/members/participantSets/{participantSetId}/participants/{participantId}/reject.
 */
class AdobeAcrobatSignAgreementsRejectAgreementForParticipation extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_reject_agreement_for_participation';
    protected const DESCRIPTION = 'Rejects the agreement for a participant.

Official Adobe Acrobat Sign endpoint: PUT /agreements/{agreementId}/members/participantSets/{participantSetId}/participants/{participantId}/reject

Rejects the agreement for a participant.';
    protected const PARAMETERS = array (
  'if_match' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
  ),
  'x_api_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
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
  'participant_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The participant identifier',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Participant rejection information required for rejecting the agreement',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/agreements/{agreementId}/members/participantSets/{participantSetId}/participants/{participantId}/reject';
    protected const PATH_PARAMS = array (
  'agreementId' => 'agreement_id',
  'participantSetId' => 'participant_set_id',
  'participantId' => 'participant_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'If-Match' => 'if_match',
  'x-api-user' => 'x_api_user',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
