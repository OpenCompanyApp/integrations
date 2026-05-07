<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns a single conversation tag by its Featurebase tag ID. Archived tags can still be retrieved directly by ID, while permanently deleted tags return 404. */
class FeaturebaseGetTagById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_tag_by_id'; protected const DESCRIPTION = 'Returns a single conversation tag by its Featurebase tag ID. Archived tags can still be retrieved directly by ID, while permanently deleted tags return 404.'; protected const OPERATION = 'gettagbyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
