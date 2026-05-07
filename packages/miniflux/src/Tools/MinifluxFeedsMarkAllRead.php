<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Mark all entries in one feed as read.
 */
class MinifluxFeedsMarkAllRead extends AbstractMinifluxTool
{
    protected const OPERATION = 'feeds_mark_all_read';
}
