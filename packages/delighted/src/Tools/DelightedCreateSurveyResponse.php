<?php
namespace OpenCompany\Integrations\Delighted\Tools;
/** Create a Delighted survey response. */
class DelightedCreateSurveyResponse extends AbstractDelightedTool { protected const NAME = 'delighted_create_survey_response'; protected const DESCRIPTION = 'Add a Delighted survey response manually.'; protected const OPERATION = 'create_survey_response'; protected const REQUIRED = ['person', 'score']; }
