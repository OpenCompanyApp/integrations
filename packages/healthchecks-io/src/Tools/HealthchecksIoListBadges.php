<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * List project's badges.
 *
 * Maps to the official Healthchecks.io endpoint GET /badges/.
 */
class HealthchecksIoListBadges extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_list_badges';
    protected const DESCRIPTION = 'List project\'s badges

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/badges/.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/badges/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
