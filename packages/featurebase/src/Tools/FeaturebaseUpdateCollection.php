<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Updates an existing collection. Only include the fields you wish to update. */
class FeaturebaseUpdateCollection extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_update_collection'; protected const DESCRIPTION = 'Updates an existing collection. Only include the fields you wish to update.'; protected const OPERATION = 'updatecollection'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
