<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Get a Constant Contact email campaign by ID.
 */
class ConstantContactGetCampaign extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_get_campaign';
    }

    public function description(): string
    {
        return 'Get a Constant Contact email campaign by campaign ID.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Email campaign ID.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getCampaign($this->stringArg($args, 'campaign_id'));
    }
}
