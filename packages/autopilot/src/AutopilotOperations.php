<?php

namespace OpenCompany\Integrations\Autopilot;

/**
 * Official Autopilot API operation metadata from the API Blueprint.
 *
 * Source: https://github.com/autopilotdev/autopilotdev.github.io/blob/master/_api_docs/apiary.md
 */
class AutopilotOperations
{
    /**
     * Return all supported Autopilot API operations.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            [
                'operation' => 'create_contact',
                'slug' => 'autopilot_create_contact',
                'class' => 'AutopilotCreateContact',
                'method' => 'POST',
                'path' => '/v1/contact',
                'name' => 'Add or update contact',
                'description' => 'Create or update a contact. Autopilot de-duplicates contacts by Email and merges provided fields.

Official Autopilot API Blueprint endpoint: POST https://api.autopilothq.com/v1/contact.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => true,
            ],
            [
                'operation' => 'get_contact',
                'slug' => 'autopilot_get_contact',
                'class' => 'AutopilotGetContact',
                'method' => 'GET',
                'path' => '/v1/contact/{contact_id_or_email}',
                'name' => 'Get contact',
                'description' => 'Retrieve one contact by Autopilot contact_id or email address.

Official Autopilot API Blueprint endpoint: GET https://api.autopilothq.com/v1/contact/{contact_id_or_email}.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'contact_id_or_email',
                        'param' => 'contact_id_or_email',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Autopilot path parameter `contact_id_or_email`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'delete_contact',
                'slug' => 'autopilot_delete_contact',
                'class' => 'AutopilotDeleteContact',
                'method' => 'DELETE',
                'path' => '/v1/contact/{contact_id_or_email}',
                'name' => 'Delete contact',
                'description' => 'Permanently delete one contact by Autopilot contact_id or email address.

Official Autopilot API Blueprint endpoint: DELETE https://api.autopilothq.com/v1/contact/{contact_id_or_email}.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'contact_id_or_email',
                        'param' => 'contact_id_or_email',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Autopilot path parameter `contact_id_or_email`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'get_contacts_on_list',
                'slug' => 'autopilot_get_contacts_on_list',
                'class' => 'AutopilotGetContactsOnList',
                'method' => 'GET',
                'path' => '/v1/list/{list_id}',
                'name' => 'Get contacts on list',
                'description' => 'Retrieve contacts belonging to a specific Autopilot list.

Official Autopilot API Blueprint endpoint: GET https://api.autopilothq.com/v1/list/{list_id}.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'list_id',
                        'param' => 'list_id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Autopilot path parameter `list_id`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'add_list',
                'slug' => 'autopilot_add_list',
                'class' => 'AutopilotAddList',
                'method' => 'POST',
                'path' => '/v1/list',
                'name' => 'Add list',
                'description' => 'Create a new Autopilot list.

Official Autopilot API Blueprint endpoint: POST https://api.autopilothq.com/v1/list.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => true,
            ],
            [
                'operation' => 'delete_list',
                'slug' => 'autopilot_delete_list',
                'class' => 'AutopilotDeleteList',
                'method' => 'DELETE',
                'path' => '/v1/list',
                'name' => 'Delete list',
                'description' => 'Delete an Autopilot list. Supply the documented list identifier in payload.

Official Autopilot API Blueprint endpoint: DELETE https://api.autopilothq.com/v1/list.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => true,
            ],
            [
                'operation' => 'eject_contact_from_journey',
                'slug' => 'autopilot_eject_contact_from_journey',
                'class' => 'AutopilotEjectContactFromJourney',
                'method' => 'DELETE',
                'path' => '/v1/journey/{journey_id}/contact/{contact_id_or_email}',
                'name' => 'Eject contact from journey',
                'description' => 'Remove a contact from a specific journey before they complete all steps.

Official Autopilot API Blueprint endpoint: DELETE https://api.autopilothq.com/v1/journey/{journey_id}/contact/{contact_id_or_email}.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'journey_id',
                        'param' => 'journey_id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Autopilot path parameter `journey_id`.',
                    ],
                    [
                        'name' => 'contact_id_or_email',
                        'param' => 'contact_id_or_email',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Autopilot path parameter `contact_id_or_email`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'register_rest_hook',
                'slug' => 'autopilot_register_rest_hook',
                'class' => 'AutopilotRegisterRestHook',
                'method' => 'POST',
                'path' => '/v1/hook',
                'name' => 'Register REST hook',
                'description' => 'Register a REST hook target URL for a supported Autopilot event.

Official Autopilot API Blueprint endpoint: POST https://api.autopilothq.com/v1/hook.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => true,
            ],
            [
                'operation' => 'unregister_rest_hook',
                'slug' => 'autopilot_unregister_rest_hook',
                'class' => 'AutopilotUnregisterRestHook',
                'method' => 'DELETE',
                'path' => '/v1/hook/{hook_id}',
                'name' => 'Unregister REST hook',
                'description' => 'Unregister a REST hook by hook_id.

Official Autopilot API Blueprint endpoint: DELETE https://api.autopilothq.com/v1/hook/{hook_id}.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'hook_id',
                        'param' => 'hook_id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Autopilot path parameter `hook_id`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'list_rest_hooks',
                'slug' => 'autopilot_list_rest_hooks',
                'class' => 'AutopilotListRestHooks',
                'method' => 'GET',
                'path' => '/v1/hooks',
                'name' => 'List REST hooks',
                'description' => 'List registered REST hooks.

Official Autopilot API Blueprint endpoint: GET https://api.autopilothq.com/v1/hooks.',
                'type' => 'read',
                'parameters' => [],
                'request_body' => false,
            ],
        ];
    }
}
