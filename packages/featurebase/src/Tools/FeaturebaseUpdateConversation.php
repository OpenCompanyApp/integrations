<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Updates a conversation's properties. Supports partial updates - only provided fields will be updated. */
class FeaturebaseUpdateConversation extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_update_conversation'; protected const DESCRIPTION = 'Updates a conversation\'s properties. Supports partial updates - only provided fields will be updated.'; protected const OPERATION = 'updateconversation'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
