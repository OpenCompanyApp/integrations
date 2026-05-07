<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Deletes a changelog by its unique identifier. */
class FeaturebaseDeleteChangelog extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_changelog'; protected const DESCRIPTION = 'Deletes a changelog by its unique identifier.'; protected const OPERATION = 'deletechangelog'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
