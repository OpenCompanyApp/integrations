<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves the email preference state for a customer contact by their Featurebase ID. */
class FeaturebaseGetContactEmailPreferencesById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_contact_email_preferences_by_id'; protected const DESCRIPTION = 'Retrieves the email preference state for a customer contact by their Featurebase ID.'; protected const OPERATION = 'getcontactemailpreferencesbyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
