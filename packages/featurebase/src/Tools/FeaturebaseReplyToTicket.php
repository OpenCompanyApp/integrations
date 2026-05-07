<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Adds a reply to a ticket's linked conversation. Supports both contact and admin replies. */
class FeaturebaseReplyToTicket extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_reply_to_ticket'; protected const DESCRIPTION = 'Adds a reply to a ticket\'s linked conversation. Supports both contact and admin replies.'; protected const OPERATION = 'replytoticket'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
