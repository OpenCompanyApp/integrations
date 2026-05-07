<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Deletes a company by its Featurebase ID. */
class FeaturebaseDeleteCompanyById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_company_by_id'; protected const DESCRIPTION = 'Deletes a company by its Featurebase ID.'; protected const OPERATION = 'deletecompanybyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
