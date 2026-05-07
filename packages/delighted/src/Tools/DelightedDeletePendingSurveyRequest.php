<?php
namespace OpenCompany\Integrations\Delighted\Tools;
/** Delete pending survey requests for a person. */
class DelightedDeletePendingSurveyRequest extends AbstractDelightedTool { protected const NAME = 'delighted_delete_pending_survey_request'; protected const DESCRIPTION = 'Delete pending survey requests for a person identifier.'; protected const OPERATION = 'delete_pending_survey_request'; protected const REQUIRED = ['person_identifier']; }
