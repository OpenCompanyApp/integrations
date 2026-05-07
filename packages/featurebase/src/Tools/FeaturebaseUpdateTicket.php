<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Updates a ticket's properties. Only provided fields will be updated. */
class FeaturebaseUpdateTicket extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_update_ticket'; protected const DESCRIPTION = 'Updates a ticket\'s properties. Only provided fields will be updated.'; protected const OPERATION = 'updateticket'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
