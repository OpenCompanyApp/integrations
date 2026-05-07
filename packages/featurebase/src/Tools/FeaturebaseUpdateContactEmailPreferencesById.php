<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Updates one or more email preferences for a customer contact by their Featurebase ID. */
class FeaturebaseUpdateContactEmailPreferencesById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_update_contact_email_preferences_by_id'; protected const DESCRIPTION = 'Updates one or more email preferences for a customer contact by their Featurebase ID.'; protected const OPERATION = 'updatecontactemailpreferencesbyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
