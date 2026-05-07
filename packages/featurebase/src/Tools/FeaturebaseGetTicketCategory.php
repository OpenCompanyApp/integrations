<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single ticket category by its unique identifier. */
class FeaturebaseGetTicketCategory extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_ticket_category'; protected const DESCRIPTION = 'Retrieves a single ticket category by its unique identifier.'; protected const OPERATION = 'getticketcategory'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
