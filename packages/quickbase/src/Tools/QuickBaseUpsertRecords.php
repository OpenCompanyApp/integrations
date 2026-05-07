<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Upsert one or more records in a Quickbase table.
 */
class QuickBaseUpsertRecords extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_upsert_records';
    public const DESCRIPTION = 'Upsert one or more Quickbase records, optionally using a merge field.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
        'data' => ['type' => 'array', 'required' => true, 'description' => 'Record data array using Quickbase field ID objects.'],
        'mergeFieldId' => ['type' => 'integer', 'description' => 'Optional merge field ID.'],
        'fieldsToReturn' => ['type' => 'array', 'description' => 'Optional field IDs to return.'],
    ];

    /**
     * Upsert records.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $data = $args['data'] ?? [];
        if (!is_array($data) || $data === []) {
            throw new \InvalidArgumentException('data is required.');
        }

        $fieldsToReturn = $args['fieldsToReturn'] ?? [];

        return $this->service->upsertRecords(
            $this->requiredString($args, 'tableId', 'tableId'),
            $data,
            isset($args['mergeFieldId']) ? (int) $args['mergeFieldId'] : null,
            is_array($fieldsToReturn) ? $fieldsToReturn : [],
        );
    }
}
