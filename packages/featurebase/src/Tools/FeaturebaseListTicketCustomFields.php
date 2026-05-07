<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns all custom fields configured in your organization that can be used on tickets. */
class FeaturebaseListTicketCustomFields extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_ticket_custom_fields'; protected const DESCRIPTION = 'Returns all custom fields configured in your organization that can be used on tickets.'; protected const OPERATION = 'listticketcustomfields'; protected const PATH_PARAMS = array (
); }
