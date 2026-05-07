<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns all posts (feedback submissions) for the authenticated organization. */
class FeaturebaseListPosts extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_posts'; protected const DESCRIPTION = 'Returns all posts (feedback submissions) for the authenticated organization.'; protected const OPERATION = 'listposts'; protected const PATH_PARAMS = array (
); }
