<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single survey by its unique identifier. */
class FeaturebaseGetSurvey extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_survey'; protected const DESCRIPTION = 'Retrieves a single survey by its unique identifier.'; protected const OPERATION = 'getsurvey'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
