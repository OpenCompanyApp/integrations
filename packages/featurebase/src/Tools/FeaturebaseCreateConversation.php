<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Creates a new conversation. Supports both contact-initiated (customer/lead) and admin-initiated (outreach) conversations. */
class FeaturebaseCreateConversation extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_create_conversation'; protected const DESCRIPTION = 'Creates a new conversation. Supports both contact-initiated (customer/lead) and admin-initiated (outreach) conversations.'; protected const OPERATION = 'createconversation'; protected const PATH_PARAMS = array (
); }
