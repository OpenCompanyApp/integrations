<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Deletes an existing collection. */
class FeaturebaseDeleteCollection extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_collection'; protected const DESCRIPTION = 'Deletes an existing collection.'; protected const OPERATION = 'deletecollection'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
