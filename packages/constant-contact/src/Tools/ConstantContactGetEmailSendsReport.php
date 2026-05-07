<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Get sends tracking report for a Constant Contact campaign activity.
 */
class ConstantContactGetEmailSendsReport extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_get_email_sends_report';
    }

    public function description(): string
    {
        return 'Get sends tracking report for an email campaign activity.';
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
        return $this->service->getEmailSendsReport($this->stringArg($args, 'activity_id'), $this->params($args));
    }
}
