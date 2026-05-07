<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns all voters (upvoters) for a specific post. */
class FeaturebaseListVoters extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_voters'; protected const DESCRIPTION = 'Returns all voters (upvoters) for a specific post.'; protected const OPERATION = 'listvoters'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
