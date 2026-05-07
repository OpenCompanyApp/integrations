<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Get Manychat page and bot information.
 */
class ManyChatGetPageInfo extends AbstractManyChatTool
{
    public const NAME = 'manychat_get_page_info';
    public const DESCRIPTION = 'Get Manychat page/account information from /fb/page/getInfo.';
    public const PARAMETERS = [];

    /**
     * Get page information.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getPageInfo();
    }
}
