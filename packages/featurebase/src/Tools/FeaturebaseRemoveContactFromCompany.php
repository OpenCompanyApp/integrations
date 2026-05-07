<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Removes a contact (customer) from a company. */
class FeaturebaseRemoveContactFromCompany extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_remove_contact_from_company'; protected const DESCRIPTION = 'Removes a contact (customer) from a company.'; protected const OPERATION = 'removecontactfromcompany'; protected const PATH_PARAMS = array (
  0 => 'id',
  1 => 'contactId',
); }
