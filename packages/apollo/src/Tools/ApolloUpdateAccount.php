<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use RuntimeException;

/**
 * Update a saved Apollo account.
 */
class ApolloUpdateAccount extends AbstractApolloTool
{
    protected const NAME = 'apollo_update_account';

    protected const DESCRIPTION = 'Update a saved Apollo account by account ID.';

    protected const PARAMETERS = [
        'account_id' => ['type' => 'string', 'required' => true, 'description' => 'Apollo account ID.'],
        'name' => ['type' => 'string', 'description' => 'Account name.'],
        'domain' => ['type' => 'string', 'description' => 'Company domain without www.'],
        'owner_id' => ['type' => 'string', 'description' => 'Apollo user ID for the account owner.'],
        'account_stage_id' => ['type' => 'string', 'description' => 'Apollo account stage ID.'],
        'phone' => ['type' => 'string', 'description' => 'Primary account phone number.'],
        'raw_address' => ['type' => 'string', 'description' => 'Account location.'],
        'typed_custom_fields' => ['type' => 'object', 'description' => 'Custom field values keyed by Apollo custom field ID.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        if (empty($args['account_id'])) {
            throw new RuntimeException('account_id is required.');
        }

        $accountId = (string) $args['account_id'];
        unset($args['account_id']);

        return $this->service->updateAccount($accountId, $this->filled($args));
    }
}
