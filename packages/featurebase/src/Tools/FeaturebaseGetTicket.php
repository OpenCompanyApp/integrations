<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single ticket by its ticket number. */
class FeaturebaseGetTicket extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_ticket'; protected const DESCRIPTION = 'Retrieves a single ticket by its ticket number.'; protected const OPERATION = 'getticket'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
