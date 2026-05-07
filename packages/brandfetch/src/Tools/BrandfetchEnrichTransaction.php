<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Get brand data from a raw payment transaction label.
 */
class BrandfetchEnrichTransaction extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_enrich_transaction';
    protected const TOOL_DESCRIPTION = 'Turn a raw payment transaction label into merchant brand data.';
    protected const PARAMETERS = [
        'transactionLabel' => ['type' => 'string', 'required' => true, 'description' => 'Raw transaction text.'],
        'countryCode' => ['type' => 'string', 'required' => true, 'description' => 'ISO 3166-1 alpha-2 country code.'],
        'payload' => ['type' => 'object', 'description' => 'Full Transaction API payload.'],
    ];

    protected function run(array $args): array
    {
        $payload = $this->object($args, 'payload');

        if ($payload === []) {
            $payload = [
                'transactionLabel' => $this->required($args, 'transactionLabel'),
                'countryCode' => $this->required($args, 'countryCode'),
            ];
        }

        return $this->service->enrichTransaction($payload);
    }
}
