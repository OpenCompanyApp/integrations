<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Delete post OAuth Scope: posts:write.
 *
 * Executes the official beehiiv API operation posts_delete.
 */
class BeehiivPostsDelete extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_posts_delete';
}
