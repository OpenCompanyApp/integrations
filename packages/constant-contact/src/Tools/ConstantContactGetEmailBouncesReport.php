<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Get bounces tracking report for a Constant Contact campaign activity.
 */
class ConstantContactGetEmailBouncesReport extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_get_email_bounces_report';
    }

    public function description(): string
    {
        return 'Get bounces tracking report for an email campaign activity.';
    }

    public function parameters(): array
    {
        return [
            'activity_id' => ['type' => 'string', 'required' => true, 'description' => 'Email campaign activity ID.'],
            'params' => ['type' => 'object', 'description' => 'Optional limit and cursor.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->getEmailBouncesReport($this->stringArg($args, 'activity_id'), $this->params($args));
    }
}
