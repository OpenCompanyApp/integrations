<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Blocks a contact by their Featurebase ID from the messenger/inbox. */
class FeaturebaseBlockContactById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_block_contact_by_id'; protected const DESCRIPTION = 'Blocks a contact by their Featurebase ID from the messenger/inbox.'; protected const OPERATION = 'blockcontactbyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
