<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns a list of contacts (customers and leads) in your organization using cursor-based pagination. */
class FeaturebaseListContacts extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_contacts'; protected const DESCRIPTION = 'Returns a list of contacts (customers and leads) in your organization using cursor-based pagination.'; protected const OPERATION = 'listcontacts'; protected const PATH_PARAMS = array (
); }
