<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * List existing integrations/channels.
 *
 * Maps to the official Healthchecks.io endpoint GET /channels/.
 */
class HealthchecksIoListChannels extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_list_channels';
    protected const DESCRIPTION = 'List existing integrations/channels

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/channels/.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/channels/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
