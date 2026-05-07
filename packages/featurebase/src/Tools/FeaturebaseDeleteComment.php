<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Deletes a comment by its unique identifier. */
class FeaturebaseDeleteComment extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_comment'; protected const DESCRIPTION = 'Deletes a comment by its unique identifier.'; protected const OPERATION = 'deletecomment'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
