<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * Resume monitoring of a check.
 *
 * Maps to the official Healthchecks.io endpoint POST /checks/{uuid}/resume.
 */
class HealthchecksIoResumeCheck extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_resume_check';
    protected const DESCRIPTION = 'Resume monitoring of a check

Official Healthchecks.io endpoint: POST https://healthchecks.io/api/v3/checks/{uuid}/resume.';
    protected const PARAMETERS = [
        'uuid' => [
            'type' => 'string',
            'required' => true,
            'description' => 'uuid path parameter',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/checks/{uuid}/resume';
    protected const PATH_PARAMS = [
        'uuid' => 'uuid',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
