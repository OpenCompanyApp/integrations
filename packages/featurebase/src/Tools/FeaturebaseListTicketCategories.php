<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns all ticket categories for the authenticated organization. */
class FeaturebaseListTicketCategories extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_ticket_categories'; protected const DESCRIPTION = 'Returns all ticket categories for the authenticated organization.'; protected const OPERATION = 'listticketcategories'; protected const PATH_PARAMS = array (
); }
