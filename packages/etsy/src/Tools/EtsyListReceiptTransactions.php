<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * List transactions for an Etsy receipt.
 */
class EtsyListReceiptTransactions extends AbstractEtsyTool
{
    public const NAME = 'etsy_list_receipt_transactions';
    public const DESCRIPTION = 'List transaction line items for an Etsy receipt.';
    public const PARAMETERS = [
        'receipt_id' => ['type' => 'integer', 'required' => true, 'description' => 'Receipt ID.'],
    ];

    /**
     * List receipt transactions.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listReceiptTransactions($this->requiredInt($args, 'receipt_id', 'receipt_id'));
    }
}
