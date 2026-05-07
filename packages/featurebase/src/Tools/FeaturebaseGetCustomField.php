<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single custom field by its unique identifier. */
class FeaturebaseGetCustomField extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_custom_field'; protected const DESCRIPTION = 'Retrieves a single custom field by its unique identifier.'; protected const OPERATION = 'getcustomfield'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
