<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single changelog by its unique identifier or slug. */
class FeaturebaseGetChangelog extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_changelog'; protected const DESCRIPTION = 'Retrieves a single changelog by its unique identifier or slug.'; protected const OPERATION = 'getchangelog'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
