<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Attaches a contact (customer) to a company. */
class FeaturebaseAttachContactToCompany extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_attach_contact_to_company'; protected const DESCRIPTION = 'Attaches a contact (customer) to a company.'; protected const OPERATION = 'attachcontacttocompany'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
