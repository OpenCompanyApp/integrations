<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves all user responses for a specific survey. */
class FeaturebaseGetSurveyResponses extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_survey_responses'; protected const DESCRIPTION = 'Retrieves all user responses for a specific survey.'; protected const OPERATION = 'getsurveyresponses'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
