<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Update post OAuth Scope: posts:write.
 *
 * Executes the official beehiiv API operation posts_update.
 */
class BeehiivPostsUpdate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_posts_update';
}
