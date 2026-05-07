<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Updates an existing changelog by its unique identifier. */
class FeaturebaseUpdateChangelog extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_update_changelog'; protected const DESCRIPTION = 'Updates an existing changelog by its unique identifier.'; protected const OPERATION = 'updatechangelog'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
