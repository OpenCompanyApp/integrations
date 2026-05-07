<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Creates a participantSet to which the agreement is forwarded for taking appropriate action.
 *
 * Maps to the official Adobe Acrobat Sign endpoint post /agreements/{agreementId}/members/participantSets/{participantSetId}/delegatedParticipantSets.
 */
class AdobeAcrobatSignAgreementsCreateDelegatedParticipantSets extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_create_delegated_participant_sets';
    protected const DESCRIPTION = 'Creates a participantSet to which the agreement is forwarded for taking appropriate action.

Official Adobe Acrobat Sign endpoint: POST /agreements/{agreementId}/members/participantSets/{participantSetId}/delegatedParticipantSets

Participants marked as delegator can call this API endpoint.';
    protected const PARAMETERS = array (
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Information about the delegate participant Set',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/agreements/{agreementId}/members/participantSets/{participantSetId}/delegatedParticipantSets';
    protected const PATH_PARAMS = array (
  'agreementId' => 'agreement_id',
  'participantSetId' => 'participant_set_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
