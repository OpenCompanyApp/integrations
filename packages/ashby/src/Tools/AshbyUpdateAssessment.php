<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Update an Ashby assessment integration status. */
class AshbyUpdateAssessment extends AbstractAshbyTool
{
    protected const NAME = 'ashby_update_assessment';
    protected const DESCRIPTION = 'Update Ashby about a started assessment status or result.';
    protected const ENDPOINT = '/assessment.update';
    protected const REQUIRED = ['assessment_id', 'timestamp'];
    protected const BODY_KEYS = ['assessment_id', 'timestamp', 'assessment_status', 'assessment_profile_url', 'assessment_result', 'cancelled_reason', 'metadata'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'assessment_id' => ['type' => 'string', 'required' => true, 'description' => 'Assessment UUID.'],
        'timestamp' => ['type' => 'integer', 'required' => true, 'description' => 'Event timestamp in milliseconds since Unix epoch.'],
        'body' => ['type' => 'object', 'description' => 'Raw assessment.update body.'],
    ];
}
