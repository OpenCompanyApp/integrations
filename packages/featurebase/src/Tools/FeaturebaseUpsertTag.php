<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Creates a new workspace conversation tag when only name is provided. If id is also provided, the existing tag is renamed instead. */
class FeaturebaseUpsertTag extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_upsert_tag'; protected const DESCRIPTION = 'Creates a new workspace conversation tag when only name is provided. If id is also provided, the existing tag is renamed instead.'; protected const OPERATION = 'upserttag'; protected const PATH_PARAMS = array (
); }
