<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Create post OAuth Scope: posts:write.
 *
 * Executes the official beehiiv API operation posts_create.
 */
class BeehiivPostsCreate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_posts_create';
}
