<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Permanently deletes a conversation by its short ID. */
class FeaturebaseDeleteConversation extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_conversation'; protected const DESCRIPTION = 'Permanently deletes a conversation by its short ID.'; protected const OPERATION = 'deleteconversation'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
