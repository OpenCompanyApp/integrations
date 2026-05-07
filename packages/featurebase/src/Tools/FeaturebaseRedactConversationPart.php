<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Redacts a conversation part (message) from a conversation. Redaction permanently removes the message content while preserving the conversation structure. */
class FeaturebaseRedactConversationPart extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_redact_conversation_part'; protected const DESCRIPTION = 'Redacts a conversation part (message) from a conversation. Redaction permanently removes the message content while preserving the conversation structure.'; protected const OPERATION = 'redactconversationpart'; protected const PATH_PARAMS = array (
); }
