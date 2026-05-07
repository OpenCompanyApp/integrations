<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns all boards (post categories) for the authenticated organization. */
class FeaturebaseListBoards extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_boards'; protected const DESCRIPTION = 'Returns all boards (post categories) for the authenticated organization.'; protected const OPERATION = 'listboards'; protected const PATH_PARAMS = array (
); }
