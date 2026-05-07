<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Trigger a new check session.
 *
 * Maps to the official Checkly endpoint POST /v2/check-sessions/trigger.
 */
class ChecklyPostV2ChecksessionsTrigger extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v2_checksessions_trigger';
    protected const DESCRIPTION = 'Trigger a new check session

Official Checkly endpoint: POST /v2/check-sessions/trigger.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/check-sessions/trigger';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
