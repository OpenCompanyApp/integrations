<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Delete a Recruitee offer.
 */
class RecruiteeDeleteOffer extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_delete_offer';
    public const DESCRIPTION = 'Delete a Recruitee company offer by ID. This permanently removes the offer in Recruitee.';
    public const PARAMETERS = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Offer ID.'],
    ];

    /**
     * Delete an offer.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteOffer($this->requiredInt($args, 'id', 'offer ID'));
    }
}
