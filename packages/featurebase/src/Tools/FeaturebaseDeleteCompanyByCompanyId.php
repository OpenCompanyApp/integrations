<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Permanently deletes a company by its external company ID (the companyId from your system). */
class FeaturebaseDeleteCompanyByCompanyId extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_company_by_company_id'; protected const DESCRIPTION = 'Permanently deletes a company by its external company ID (the companyId from your system).'; protected const OPERATION = 'deletecompanybycompanyid'; protected const PATH_PARAMS = array (
  0 => 'companyId',
); }
