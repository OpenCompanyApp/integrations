<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * List feeds visible to the authenticated user.
 */
class MinifluxFeedsList extends AbstractMinifluxTool
{
    protected const OPERATION = 'feeds_list';
}
