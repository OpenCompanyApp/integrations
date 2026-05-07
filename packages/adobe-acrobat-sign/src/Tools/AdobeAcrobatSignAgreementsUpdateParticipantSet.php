<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Updates the participant set of an agreement identified by agreementId in the path.
 *
 * Maps to the official Adobe Acrobat Sign endpoint put /agreements/{agreementId}/members/participantSets/{participantSetId}.
 */
class AdobeAcrobatSignAgreementsUpdateParticipantSet extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_update_participant_set';
    protected const DESCRIPTION = 'Updates the participant set of an agreement identified by agreementId in the path.

Official Adobe Acrobat Sign endpoint: PUT /agreements/{agreementId}/members/participantSets/{participantSetId}

Updates the participant set of an agreement identified by agreementId in the path.';
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
    'description' => 'The new participant set info.',
  ),
);
    protected const METHOD = 'PUT';
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
  'If-Match' => 'if_match',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
