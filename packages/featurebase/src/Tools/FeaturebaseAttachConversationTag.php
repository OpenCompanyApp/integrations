<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Attaches a workspace tag to a conversation. */
class FeaturebaseAttachConversationTag extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_attach_conversation_tag'; protected const DESCRIPTION = 'Attaches a workspace tag to a conversation.'; protected const OPERATION = 'attachconversationtag'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
