<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns all companies in your organization with cursor-based pagination. */
class FeaturebaseListCompanies extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_companies'; protected const DESCRIPTION = 'Returns all companies in your organization with cursor-based pagination.'; protected const OPERATION = 'listcompanies'; protected const PATH_PARAMS = array (
); }
