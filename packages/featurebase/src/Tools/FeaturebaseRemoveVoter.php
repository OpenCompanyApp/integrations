<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Removes a voter (upvote) from a post. */
class FeaturebaseRemoveVoter extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_remove_voter'; protected const DESCRIPTION = 'Removes a voter (upvote) from a post.'; protected const OPERATION = 'removevoter'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
