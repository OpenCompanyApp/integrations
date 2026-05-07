<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Mark all entries in one category as read.
 */
class MinifluxCategoriesMarkAllRead extends AbstractMinifluxTool
{
    protected const OPERATION = 'categories_mark_all_read';
}
