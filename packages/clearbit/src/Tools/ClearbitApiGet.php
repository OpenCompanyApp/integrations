<?php

namespace OpenCompany\Integrations\Clearbit\Tools;

/**
 * Call a read-only Clearbit endpoint on a named API host.
 */
class ClearbitApiGet extends AbstractClearbitTool
{
    public function name(): string
    {
        return 'clearbit_api_get';
    }

    public function description(): string
    {
        return 'Call a read-only Clearbit GET endpoint on a named API host such as person, company, reveal, prospector, discovery, risk, name_to_domain, or autocomplete.';
    }

    public function parameters(): array
    {
        return [
            'api' => ['type' => 'string', 'required' => true, 'description' => 'API host key: person, company, reveal, prospector, discovery, risk, name_to_domain, or autocomplete.'],
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative endpoint path such as /companies/find.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    protected function requiresConfiguration(): bool
    {
        return false;
    }

    protected function callService(array $args): array
    {
        return $this->service->apiGet($this->stringArg($args, 'api'), $this->stringArg($args, 'path'), $this->params($args));
    }
}
