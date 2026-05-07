<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns a list of conversations in your organization using cursor-based pagination. */
class FeaturebaseListConversations extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_conversations'; protected const DESCRIPTION = 'Returns a list of conversations in your organization using cursor-based pagination.'; protected const OPERATION = 'listconversations'; protected const PATH_PARAMS = array (
); }
