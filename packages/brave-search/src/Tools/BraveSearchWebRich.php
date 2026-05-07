<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Fetch Brave rich callback data.
 */
class BraveSearchWebRich extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_web_rich';
    protected const DESCRIPTION = 'Fetch rich result details using a callback_key returned by web search with enable_rich_callback=1.';
    protected const METHOD = 'webRich';

    public function parameters(): array
    {
        return BraveSearchParameters::webRich();
    }
}
