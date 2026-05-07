<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single conversation by its ID, including conversation parts (messages). */
class FeaturebaseGetConversationById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_conversation_by_id'; protected const DESCRIPTION = 'Retrieves a single conversation by its ID, including conversation parts (messages).'; protected const OPERATION = 'getconversationbyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
