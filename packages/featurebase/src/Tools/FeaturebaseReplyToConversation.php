<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Adds a reply to an existing conversation. Supports both contact (customer/lead) and admin replies. */
class FeaturebaseReplyToConversation extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_reply_to_conversation'; protected const DESCRIPTION = 'Adds a reply to an existing conversation. Supports both contact (customer/lead) and admin replies.'; protected const OPERATION = 'replytoconversation'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
