<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * List files uploaded to Elastic Email.
 */
class ElasticEmailListFiles extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_list_files';
    }

    public function description(): string
    {
        return 'List files uploaded to Elastic Email.';
    }

    public function parameters(): array
    {
        return [];
    }

    protected function callService(array $args): array
    {
        return $this->service->listFiles();
    }
}
