<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Get a Constant Contact email campaign activity by ID.
 */
class ConstantContactGetCampaignActivity extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_get_campaign_activity';
    }

    public function description(): string
    {
        return 'Get a Constant Contact email campaign activity by activity ID.';
    }

    public function parameters(): array
    {
        return [
            'activity_id' => ['type' => 'string', 'required' => true, 'description' => 'Email campaign activity ID.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getCampaignActivity($this->stringArg($args, 'activity_id'));
    }
}
