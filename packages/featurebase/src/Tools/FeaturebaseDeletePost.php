<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Permanently deletes a post. This action cannot be undone. */
class FeaturebaseDeletePost extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_post'; protected const DESCRIPTION = 'Permanently deletes a post. This action cannot be undone.'; protected const OPERATION = 'deletepost'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
