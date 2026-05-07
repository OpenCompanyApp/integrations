<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Permanently deletes a ticket by its ticket number. */
class FeaturebaseDeleteTicket extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_ticket'; protected const DESCRIPTION = 'Permanently deletes a ticket by its ticket number.'; protected const OPERATION = 'deleteticket'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
