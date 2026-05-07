<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Updates one or more email preferences for a customer contact by their external user ID. */
class FeaturebaseUpdateContactEmailPreferencesByUserId extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_update_contact_email_preferences_by_user_id'; protected const DESCRIPTION = 'Updates one or more email preferences for a customer contact by their external user ID.'; protected const OPERATION = 'updatecontactemailpreferencesbyuserid'; protected const PATH_PARAMS = array (
  0 => 'userId',
); }
