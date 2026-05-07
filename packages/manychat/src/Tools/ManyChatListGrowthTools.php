<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * List Manychat growth tools.
 */
class ManyChatListGrowthTools extends AbstractManyChatTool
{
    public const NAME = 'manychat_list_growth_tools';
    public const DESCRIPTION = 'List growth tools configured in the Manychat bot.';
    public const PARAMETERS = [];

    /**
     * List growth tools.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listGrowthTools();
    }
}
