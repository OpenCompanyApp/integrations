<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single admin by their unique identifier. */
class FeaturebaseGetAdmin extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_admin'; protected const DESCRIPTION = 'Retrieves a single admin by their unique identifier.'; protected const OPERATION = 'getadmin'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
