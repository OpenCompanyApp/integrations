<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Removes a contact (customer or lead) from an existing conversation. */
class FeaturebaseRemoveParticipantFromConversation extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_remove_participant_from_conversation'; protected const DESCRIPTION = 'Removes a contact (customer or lead) from an existing conversation.'; protected const OPERATION = 'removeparticipantfromconversation'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
