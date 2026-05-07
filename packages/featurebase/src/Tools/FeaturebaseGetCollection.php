<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a specific collection by its unique identifier. */
class FeaturebaseGetCollection extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_collection'; protected const DESCRIPTION = 'Retrieves a specific collection by its unique identifier.'; protected const OPERATION = 'getcollection'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
