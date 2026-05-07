<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single ticket status by its unique identifier. */
class FeaturebaseGetTicketStatus extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_ticket_status'; protected const DESCRIPTION = 'Retrieves a single ticket status by its unique identifier.'; protected const OPERATION = 'getticketstatus'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
