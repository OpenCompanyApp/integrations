<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** Check DataCite REST API status. */
class DataCiteHeartbeat extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_heartbeat';
    protected const DESCRIPTION = 'Return the current status of the DataCite REST API.';
    protected const PATH = 'heartbeat';
}
