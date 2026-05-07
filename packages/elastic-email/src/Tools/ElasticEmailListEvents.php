<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * List Elastic Email events.
 */
class ElasticEmailListEvents extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_list_events';
    }

    public function description(): string
    {
        return 'List Elastic Email events with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional from, to, eventTypes, limit, offset, channelName.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->listEvents($this->params($args));
    }
}
