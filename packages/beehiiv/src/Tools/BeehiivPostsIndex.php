<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List posts OAuth Scope: posts:read.
 *
 * Executes the official beehiiv API operation posts_index.
 */
class BeehiivPostsIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_posts_index';
}
