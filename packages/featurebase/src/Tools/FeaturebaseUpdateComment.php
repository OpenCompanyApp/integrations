<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Updates an existing comment by its unique identifier. */
class FeaturebaseUpdateComment extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_update_comment'; protected const DESCRIPTION = 'Updates an existing comment by its unique identifier.'; protected const OPERATION = 'updatecomment'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
