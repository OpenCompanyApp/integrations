<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns all brands in your organization with cursor-based pagination. */
class FeaturebaseListBrands extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_brands'; protected const DESCRIPTION = 'Returns all brands in your organization with cursor-based pagination.'; protected const OPERATION = 'listbrands'; protected const PATH_PARAMS = array (
); }
