<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Permanently deletes a contact by their external user ID. */
class FeaturebaseDeleteContactByUserId extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_contact_by_user_id'; protected const DESCRIPTION = 'Permanently deletes a contact by their external user ID.'; protected const OPERATION = 'deletecontactbyuserid'; protected const PATH_PARAMS = array (
  0 => 'userId',
); }
