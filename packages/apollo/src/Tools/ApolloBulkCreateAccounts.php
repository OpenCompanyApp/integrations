<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use RuntimeException;

/**
 * Create up to 100 Apollo accounts in one request.
 */
class ApolloBulkCreateAccounts extends AbstractApolloTool
{
    protected const NAME = 'apollo_bulk_create_accounts';

    protected const DESCRIPTION = 'Bulk create up to 100 accounts in Apollo. Existing matches are returned separately when dedupe is enabled.';

    protected const PARAMETERS = [
        'accounts' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'object'], 'description' => 'Account attribute objects, maximum 100.'],
        'append_label_names' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Labels to add to all accounts in this request.'],
        'run_dedupe' => ['type' => 'boolean', 'description' => 'Enable Apollo dedupe logic.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        if (! is_array($args['accounts'] ?? null)) {
            throw new RuntimeException('accounts must be an array.');
        }

        return $this->service->bulkCreateAccounts($args['accounts'], $this->filters($args, ['accounts']));
    }
}
