<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Updates an existing post. Only provided fields will be modified. */
class FeaturebaseUpdatePost extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_update_post'; protected const DESCRIPTION = 'Updates an existing post. Only provided fields will be modified.'; protected const OPERATION = 'updatepost'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
