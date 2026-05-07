<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Check whether the user has third-party save integrations enabled.
 */
class MinifluxIntegrationsStatus extends AbstractMinifluxTool
{
    protected const OPERATION = 'integrations_status';
}
