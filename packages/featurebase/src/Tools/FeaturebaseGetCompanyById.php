<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single company by its Featurebase ID. */
class FeaturebaseGetCompanyById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_company_by_id'; protected const DESCRIPTION = 'Retrieves a single company by its Featurebase ID.'; protected const OPERATION = 'getcompanybyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
