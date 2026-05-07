<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Refresh all feeds in the background.
 */
class MinifluxFeedsRefreshAll extends AbstractMinifluxTool
{
    protected const OPERATION = 'feeds_refresh_all';
}
