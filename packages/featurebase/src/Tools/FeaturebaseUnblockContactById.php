<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Unblocks a contact by their Featurebase ID from the messenger/inbox. */
class FeaturebaseUnblockContactById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_unblock_contact_by_id'; protected const DESCRIPTION = 'Unblocks a contact by their Featurebase ID from the messenger/inbox.'; protected const OPERATION = 'unblockcontactbyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
