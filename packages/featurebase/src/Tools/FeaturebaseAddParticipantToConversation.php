<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Adds a contact (customer or lead) as a participant to an existing conversation. */
class FeaturebaseAddParticipantToConversation extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_add_participant_to_conversation'; protected const DESCRIPTION = 'Adds a contact (customer or lead) as a participant to an existing conversation.'; protected const OPERATION = 'addparticipanttoconversation'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
