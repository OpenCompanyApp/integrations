<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Check service and database health.
 */
class MinifluxHealthcheck extends AbstractMinifluxTool
{
    protected const OPERATION = 'healthcheck';
}
