<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Adds a voter (upvote) to a post. */
class FeaturebaseAddVoter extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_add_voter'; protected const DESCRIPTION = 'Adds a voter (upvote) to a post.'; protected const OPERATION = 'addvoter'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
