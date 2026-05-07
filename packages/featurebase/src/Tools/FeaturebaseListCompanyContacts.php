<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns all contacts (customers) attached to a specific company. */
class FeaturebaseListCompanyContacts extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_company_contacts'; protected const DESCRIPTION = 'Returns all contacts (customers) attached to a specific company.'; protected const OPERATION = 'listcompanycontacts'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
