<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single contact by their Featurebase ID. */
class FeaturebaseGetContactById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_contact_by_id'; protected const DESCRIPTION = 'Retrieves a single contact by their Featurebase ID.'; protected const OPERATION = 'getcontactbyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
