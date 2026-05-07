<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get post OAuth Scope: posts:read.
 *
 * Executes the official beehiiv API operation posts_show.
 */
class BeehiivPostsShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_posts_show';
}
