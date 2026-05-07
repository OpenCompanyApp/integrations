<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Fetch read and unread counters per feed.
 */
class MinifluxFeedCountersGet extends AbstractMinifluxTool
{
    protected const OPERATION = 'feed_counters_get';
}
