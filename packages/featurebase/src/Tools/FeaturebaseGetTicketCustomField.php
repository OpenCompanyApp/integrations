<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single custom field by its unique identifier. */
class FeaturebaseGetTicketCustomField extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_ticket_custom_field'; protected const DESCRIPTION = 'Retrieves a single custom field by its unique identifier.'; protected const OPERATION = 'getticketcustomfield'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
