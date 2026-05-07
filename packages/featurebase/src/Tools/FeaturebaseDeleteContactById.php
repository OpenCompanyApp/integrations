<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Permanently deletes a contact by their Featurebase ID. */
class FeaturebaseDeleteContactById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_contact_by_id'; protected const DESCRIPTION = 'Permanently deletes a contact by their Featurebase ID.'; protected const OPERATION = 'deletecontactbyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
