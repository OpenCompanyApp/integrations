<?php

namespace OpenCompany\Integrations\Clearbit\Tools;

/**
 * Calculate fraud risk with Clearbit's legacy Risk API.
 */
class ClearbitCalculateRisk extends AbstractClearbitTool
{
    public function name(): string
    {
        return 'clearbit_calculate_risk';
    }

    public function description(): string
    {
        return 'Calculate a Clearbit Risk score from email, IP, and optional identity fields. This is a legacy unsupported API for existing Clearbit customers.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'required' => true, 'description' => 'Risk inputs such as email, ip, name, country_code, zip_code, given_name, family_name.'],
        ];
    }

    protected function callService(array $args): array
    {
        $params = $this->params($args);

        if (empty($params['email']) && empty($params['ip'])) {
            throw new \RuntimeException('params.email or params.ip is required.');
        }

        return $this->service->calculateRisk($params);
    }
}
