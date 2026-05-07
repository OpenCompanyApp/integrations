<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single board by its unique identifier. */
class FeaturebaseGetBoard extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_board'; protected const DESCRIPTION = 'Retrieves a single board by its unique identifier.'; protected const OPERATION = 'getboard'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
