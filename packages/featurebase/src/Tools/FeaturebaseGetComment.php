<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single comment by its unique identifier. */
class FeaturebaseGetComment extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_comment'; protected const DESCRIPTION = 'Retrieves a single comment by its unique identifier.'; protected const OPERATION = 'getcomment'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
