<?php

namespace OpenCompany\Integrations\Etsy\Tools;

/**
 * Get one Etsy shop receipt.
 */
class EtsyGetReceipt extends AbstractEtsyTool
{
    public const NAME = 'etsy_get_receipt';
    public const DESCRIPTION = 'Get one receipt/order for the configured Etsy shop.';
    public const PARAMETERS = [
        'receipt_id' => ['type' => 'integer', 'required' => true, 'description' => 'Receipt ID.'],
    ];

    /**
     * Get one receipt.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getReceipt($this->requiredInt($args, 'receipt_id', 'receipt_id'));
    }
}
