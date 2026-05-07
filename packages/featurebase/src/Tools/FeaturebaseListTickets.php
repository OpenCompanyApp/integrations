<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns a list of tickets in your organization using cursor-based pagination. */
class FeaturebaseListTickets extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_tickets'; protected const DESCRIPTION = 'Returns a list of tickets in your organization using cursor-based pagination.'; protected const OPERATION = 'listtickets'; protected const PATH_PARAMS = array (
); }
