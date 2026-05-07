<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * Pause monitoring of a check.
 *
 * Maps to the official Healthchecks.io endpoint POST /checks/{uuid}/pause.
 */
class HealthchecksIoPauseCheck extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_pause_check';
    protected const DESCRIPTION = 'Pause monitoring of a check

Official Healthchecks.io endpoint: POST https://healthchecks.io/api/v3/checks/{uuid}/pause.';
    protected const PARAMETERS = [
        'uuid' => [
            'type' => 'string',
            'required' => true,
            'description' => 'uuid path parameter',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/checks/{uuid}/pause';
    protected const PATH_PARAMS = [
        'uuid' => 'uuid',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
