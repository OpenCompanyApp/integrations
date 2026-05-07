<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single contact by their external user ID (from your system via SSO). */
class FeaturebaseGetContactByUserId extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_contact_by_user_id'; protected const DESCRIPTION = 'Retrieves a single contact by their external user ID (from your system via SSO).'; protected const OPERATION = 'getcontactbyuserid'; protected const PATH_PARAMS = array (
  0 => 'userId',
); }
