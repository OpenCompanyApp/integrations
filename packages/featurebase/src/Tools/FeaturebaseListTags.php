<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns the live conversation tags available in the workspace tag catalog. These are the canonical tags that power conversation payloads, filters, and tag mutation endpoints. */
class FeaturebaseListTags extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_tags'; protected const DESCRIPTION = 'Returns the live conversation tags available in the workspace tag catalog. These are the canonical tags that power conversation payloads, filters, and tag mutation endpoints.'; protected const OPERATION = 'listtags'; protected const PATH_PARAMS = array (
); }
