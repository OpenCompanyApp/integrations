<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single brand by its Featurebase ID. */
class FeaturebaseGetBrandById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_brand_by_id'; protected const DESCRIPTION = 'Retrieves a single brand by its Featurebase ID.'; protected const OPERATION = 'getbrandbyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
