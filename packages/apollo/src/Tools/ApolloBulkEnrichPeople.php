<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use RuntimeException;

/**
 * Enrich up to 10 people in one Apollo request.
 */
class ApolloBulkEnrichPeople extends AbstractApolloTool
{
    protected const NAME = 'apollo_bulk_enrich_people';

    protected const DESCRIPTION = 'Bulk enrich up to 10 people with Apollo. Pass each person in details; reveal and waterfall options apply to all matches and may consume credits.';

    protected const PARAMETERS = [
        'details' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'object'], 'description' => 'Person match objects, maximum 10.'],
        'reveal_personal_emails' => ['type' => 'boolean', 'description' => 'Reveal personal emails when available.'],
        'reveal_phone_number' => ['type' => 'boolean', 'description' => 'Reveal phone numbers asynchronously via webhook.'],
        'run_waterfall_email' => ['type' => 'boolean', 'description' => 'Enable waterfall email enrichment.'],
        'run_waterfall_phone' => ['type' => 'boolean', 'description' => 'Enable waterfall phone enrichment.'],
        'webhook_url' => ['type' => 'string', 'description' => 'HTTPS webhook URL required when reveal_phone_number is true.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        if (! is_array($args['details'] ?? null)) {
            throw new RuntimeException('details must be an array of person match objects.');
        }

        return $this->service->bulkEnrichPeople($args['details'], $this->filters($args, ['details']));
    }
}
