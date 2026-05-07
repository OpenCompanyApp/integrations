<?php

namespace OpenCompany\Integrations\Courier;

/**
 * Official Courier API operation metadata.
 *
 * Generated from Courier API reference markdown linked by https://www.courier.com/docs/llms.txt.
 */
class CourierOperations
{
    /**
     * Return Courier API operations keyed by tool slug.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            [
                "slug" => "courier_audiences_delete",
                "operation" => "audiences_delete",
                "class" => "CourierAudiencesDelete",
                "method" => "DELETE",
                "path" => "/audiences/{audience_id}",
                "type" => "write",
                "name" => "Delete an audience",
                "description" => "Deletes the specified audience.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "audience_id",
                        "param" => "audience_id",
                        "required" => true,
                        "description" => "A unique identifier representing the audience id."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/delete-an-audience.md"
            ],
            [
                "slug" => "courier_audiences_get",
                "operation" => "audiences_get",
                "class" => "CourierAudiencesGet",
                "method" => "GET",
                "path" => "/audiences/{audience_id}",
                "type" => "read",
                "name" => "Get an audience",
                "description" => "Returns the specified audience by id.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "audience_id",
                        "param" => "audience_id",
                        "required" => true,
                        "description" => "A unique identifier representing the audience_id."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-an-audience.md"
            ],
            [
                "slug" => "courier_audiences_list_audiences",
                "operation" => "audiences_listAudiences",
                "class" => "CourierAudiencesListAudiences",
                "method" => "GET",
                "path" => "/audiences",
                "type" => "read",
                "name" => "List all audiences",
                "description" => "Get the audiences associated with the authorization token.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "A unique identifier that allows for fetching the next set of audiences."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/list-all-audiences.md"
            ],
            [
                "slug" => "courier_audiences_list_members",
                "operation" => "audiences_listMembers",
                "class" => "CourierAudiencesListMembers",
                "method" => "GET",
                "path" => "/audiences/{audience_id}/members",
                "type" => "read",
                "name" => "List audience members",
                "description" => "Get list of members of an audience.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "audience_id",
                        "param" => "audience_id",
                        "required" => true,
                        "description" => "A unique identifier representing the audience id."
                    ],
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "A unique identifier that allows for fetching the next set of members."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/list-audience-members.md"
            ],
            [
                "slug" => "courier_audiences_update",
                "operation" => "audiences_update",
                "class" => "CourierAudiencesUpdate",
                "method" => "PUT",
                "path" => "/audiences/{audience_id}",
                "type" => "write",
                "name" => "Update an audience",
                "description" => "Creates or updates audience.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "audience_id",
                        "param" => "audience_id",
                        "required" => true,
                        "description" => "A unique identifier representing the audience id."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/update-an-audience.md"
            ],
            [
                "slug" => "courier_audit_events_get",
                "operation" => "auditEvents_get",
                "class" => "CourierAuditEventsGet",
                "method" => "GET",
                "path" => "/audit-events/{audit-event-id}",
                "type" => "read",
                "name" => "Get an audit event",
                "description" => "Fetch a specific audit event by ID.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "audit-event-id",
                        "param" => "audit_event_id",
                        "required" => true,
                        "description" => "A unique identifier associated with the audit event you wish to retrieve."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-an-audit-event.md"
            ],
            [
                "slug" => "courier_audit_events_list",
                "operation" => "auditEvents_list",
                "class" => "CourierAuditEventsList",
                "method" => "GET",
                "path" => "/audit-events",
                "type" => "read",
                "name" => "Get all audit events",
                "description" => "Fetch the list of audit events.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "A unique identifier that allows for fetching the next set of audit events."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-all-audit-events.md"
            ],
            [
                "slug" => "courier_auth_tokens_issue_token",
                "operation" => "authTokens_issueToken",
                "class" => "CourierAuthTokensIssueToken",
                "method" => "POST",
                "path" => "/auth/issue-token",
                "type" => "write",
                "name" => "Create a JWT",
                "description" => "Returns a new access token.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "scope",
                    "expires_in"
                ],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/create-a-jwt.md"
            ],
            [
                "slug" => "courier_automations_invoke_ad_hoc_automation",
                "operation" => "automations_invokeAdHocAutomation",
                "class" => "CourierAutomationsInvokeAdHocAutomation",
                "method" => "POST",
                "path" => "/automations/invoke",
                "type" => "write",
                "name" => "Invoke an Ad Hoc Automation",
                "description" => "Invoke an ad hoc automation run.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/invoke-an-ad-hoc-automation.md"
            ],
            [
                "slug" => "courier_automations_invoke_automation_template",
                "operation" => "automations_invokeAutomationTemplate",
                "class" => "CourierAutomationsInvokeAutomationTemplate",
                "method" => "POST",
                "path" => "/automations/{templateId}/invoke",
                "type" => "write",
                "name" => "Invoke an Automation",
                "description" => "Invoke an automation run from an automation template.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "templateId",
                        "param" => "template_id",
                        "required" => true,
                        "description" => "A unique identifier representing the automation template to be invoked."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/invoke-an-automation.md"
            ],
            [
                "slug" => "courier_automations_list",
                "operation" => "automations_list",
                "class" => "CourierAutomationsList",
                "method" => "GET",
                "path" => "/automations",
                "type" => "read",
                "name" => "List Automations",
                "description" => "Get the list of automations.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "A cursor token for pagination."
                    ],
                    [
                        "source" => "query",
                        "name" => "version",
                        "param" => "version",
                        "required" => false,
                        "description" => "The version of templates to retrieve."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/list-automations.md"
            ],
            [
                "slug" => "courier_brands_create",
                "operation" => "brands_create",
                "class" => "CourierBrandsCreate",
                "method" => "POST",
                "path" => "/brands",
                "type" => "write",
                "name" => "Create a new brand",
                "description" => "Create a new brand.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/create-a-new-brand.md"
            ],
            [
                "slug" => "courier_brands_delete",
                "operation" => "brands_delete",
                "class" => "CourierBrandsDelete",
                "method" => "DELETE",
                "path" => "/brands/{brand_id}",
                "type" => "write",
                "name" => "Delete a brand",
                "description" => "Delete a brand by brand ID.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "brand_id",
                        "param" => "brand_id",
                        "required" => true,
                        "description" => "A unique identifier associated with the brand you wish to retrieve."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/delete-a-brand.md"
            ],
            [
                "slug" => "courier_brands_get",
                "operation" => "brands_get",
                "class" => "CourierBrandsGet",
                "method" => "GET",
                "path" => "/brands/{brand_id}",
                "type" => "read",
                "name" => "Get a brand",
                "description" => "Fetch a specific brand by brand ID.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "brand_id",
                        "param" => "brand_id",
                        "required" => true,
                        "description" => "A unique identifier associated with the brand you wish to retrieve."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-a-brand.md"
            ],
            [
                "slug" => "courier_brands_list",
                "operation" => "brands_list",
                "class" => "CourierBrandsList",
                "method" => "GET",
                "path" => "/brands",
                "type" => "read",
                "name" => "List brands",
                "description" => "Get the list of brands.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "A unique identifier that allows for fetching the next set of brands."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/list-brands.md"
            ],
            [
                "slug" => "courier_brands_replace",
                "operation" => "brands_replace",
                "class" => "CourierBrandsReplace",
                "method" => "PUT",
                "path" => "/brands/{brand_id}",
                "type" => "write",
                "name" => "Replace a brand",
                "description" => "Replace an existing brand with the supplied values.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "brand_id",
                        "param" => "brand_id",
                        "required" => true,
                        "description" => "A unique identifier associated with the brand you wish to update."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "name"
                ],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/replace-a-brand.md"
            ],
            [
                "slug" => "courier_bulk_create_job",
                "operation" => "bulk_createJob",
                "class" => "CourierBulkCreateJob",
                "method" => "POST",
                "path" => "/bulk",
                "type" => "write",
                "name" => "Create a bulk job",
                "description" => "Creates a new bulk job for sending messages to multiple recipients.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "message"
                ],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/create-a-bulk-job.md"
            ],
            [
                "slug" => "courier_bulk_get_job",
                "operation" => "bulk_getJob",
                "class" => "CourierBulkGetJob",
                "method" => "GET",
                "path" => "/bulk/{job_id}",
                "type" => "read",
                "name" => "Get a Job",
                "description" => "Get a bulk job.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "job_id",
                        "param" => "job_id",
                        "required" => true,
                        "description" => "A unique identifier representing the bulk job."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-a-job.md"
            ],
            [
                "slug" => "courier_bulk_get_users",
                "operation" => "bulk_getUsers",
                "class" => "CourierBulkGetUsers",
                "method" => "GET",
                "path" => "/bulk/{job_id}/users",
                "type" => "read",
                "name" => "Get users",
                "description" => "Get Bulk Job Users.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "job_id",
                        "param" => "job_id",
                        "required" => true,
                        "description" => "A unique identifier representing the bulk job."
                    ],
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "A unique identifier that allows for fetching the next set of users added to the bulk job."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-users.md"
            ],
            [
                "slug" => "courier_bulk_ingest_users",
                "operation" => "bulk_ingestUsers",
                "class" => "CourierBulkIngestUsers",
                "method" => "POST",
                "path" => "/bulk/{job_id}",
                "type" => "write",
                "name" => "Add users",
                "description" => "Ingest user data into a Bulk Job.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "job_id",
                        "param" => "job_id",
                        "required" => true,
                        "description" => "A unique identifier representing the bulk job."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/add-users.md"
            ],
            [
                "slug" => "courier_bulk_run_job",
                "operation" => "bulk_runJob",
                "class" => "CourierBulkRunJob",
                "method" => "POST",
                "path" => "/bulk/{job_id}/run",
                "type" => "write",
                "name" => "Run a job",
                "description" => "Run a bulk job.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "job_id",
                        "param" => "job_id",
                        "required" => true,
                        "description" => "A unique identifier representing the bulk job."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/run-a-job.md"
            ],
            [
                "slug" => "courier_inbound_track",
                "operation" => "inbound_track",
                "class" => "CourierInboundTrack",
                "method" => "POST",
                "path" => "/inbound/courier",
                "type" => "write",
                "name" => "Courier Track Event",
                "description" => "Courier Track Event.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/courier-track-event.md"
            ],
            [
                "slug" => "courier_journeys_invoke",
                "operation" => "journeys_invoke",
                "class" => "CourierJourneysInvoke",
                "method" => "POST",
                "path" => "/journeys/{templateId}/invoke",
                "type" => "write",
                "name" => "Invoke a Journey",
                "description" => "Invoke a journey run from a journey template.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "templateId",
                        "param" => "template_id",
                        "required" => true,
                        "description" => "A unique identifier representing the journey template to be invoked."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/invoke-a-journey.md"
            ],
            [
                "slug" => "courier_journeys_list",
                "operation" => "journeys_list",
                "class" => "CourierJourneysList",
                "method" => "GET",
                "path" => "/journeys",
                "type" => "read",
                "name" => "List Journeys",
                "description" => "Get the list of journeys.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "A cursor token for pagination."
                    ],
                    [
                        "source" => "query",
                        "name" => "version",
                        "param" => "version",
                        "required" => false,
                        "description" => "The version of journeys to retrieve."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/list-journeys.md"
            ],
            [
                "slug" => "courier_lists_add_subscribers",
                "operation" => "lists_addSubscribers",
                "class" => "CourierListsAddSubscribers",
                "method" => "POST",
                "path" => "/lists/{list_id}/subscriptions",
                "type" => "write",
                "name" => "Add subscribers to a list",
                "description" => "Subscribes additional users to the list, without modifying existing subscriptions.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "list_id",
                        "param" => "list_id",
                        "required" => true,
                        "description" => "A unique identifier representing the list you wish to retrieve."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "recipients"
                ],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/add-subscribers-to-a-list.md"
            ],
            [
                "slug" => "courier_lists_delete",
                "operation" => "lists_delete",
                "class" => "CourierListsDelete",
                "method" => "DELETE",
                "path" => "/lists/{list_id}",
                "type" => "write",
                "name" => "Delete a list",
                "description" => "Delete a list by list ID.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "list_id",
                        "param" => "list_id",
                        "required" => true,
                        "description" => "A unique identifier representing the list you wish to retrieve."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/delete-a-list.md"
            ],
            [
                "slug" => "courier_lists_get",
                "operation" => "lists_get",
                "class" => "CourierListsGet",
                "method" => "GET",
                "path" => "/lists/{list_id}",
                "type" => "read",
                "name" => "Get a list",
                "description" => "Returns a list based on the list ID provided.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "list_id",
                        "param" => "list_id",
                        "required" => true,
                        "description" => "A unique identifier representing the list you wish to retrieve."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-a-list.md"
            ],
            [
                "slug" => "courier_lists_get_subscribers",
                "operation" => "lists_getSubscribers",
                "class" => "CourierListsGetSubscribers",
                "method" => "GET",
                "path" => "/lists/{list_id}/subscriptions",
                "type" => "read",
                "name" => "Get the subscriptions for a list",
                "description" => "Get the list's subscriptions.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "list_id",
                        "param" => "list_id",
                        "required" => true,
                        "description" => "A unique identifier representing the list you wish to retrieve."
                    ],
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "A unique identifier that allows for fetching the next set of list subscriptions."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-the-subscriptions-for-a-list.md"
            ],
            [
                "slug" => "courier_lists_list",
                "operation" => "lists_list",
                "class" => "CourierListsList",
                "method" => "GET",
                "path" => "/lists",
                "type" => "read",
                "name" => "Get all lists",
                "description" => "Returns all of the lists, with the ability to filter based on a pattern.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "A unique identifier that allows for fetching the next page of lists."
                    ],
                    [
                        "source" => "query",
                        "name" => "pattern",
                        "param" => "pattern",
                        "required" => false,
                        "description" => "\"A pattern used to filter the list items returned."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-all-lists.md"
            ],
            [
                "slug" => "courier_lists_restore",
                "operation" => "lists_restore",
                "class" => "CourierListsRestore",
                "method" => "PUT",
                "path" => "/lists/{list_id}/restore",
                "type" => "write",
                "name" => "Restore a list",
                "description" => "Restore a previously deleted list.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "list_id",
                        "param" => "list_id",
                        "required" => true,
                        "description" => "A unique identifier representing the list you wish to retrieve."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/restore-a-list.md"
            ],
            [
                "slug" => "courier_lists_subscribe",
                "operation" => "lists_subscribe",
                "class" => "CourierListsSubscribe",
                "method" => "PUT",
                "path" => "/lists/{list_id}/subscriptions/{user_id}",
                "type" => "write",
                "name" => "Subscribe a single user profile to a list",
                "description" => "Subscribe a user to an existing list (note: if the List does not exist, it will be automatically created).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "list_id",
                        "param" => "list_id",
                        "required" => true,
                        "description" => "A unique identifier representing the list you wish to retrieve."
                    ],
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier representing the recipient associated with the list."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/subscribe-a-single-user-profile-to-a-list.md"
            ],
            [
                "slug" => "courier_lists_unsubscribe",
                "operation" => "lists_unsubscribe",
                "class" => "CourierListsUnsubscribe",
                "method" => "DELETE",
                "path" => "/lists/{list_id}/subscriptions/{user_id}",
                "type" => "write",
                "name" => "Unsubscribe a user profile from a list",
                "description" => "Delete a subscription to a list by list ID and user ID.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "list_id",
                        "param" => "list_id",
                        "required" => true,
                        "description" => "A unique identifier representing the list you wish to retrieve."
                    ],
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier representing the recipient associated with the list."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/unsubscribe-a-user-profile-from-a-list.md"
            ],
            [
                "slug" => "courier_lists_update",
                "operation" => "lists_update",
                "class" => "CourierListsUpdate",
                "method" => "PUT",
                "path" => "/lists/{list_id}",
                "type" => "write",
                "name" => "Update a list",
                "description" => "Create or replace an existing list with the supplied values.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "list_id",
                        "param" => "list_id",
                        "required" => true,
                        "description" => "A unique identifier representing the list you wish to retrieve."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/update-a-list.md"
            ],
            [
                "slug" => "courier_lists_update_subscribers",
                "operation" => "lists_updateSubscribers",
                "class" => "CourierListsUpdateSubscribers",
                "method" => "PUT",
                "path" => "/lists/{list_id}/subscriptions",
                "type" => "write",
                "name" => "Subscribe users to a list",
                "description" => "Subscribes the users to the list, overwriting existing subscriptions.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "list_id",
                        "param" => "list_id",
                        "required" => true,
                        "description" => "A unique identifier representing the list you wish to retrieve."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "recipients"
                ],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/subscribe-users-to-a-list.md"
            ],
            [
                "slug" => "courier_messages_archive",
                "operation" => "messages_archive",
                "class" => "CourierMessagesArchive",
                "method" => "PUT",
                "path" => "/requests/{request_id}/archive",
                "type" => "write",
                "name" => "Archive message",
                "description" => "Archive message.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "request_id",
                        "param" => "request_id",
                        "required" => true,
                        "description" => "A unique identifier representing the request ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/archive-message.md"
            ],
            [
                "slug" => "courier_messages_cancel",
                "operation" => "messages_cancel",
                "class" => "CourierMessagesCancel",
                "method" => "POST",
                "path" => "/messages/{message_id}/cancel",
                "type" => "write",
                "name" => "Cancel message",
                "description" => "Cancel a message that is currently in the process of being delivered.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "message_id",
                        "param" => "message_id",
                        "required" => true,
                        "description" => "A unique identifier representing the message ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/cancel-message.md"
            ],
            [
                "slug" => "courier_messages_get",
                "operation" => "messages_get",
                "class" => "CourierMessagesGet",
                "method" => "GET",
                "path" => "/messages/{message_id}",
                "type" => "read",
                "name" => "Get message",
                "description" => "Fetch the status of a message you've previously sent.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "message_id",
                        "param" => "message_id",
                        "required" => true,
                        "description" => "A unique identifier associated with the message you wish to retrieve (results from a send)."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-message.md"
            ],
            [
                "slug" => "courier_messages_get_content",
                "operation" => "messages_getContent",
                "class" => "CourierMessagesGetContent",
                "method" => "GET",
                "path" => "/messages/{message_id}/output",
                "type" => "read",
                "name" => "Get message content",
                "description" => "Get message content.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "message_id",
                        "param" => "message_id",
                        "required" => true,
                        "description" => "A unique identifier associated with the message you wish to retrieve (results from a send)."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-message-content.md"
            ],
            [
                "slug" => "courier_messages_get_history",
                "operation" => "messages_getHistory",
                "class" => "CourierMessagesGetHistory",
                "method" => "GET",
                "path" => "/messages/{message_id}/history",
                "type" => "read",
                "name" => "Get message history",
                "description" => "Fetch the array of events of a message you've previously sent.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "message_id",
                        "param" => "message_id",
                        "required" => true,
                        "description" => "A unique identifier representing the message ID."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "A supported Message History type that will filter the events returned."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-message-history.md"
            ],
            [
                "slug" => "courier_messages_list",
                "operation" => "messages_list",
                "class" => "CourierMessagesList",
                "method" => "GET",
                "path" => "/messages",
                "type" => "read",
                "name" => "List messages",
                "description" => "Fetch the statuses of messages you've previously sent.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "archived",
                        "param" => "archived",
                        "required" => false,
                        "description" => "A boolean value that indicates whether archived messages should be included in the response."
                    ],
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "A unique identifier that allows for fetching the next set of messages."
                    ],
                    [
                        "source" => "query",
                        "name" => "event",
                        "param" => "event",
                        "required" => false,
                        "description" => "A unique identifier representing the event that was used to send the event."
                    ],
                    [
                        "source" => "query",
                        "name" => "list",
                        "param" => "list",
                        "required" => false,
                        "description" => "A unique identifier representing the list the message was sent to."
                    ],
                    [
                        "source" => "query",
                        "name" => "messageId",
                        "param" => "message_id",
                        "required" => false,
                        "description" => "A unique identifier representing the message_id returned from either /send or /send/list."
                    ],
                    [
                        "source" => "query",
                        "name" => "notification",
                        "param" => "notification",
                        "required" => false,
                        "description" => "A unique identifier representing the notification that was used to send the event."
                    ],
                    [
                        "source" => "query",
                        "name" => "provider",
                        "param" => "provider",
                        "required" => false,
                        "description" => "The key assocated to the provider you want to filter on."
                    ],
                    [
                        "source" => "query",
                        "name" => "recipient",
                        "param" => "recipient",
                        "required" => false,
                        "description" => "A unique identifier representing the recipient associated with the requested profile."
                    ],
                    [
                        "source" => "query",
                        "name" => "status",
                        "param" => "status",
                        "required" => false,
                        "description" => "An indicator of the current status of the message."
                    ],
                    [
                        "source" => "query",
                        "name" => "tag",
                        "param" => "tag",
                        "required" => false,
                        "description" => "A tag placed in the metadata.tags during a notification send."
                    ],
                    [
                        "source" => "query",
                        "name" => "tags",
                        "param" => "tags",
                        "required" => false,
                        "description" => "A comma delimited list of 'tags'."
                    ],
                    [
                        "source" => "query",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => false,
                        "description" => "Messages sent with the context of a Tenant."
                    ],
                    [
                        "source" => "query",
                        "name" => "enqueued_after",
                        "param" => "enqueued_after",
                        "required" => false,
                        "description" => "The enqueued datetime of a message to filter out messages received before."
                    ],
                    [
                        "source" => "query",
                        "name" => "traceId",
                        "param" => "trace_id",
                        "required" => false,
                        "description" => "The unique identifier used to trace the requests."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/list-messages.md"
            ],
            [
                "slug" => "courier_notifications_archive",
                "operation" => "notifications_archive",
                "class" => "CourierNotificationsArchive",
                "method" => "DELETE",
                "path" => "/notifications/{id}",
                "type" => "write",
                "name" => "Archive Notification Template",
                "description" => "Archive a notification template.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Template ID (nt_ prefix)."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/archive-notification-template.md"
            ],
            [
                "slug" => "courier_notifications_create",
                "operation" => "notifications_create",
                "class" => "CourierNotificationsCreate",
                "method" => "POST",
                "path" => "/notifications",
                "type" => "write",
                "name" => "Create Notification Template",
                "description" => "Create a notification template.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/create-notification-template.md"
            ],
            [
                "slug" => "courier_notifications_list",
                "operation" => "notifications_list",
                "class" => "CourierNotificationsList",
                "method" => "GET",
                "path" => "/notifications",
                "type" => "read",
                "name" => "List Notification Templates",
                "description" => "List notification templates in your workspace.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "Opaque pagination cursor from a previous response."
                    ],
                    [
                        "source" => "query",
                        "name" => "notes",
                        "param" => "notes",
                        "required" => false,
                        "description" => "Include template notes in the response."
                    ],
                    [
                        "source" => "query",
                        "name" => "event_id",
                        "param" => "event_id",
                        "required" => false,
                        "description" => "Filter to templates linked to this event map ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/list-notification-templates.md"
            ],
            [
                "slug" => "courier_notifications_list_versions",
                "operation" => "notifications_listVersions",
                "class" => "CourierNotificationsListVersions",
                "method" => "GET",
                "path" => "/notifications/{id}/versions",
                "type" => "read",
                "name" => "List Notification Template Versions",
                "description" => "List versions of a notification template.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Template ID (nt_ prefix)."
                    ],
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "Opaque pagination cursor from a previous response."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "Maximum number of versions to return per page."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/list-notification-template-versions.md"
            ],
            [
                "slug" => "courier_notifications_publish",
                "operation" => "notifications_publish",
                "class" => "CourierNotificationsPublish",
                "method" => "POST",
                "path" => "/notifications/{id}/publish",
                "type" => "write",
                "name" => "Publish Notification Template",
                "description" => "Publish a notification template.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Template ID (nt_ prefix)."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/publish-notification-template.md"
            ],
            [
                "slug" => "courier_notifications_replace",
                "operation" => "notifications_replace",
                "class" => "CourierNotificationsReplace",
                "method" => "PUT",
                "path" => "/notifications/{id}",
                "type" => "write",
                "name" => "Replace Notification Template",
                "description" => "Replace a notification template.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Template ID (nt_ prefix)."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/replace-notification-template.md"
            ],
            [
                "slug" => "courier_notifications_retrieve",
                "operation" => "notifications_retrieve",
                "class" => "CourierNotificationsRetrieve",
                "method" => "GET",
                "path" => "/notifications/{id}",
                "type" => "read",
                "name" => "Get Notification Template",
                "description" => "Retrieve a notification template by ID.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Template ID (nt_ prefix)."
                    ],
                    [
                        "source" => "query",
                        "name" => "version",
                        "param" => "version",
                        "required" => false,
                        "description" => "Version to retrieve."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-notification-template.md"
            ],
            [
                "slug" => "courier_profiles_create",
                "operation" => "profiles_create",
                "class" => "CourierProfilesCreate",
                "method" => "POST",
                "path" => "/profiles/{user_id}",
                "type" => "write",
                "name" => "Create a profile",
                "description" => "Merge the supplied values with an existing profile or create a new profile if one doesn't already exist.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier representing the user associated with the requested profile."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "profile"
                ],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/create-a-profile.md"
            ],
            [
                "slug" => "courier_profiles_delete",
                "operation" => "profiles_delete",
                "class" => "CourierProfilesDelete",
                "method" => "DELETE",
                "path" => "/profiles/{user_id}",
                "type" => "write",
                "name" => "Delete a profile",
                "description" => "Deletes the specified user profile.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier representing the user associated with the requested user profile."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/delete-a-profile.md"
            ],
            [
                "slug" => "courier_profiles_delete_list_subscription",
                "operation" => "profiles_deleteListSubscription",
                "class" => "CourierProfilesDeleteListSubscription",
                "method" => "DELETE",
                "path" => "/profiles/{user_id}/lists",
                "type" => "write",
                "name" => "Delete list subscriptions",
                "description" => "Removes all list subscriptions for given user.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier representing the user associated with the requested profile."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/delete-list-subscriptions.md"
            ],
            [
                "slug" => "courier_profiles_get",
                "operation" => "profiles_get",
                "class" => "CourierProfilesGet",
                "method" => "GET",
                "path" => "/profiles/{user_id}",
                "type" => "read",
                "name" => "Get a profile",
                "description" => "Returns the specified user profile.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier representing the user associated with the requested profile."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-a-profile.md"
            ],
            [
                "slug" => "courier_profiles_get_list_subscriptions",
                "operation" => "profiles_getListSubscriptions",
                "class" => "CourierProfilesGetListSubscriptions",
                "method" => "GET",
                "path" => "/profiles/{user_id}/lists",
                "type" => "read",
                "name" => "Get list subscriptions",
                "description" => "Returns the subscribed lists for a specified user.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier representing the user associated with the requested user profile."
                    ],
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "A unique identifier that allows for fetching the next set of message statuses."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-list-subscriptions.md"
            ],
            [
                "slug" => "courier_profiles_merge_profile",
                "operation" => "profiles_mergeProfile",
                "class" => "CourierProfilesMergeProfile",
                "method" => "PATCH",
                "path" => "/profiles/{user_id}",
                "type" => "write",
                "name" => "Update a profile",
                "description" => "Update a profile.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier representing the user associated with the requested user profile."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/update-a-profile.md"
            ],
            [
                "slug" => "courier_profiles_replace",
                "operation" => "profiles_replace",
                "class" => "CourierProfilesReplace",
                "method" => "PUT",
                "path" => "/profiles/{user_id}",
                "type" => "write",
                "name" => "Replace a profile",
                "description" => "When using PUT, be sure to include all the key-value pairs required by the recipient's profile.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier representing the user associated with the requested user profile."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "profile"
                ],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/replace-a-profile.md"
            ],
            [
                "slug" => "courier_profiles_subscribe_to_list",
                "operation" => "profiles_subscribeToList",
                "class" => "CourierProfilesSubscribeToList",
                "method" => "POST",
                "path" => "/profiles/{user_id}/lists",
                "type" => "write",
                "name" => "Subscribe to one or more lists",
                "description" => "Subscribes the given user to one or more lists.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier representing the user associated with the requested user profile."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/subscribe-to-one-or-more-lists.md"
            ],
            [
                "slug" => "courier_routing_strategies_archive",
                "operation" => "routingStrategies_archive",
                "class" => "CourierRoutingStrategiesArchive",
                "method" => "DELETE",
                "path" => "/routing-strategies/{id}",
                "type" => "write",
                "name" => "Archive Routing Strategy",
                "description" => "Archive a routing strategy.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Routing strategy ID (rs_ prefix)."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/archive-routing-strategy.md"
            ],
            [
                "slug" => "courier_routing_strategies_create",
                "operation" => "routingStrategies_create",
                "class" => "CourierRoutingStrategiesCreate",
                "method" => "POST",
                "path" => "/routing-strategies",
                "type" => "write",
                "name" => "Create Routing Strategy",
                "description" => "Create a routing strategy.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/create-routing-strategy.md"
            ],
            [
                "slug" => "courier_routing_strategies_list",
                "operation" => "routingStrategies_list",
                "class" => "CourierRoutingStrategiesList",
                "method" => "GET",
                "path" => "/routing-strategies",
                "type" => "read",
                "name" => "List Routing Strategies",
                "description" => "List routing strategies in your workspace.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "Opaque pagination cursor from a previous response."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "Maximum number of results per page."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/list-routing-strategies.md"
            ],
            [
                "slug" => "courier_routing_strategies_replace",
                "operation" => "routingStrategies_replace",
                "class" => "CourierRoutingStrategiesReplace",
                "method" => "PUT",
                "path" => "/routing-strategies/{id}",
                "type" => "write",
                "name" => "Replace Routing Strategy",
                "description" => "Replace a routing strategy.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Routing strategy ID (rs_ prefix)."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/replace-routing-strategy.md"
            ],
            [
                "slug" => "courier_routing_strategies_retrieve",
                "operation" => "routingStrategies_retrieve",
                "class" => "CourierRoutingStrategiesRetrieve",
                "method" => "GET",
                "path" => "/routing-strategies/{id}",
                "type" => "read",
                "name" => "Get Routing Strategy",
                "description" => "Retrieve a routing strategy by ID.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Routing strategy ID (rs_ prefix)."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-routing-strategy.md"
            ],
            [
                "slug" => "courier_send",
                "operation" => "send",
                "class" => "CourierSend",
                "method" => "POST",
                "path" => "/send",
                "type" => "write",
                "name" => "Send a message",
                "description" => "Send a message to one or more recipients.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "message"
                ],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/send-a-message.md"
            ],
            [
                "slug" => "courier_tenants_create_or_replace",
                "operation" => "tenants_createOrReplace",
                "class" => "CourierTenantsCreateOrReplace",
                "method" => "PUT",
                "path" => "/tenants/{tenant_id}",
                "type" => "write",
                "name" => "Create or Replace a Tenant",
                "description" => "Create or Replace a Tenant.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "A unique identifier representing the tenant to be returned."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "name"
                ],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/create-or-replace-a-tenant.md"
            ],
            [
                "slug" => "courier_tenants_create_or_replace_default_preferences_for_topic",
                "operation" => "tenants_createOrReplaceDefaultPreferencesForTopic",
                "class" => "CourierTenantsCreateOrReplaceDefaultPreferencesForTopic",
                "method" => "PUT",
                "path" => "/tenants/{tenant_id}/default_preferences/items/{topic_id}",
                "type" => "write",
                "name" => "Create or Replace Default Preferences For Topic",
                "description" => "Create or Replace Default Preferences For Topic.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "Id of the tenant to update the default preferences for."
                    ],
                    [
                        "source" => "path",
                        "name" => "topic_id",
                        "param" => "topic_id",
                        "required" => true,
                        "description" => "Id of the subscription topic you want to have a default preference for."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/create-or-replace-default-preferences-for-topic.md"
            ],
            [
                "slug" => "courier_tenants_delete",
                "operation" => "tenants_delete",
                "class" => "CourierTenantsDelete",
                "method" => "DELETE",
                "path" => "/tenants/{tenant_id}",
                "type" => "write",
                "name" => "Delete a Tenant",
                "description" => "Delete a Tenant.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "Id of the tenant to be deleted."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/delete-a-tenant.md"
            ],
            [
                "slug" => "courier_tenants_get",
                "operation" => "tenants_get",
                "class" => "CourierTenantsGet",
                "method" => "GET",
                "path" => "/tenants/{tenant_id}",
                "type" => "read",
                "name" => "Get a Tenant",
                "description" => "Get a Tenant.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "A unique identifier representing the tenant to be returned."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-a-tenant.md"
            ],
            [
                "slug" => "courier_tenants_get_template_by_tenant",
                "operation" => "tenants_getTemplateByTenant",
                "class" => "CourierTenantsGetTemplateByTenant",
                "method" => "GET",
                "path" => "/tenants/{tenant_id}/templates/{template_id}",
                "type" => "read",
                "name" => "Get a Template in Tenant",
                "description" => "Get a Template in Tenant.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "Id of the tenant for which to retrieve the template."
                    ],
                    [
                        "source" => "path",
                        "name" => "template_id",
                        "param" => "template_id",
                        "required" => true,
                        "description" => "Id of the template to be retrieved."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-a-template-in-tenant.md"
            ],
            [
                "slug" => "courier_tenants_get_template_list_by_tenant",
                "operation" => "tenants_getTemplateListByTenant",
                "class" => "CourierTenantsGetTemplateListByTenant",
                "method" => "GET",
                "path" => "/tenants/{tenant_id}/templates",
                "type" => "read",
                "name" => "List Templates in Tenant",
                "description" => "List Templates in Tenant.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "Id of the tenant for which to retrieve the templates."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The number of templates to return (defaults to 20, maximum value of 100)."
                    ],
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "Continue the pagination with the next cursor."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/list-templates-in-tenant.md"
            ],
            [
                "slug" => "courier_tenants_get_template_version",
                "operation" => "tenants_getTemplateVersion",
                "class" => "CourierTenantsGetTemplateVersion",
                "method" => "GET",
                "path" => "/tenants/{tenant_id}/templates/{template_id}/versions/{version}",
                "type" => "read",
                "name" => "Get a Specific Template Version",
                "description" => "Fetches a specific version of a tenant template.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "Id of the tenant for which to retrieve the template."
                    ],
                    [
                        "source" => "path",
                        "name" => "template_id",
                        "param" => "template_id",
                        "required" => true,
                        "description" => "Id of the template to be retrieved."
                    ],
                    [
                        "source" => "path",
                        "name" => "version",
                        "param" => "version",
                        "required" => true,
                        "description" => "Version of the template to retrieve."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-a-specific-template-version.md"
            ],
            [
                "slug" => "courier_tenants_get_users_by_tenant",
                "operation" => "tenants_getUsersByTenant",
                "class" => "CourierTenantsGetUsersByTenant",
                "method" => "GET",
                "path" => "/tenants/{tenant_id}/users",
                "type" => "read",
                "name" => "Get Users in Tenant",
                "description" => "Get Users in Tenant.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "Id of the tenant for user membership."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The number of accounts to return (defaults to 20, maximum value of 100)."
                    ],
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "Continue the pagination with the next cursor."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-users-in-tenant.md"
            ],
            [
                "slug" => "courier_tenants_list",
                "operation" => "tenants_list",
                "class" => "CourierTenantsList",
                "method" => "GET",
                "path" => "/tenants",
                "type" => "read",
                "name" => "Get a List of Tenants",
                "description" => "Get a List of Tenants.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "parent_tenant_id",
                        "param" => "parent_tenant_id",
                        "required" => false,
                        "description" => "Filter the list of tenants by parent_id."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The number of tenants to return (defaults to 20, maximum value of 100)."
                    ],
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "Continue the pagination with the next cursor."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-a-list-of-tenants.md"
            ],
            [
                "slug" => "courier_tenants_publish_template",
                "operation" => "tenants_publishTemplate",
                "class" => "CourierTenantsPublishTemplate",
                "method" => "POST",
                "path" => "/tenants/{tenant_id}/templates/{template_id}/publish",
                "type" => "write",
                "name" => "Publish a Tenant Template",
                "description" => "Publishes a specific version of a notification template for a tenant.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "Id of the tenant that owns the template."
                    ],
                    [
                        "source" => "path",
                        "name" => "template_id",
                        "param" => "template_id",
                        "required" => true,
                        "description" => "Id of the template to be published."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/publish-a-tenant-template.md"
            ],
            [
                "slug" => "courier_tenants_remove_default_preferences_for_topic",
                "operation" => "tenants_removeDefaultPreferencesForTopic",
                "class" => "CourierTenantsRemoveDefaultPreferencesForTopic",
                "method" => "DELETE",
                "path" => "/tenants/{tenant_id}/default_preferences/items/{topic_id}",
                "type" => "write",
                "name" => "Remove Default Preferences For Topic",
                "description" => "Remove Default Preferences For Topic.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "Id of the tenant to update the default preferences for."
                    ],
                    [
                        "source" => "path",
                        "name" => "topic_id",
                        "param" => "topic_id",
                        "required" => true,
                        "description" => "Id of the subscription topic you want to have a default preference for."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/remove-default-preferences-for-topic.md"
            ],
            [
                "slug" => "courier_tenants_replace_template",
                "operation" => "tenants_replaceTemplate",
                "class" => "CourierTenantsReplaceTemplate",
                "method" => "PUT",
                "path" => "/tenants/{tenant_id}/templates/{template_id}",
                "type" => "write",
                "name" => "Create or Update a Tenant Template",
                "description" => "Creates or updates a notification template for a tenant.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "Id of the tenant for which to create or update the template."
                    ],
                    [
                        "source" => "path",
                        "name" => "template_id",
                        "param" => "template_id",
                        "required" => true,
                        "description" => "Id of the template to be created or updated."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/create-or-update-a-tenant-template.md"
            ],
            [
                "slug" => "courier_translations_get",
                "operation" => "translations_get",
                "class" => "CourierTranslationsGet",
                "method" => "GET",
                "path" => "/translations/{domain}/{locale}",
                "type" => "read",
                "name" => "Get a translation",
                "description" => "Get translations by locale.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "domain",
                        "param" => "domain",
                        "required" => true,
                        "description" => "The domain you want to retrieve translations for."
                    ],
                    [
                        "source" => "path",
                        "name" => "locale",
                        "param" => "locale",
                        "required" => true,
                        "description" => "The locale you want to retrieve the translations for."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-a-translation.md"
            ],
            [
                "slug" => "courier_translations_update",
                "operation" => "translations_update",
                "class" => "CourierTranslationsUpdate",
                "method" => "PUT",
                "path" => "/translations/{domain}/{locale}",
                "type" => "write",
                "name" => "Update translations by locale",
                "description" => "Update a translation.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "domain",
                        "param" => "domain",
                        "required" => true,
                        "description" => "The domain you want to retrieve translations for."
                    ],
                    [
                        "source" => "path",
                        "name" => "locale",
                        "param" => "locale",
                        "required" => true,
                        "description" => "The locale you want to retrieve the translations for."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/update-translations-by-locale.md"
            ],
            [
                "slug" => "courier_users_preferences_get",
                "operation" => "users_preferences_get",
                "class" => "CourierUsersPreferencesGet",
                "method" => "GET",
                "path" => "/users/{user_id}/preferences/{topic_id}",
                "type" => "read",
                "name" => "Get user subscription topic",
                "description" => "Fetch user preferences for a specific subscription topic.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier associated with the user whose preferences you wish to retrieve."
                    ],
                    [
                        "source" => "path",
                        "name" => "topic_id",
                        "param" => "topic_id",
                        "required" => true,
                        "description" => "A unique identifier associated with a subscription topic."
                    ],
                    [
                        "source" => "query",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => false,
                        "description" => "Query the preferences of a user for this specific tenant context."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-user-subscription-topic.md"
            ],
            [
                "slug" => "courier_users_preferences_list",
                "operation" => "users_preferences_list",
                "class" => "CourierUsersPreferencesList",
                "method" => "GET",
                "path" => "/users/{user_id}/preferences",
                "type" => "read",
                "name" => "Get user's preferences",
                "description" => "Fetch all user preferences.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier associated with the user whose preferences you wish to retrieve."
                    ],
                    [
                        "source" => "query",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => false,
                        "description" => "Query the preferences of a user for this specific tenant context."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-users-preferences.md"
            ],
            [
                "slug" => "courier_users_preferences_update",
                "operation" => "users_preferences_update",
                "class" => "CourierUsersPreferencesUpdate",
                "method" => "PUT",
                "path" => "/users/{user_id}/preferences/{topic_id}",
                "type" => "write",
                "name" => "Update or Create user preferences for a specific subscription topic",
                "description" => "Update or Create user preferences for a specific subscription topic.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "A unique identifier associated with the user whose preferences you wish to retrieve."
                    ],
                    [
                        "source" => "path",
                        "name" => "topic_id",
                        "param" => "topic_id",
                        "required" => true,
                        "description" => "A unique identifier associated with a subscription topic."
                    ],
                    [
                        "source" => "query",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => false,
                        "description" => "Update the preferences of a user for this specific tenant context."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "topic"
                ],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/update-or-create-user-preferences-for-a-specific-subscription-topic.md"
            ],
            [
                "slug" => "courier_users_tenants_add",
                "operation" => "users_tenants_add",
                "class" => "CourierUsersTenantsAdd",
                "method" => "PUT",
                "path" => "/users/{user_id}/tenants/{tenant_id}",
                "type" => "write",
                "name" => "Add a User to a Single Tenant",
                "description" => "This endpoint is used to add a single tenant.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "Id of the user to be added to the supplied tenant."
                    ],
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "Id of the tenant the user should be added to."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/add-a-user-to-a-single-tenant.md"
            ],
            [
                "slug" => "courier_users_tenants_add_multiple",
                "operation" => "users_tenants_addMultiple",
                "class" => "CourierUsersTenantsAddMultiple",
                "method" => "PUT",
                "path" => "/users/{user_id}/tenants",
                "type" => "write",
                "name" => "Add a User to Multiple Tenants",
                "description" => "This endpoint is used to add a user to multiple tenants in one call.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "The user's ID."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "tenants"
                ],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/add-a-user-to-multiple-tenants.md"
            ],
            [
                "slug" => "courier_users_tenants_list",
                "operation" => "users_tenants_list",
                "class" => "CourierUsersTenantsList",
                "method" => "GET",
                "path" => "/users/{user_id}/tenants",
                "type" => "read",
                "name" => "Get tenants associated with a given user",
                "description" => "Returns a paginated list of user tenant associations.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "Id of the user to retrieve all associated tenants for."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The number of accounts to return (defaults to 20, maximum value of 100)."
                    ],
                    [
                        "source" => "query",
                        "name" => "cursor",
                        "param" => "cursor",
                        "required" => false,
                        "description" => "Continue the pagination with the next cursor."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-tenants-associated-with-a-given-user.md"
            ],
            [
                "slug" => "courier_users_tenants_remove",
                "operation" => "users_tenants_remove",
                "class" => "CourierUsersTenantsRemove",
                "method" => "DELETE",
                "path" => "/users/{user_id}/tenants/{tenant_id}",
                "type" => "write",
                "name" => "Remove User from a Tenant",
                "description" => "Removes a user from the supplied tenant.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "Id of the user to be removed from the supplied tenant."
                    ],
                    [
                        "source" => "path",
                        "name" => "tenant_id",
                        "param" => "tenant_id",
                        "required" => true,
                        "description" => "Id of the tenant the user should be removed from."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/remove-user-from-a-tenant.md"
            ],
            [
                "slug" => "courier_users_tenants_remove_all",
                "operation" => "users_tenants_removeAll",
                "class" => "CourierUsersTenantsRemoveAll",
                "method" => "DELETE",
                "path" => "/users/{user_id}/tenants",
                "type" => "write",
                "name" => "Remove User From All Associated Tenants",
                "description" => "Removes a user from any tenants they may have been associated with.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "Id of the user to be removed from the supplied tenant."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/remove-user-from-all-associated-tenants.md"
            ],
            [
                "slug" => "courier_users_tokens_add",
                "operation" => "users_tokens_add",
                "class" => "CourierUsersTokensAdd",
                "method" => "PUT",
                "path" => "/users/{user_id}/tokens/{token}",
                "type" => "write",
                "name" => "Add single token to user",
                "description" => "Adds a single token to a user and overwrites a matching existing token.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "The user's ID."
                    ],
                    [
                        "source" => "path",
                        "name" => "token",
                        "param" => "token",
                        "required" => true,
                        "description" => "The full token string."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/add-single-token-to-user.md"
            ],
            [
                "slug" => "courier_users_tokens_add_multiple",
                "operation" => "users_tokens_addMultiple",
                "class" => "CourierUsersTokensAddMultiple",
                "method" => "PUT",
                "path" => "/users/{user_id}/tokens",
                "type" => "write",
                "name" => "Add multiple tokens to user",
                "description" => "Adds multiple tokens to a user and overwrites matching existing tokens.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "The user's ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/add-multiple-tokens-to-user.md"
            ],
            [
                "slug" => "courier_users_tokens_delete",
                "operation" => "users_tokens_delete",
                "class" => "CourierUsersTokensDelete",
                "method" => "DELETE",
                "path" => "/users/{user_id}/tokens/{token}",
                "type" => "write",
                "name" => "Delete User Token",
                "description" => "Delete User Token.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "The user's ID."
                    ],
                    [
                        "source" => "path",
                        "name" => "token",
                        "param" => "token",
                        "required" => true,
                        "description" => "The full token string."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/delete-user-token.md"
            ],
            [
                "slug" => "courier_users_tokens_get",
                "operation" => "users_tokens_get",
                "class" => "CourierUsersTokensGet",
                "method" => "GET",
                "path" => "/users/{user_id}/tokens/{token}",
                "type" => "read",
                "name" => "Get single token",
                "description" => "Get single token available for a :token.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "The user's ID."
                    ],
                    [
                        "source" => "path",
                        "name" => "token",
                        "param" => "token",
                        "required" => true,
                        "description" => "The full token string."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-single-token.md"
            ],
            [
                "slug" => "courier_users_tokens_list",
                "operation" => "users_tokens_list",
                "class" => "CourierUsersTokensList",
                "method" => "GET",
                "path" => "/users/{user_id}/tokens",
                "type" => "read",
                "name" => "Get all tokens",
                "description" => "Gets all tokens available for a :user_id.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "The user's ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null,
                "source_url" => "https://www.courier.com/docs/api-reference/get-all-tokens.md"
            ],
            [
                "slug" => "courier_users_tokens_update",
                "operation" => "users_tokens_update",
                "class" => "CourierUsersTokensUpdate",
                "method" => "PATCH",
                "path" => "/users/{user_id}/tokens/{token}",
                "type" => "write",
                "name" => "Update a token",
                "description" => "Apply a JSON Patch (RFC 6902) to the specified token.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "user_id",
                        "param" => "user_id",
                        "required" => true,
                        "description" => "The user's ID."
                    ],
                    [
                        "source" => "path",
                        "name" => "token",
                        "param" => "token",
                        "required" => true,
                        "description" => "The full token string."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json",
                "source_url" => "https://www.courier.com/docs/api-reference/update-a-token.md"
            ]
        ];
    }
}
