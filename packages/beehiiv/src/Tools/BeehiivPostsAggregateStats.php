<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get aggregate stats OAuth Scope: posts:read.
 *
 * Executes the official beehiiv API operation posts_aggregate_stats.
 */
class BeehiivPostsAggregateStats extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_posts_aggregate_stats';
}
