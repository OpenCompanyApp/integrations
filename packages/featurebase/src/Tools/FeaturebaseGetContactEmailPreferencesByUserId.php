<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves the email preference state for a customer contact by their external user ID. */
class FeaturebaseGetContactEmailPreferencesByUserId extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_contact_email_preferences_by_user_id'; protected const DESCRIPTION = 'Retrieves the email preference state for a customer contact by their external user ID.'; protected const OPERATION = 'getcontactemailpreferencesbyuserid'; protected const PATH_PARAMS = array (
  0 => 'userId',
); }
