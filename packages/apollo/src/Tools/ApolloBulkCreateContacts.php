<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use RuntimeException;

/**
 * Create up to 100 Apollo contacts in one request.
 */
class ApolloBulkCreateContacts extends AbstractApolloTool
{
    protected const NAME = 'apollo_bulk_create_contacts';

    protected const DESCRIPTION = 'Bulk create up to 100 contacts in Apollo. Existing matches are returned separately when dedupe is enabled.';

    protected const PARAMETERS = [
        'contacts' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'object'], 'description' => 'Contact attribute objects, maximum 100.'],
        'append_label_names' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Labels to add to all contacts in this request.'],
        'run_dedupe' => ['type' => 'boolean', 'description' => 'Enable Apollo dedupe logic.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        if (! is_array($args['contacts'] ?? null)) {
            throw new RuntimeException('contacts must be an array.');
        }

        return $this->service->bulkCreateContacts($args['contacts'], $this->filters($args, ['contacts']));
    }
}
