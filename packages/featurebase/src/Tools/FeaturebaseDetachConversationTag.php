<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Removes a workspace tag from a conversation. */
class FeaturebaseDetachConversationTag extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_detach_conversation_tag'; protected const DESCRIPTION = 'Removes a workspace tag from a conversation.'; protected const OPERATION = 'detachconversationtag'; protected const PATH_PARAMS = array (
  0 => 'id',
  1 => 'tagId',
); }
