<?php

namespace OpenCompany\Integrations\Dub;

/**
 * Official Dub API operation metadata.
 *
 * Generated from the official dubinc/dub-php SDK resource surface.
 */
class DubOperations
{
    /**
     * Return Dub API operations keyed by tool slug.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            [
                "slug" => "dub_analytics_retrieve",
                "operation" => "analytics_retrieve",
                "resource" => "Analytics",
                "method_name" => "retrieve",
                "class" => "DubAnalyticsRetrieve",
                "method" => "GET",
                "path" => "/analytics",
                "type" => "read",
                "name" => "Analytics Retrieve",
                "description" => "Retrieve analytics for a link, a domain, or the authenticated workspace.",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_bounties_approve_submission",
                "operation" => "bounties_approve_submission",
                "resource" => "Bounties",
                "method_name" => "approveSubmission",
                "class" => "DubBountiesApproveSubmission",
                "method" => "POST",
                "path" => "/bounties/{bountyId}/submissions/{submissionId}/approve",
                "type" => "write",
                "name" => "Bounties Approve Submission",
                "description" => "Approve a bounty submission",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "bountyId",
                        "param" => "bounty_id",
                        "required" => true,
                        "description" => "Bounty Id path parameter."
                    ],
                    [
                        "source" => "path",
                        "name" => "submissionId",
                        "param" => "submission_id",
                        "required" => true,
                        "description" => "Submission Id path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_bounties_list_submissions",
                "operation" => "bounties_list_submissions",
                "resource" => "Bounties",
                "method_name" => "listSubmissions",
                "class" => "DubBountiesListSubmissions",
                "method" => "GET",
                "path" => "/bounties/{bountyId}/submissions",
                "type" => "read",
                "name" => "Bounties List Submissions",
                "description" => "List bounty submissions",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "bountyId",
                        "param" => "bounty_id",
                        "required" => true,
                        "description" => "Bounty Id path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_bounties_reject_submission",
                "operation" => "bounties_reject_submission",
                "resource" => "Bounties",
                "method_name" => "rejectSubmission",
                "class" => "DubBountiesRejectSubmission",
                "method" => "POST",
                "path" => "/bounties/{bountyId}/submissions/{submissionId}/reject",
                "type" => "write",
                "name" => "Bounties Reject Submission",
                "description" => "Reject a bounty submission",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "bountyId",
                        "param" => "bounty_id",
                        "required" => true,
                        "description" => "Bounty Id path parameter."
                    ],
                    [
                        "source" => "path",
                        "name" => "submissionId",
                        "param" => "submission_id",
                        "required" => true,
                        "description" => "Submission Id path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_commissions_list",
                "operation" => "commissions_list",
                "resource" => "Commissions",
                "method_name" => "list",
                "class" => "DubCommissionsList",
                "method" => "GET",
                "path" => "/commissions",
                "type" => "read",
                "name" => "Commissions List",
                "description" => "List all commissions",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_commissions_update",
                "operation" => "commissions_update",
                "resource" => "Commissions",
                "method_name" => "update",
                "class" => "DubCommissionsUpdate",
                "method" => "PATCH",
                "path" => "/commissions/{id}",
                "type" => "write",
                "name" => "Commissions Update",
                "description" => "Update a commission",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Id path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_commissions_update_many",
                "operation" => "commissions_update_many",
                "resource" => "Commissions",
                "method_name" => "updateMany",
                "class" => "DubCommissionsUpdateMany",
                "method" => "PATCH",
                "path" => "/commissions/bulk",
                "type" => "write",
                "name" => "Commissions Update Many",
                "description" => "Bulk update commissions",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_customers_delete",
                "operation" => "customers_delete",
                "resource" => "Customers",
                "method_name" => "delete",
                "class" => "DubCustomersDelete",
                "method" => "DELETE",
                "path" => "/customers/{id}",
                "type" => "write",
                "name" => "Customers Delete",
                "description" => "Delete a customer",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Id path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_customers_get",
                "operation" => "customers_get",
                "resource" => "Customers",
                "method_name" => "get",
                "class" => "DubCustomersGet",
                "method" => "GET",
                "path" => "/customers/{id}",
                "type" => "read",
                "name" => "Customers Get",
                "description" => "Retrieve a customer",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Id path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_customers_list",
                "operation" => "customers_list",
                "resource" => "Customers",
                "method_name" => "list",
                "class" => "DubCustomersList",
                "method" => "GET",
                "path" => "/customers",
                "type" => "read",
                "name" => "Customers List",
                "description" => "List all customers",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_customers_update",
                "operation" => "customers_update",
                "resource" => "Customers",
                "method_name" => "update",
                "class" => "DubCustomersUpdate",
                "method" => "PATCH",
                "path" => "/customers/{id}",
                "type" => "write",
                "name" => "Customers Update",
                "description" => "Update a customer",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Id path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_domains_check_status",
                "operation" => "domains_check_status",
                "resource" => "Domains",
                "method_name" => "checkStatus",
                "class" => "DubDomainsCheckStatus",
                "method" => "GET",
                "path" => "/domains/status",
                "type" => "read",
                "name" => "Domains Check Status",
                "description" => "Check the availability of one or more domains",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_domains_create",
                "operation" => "domains_create",
                "resource" => "Domains",
                "method_name" => "create",
                "class" => "DubDomainsCreate",
                "method" => "POST",
                "path" => "/domains",
                "type" => "write",
                "name" => "Domains Create",
                "description" => "Create a domain",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_domains_delete",
                "operation" => "domains_delete",
                "resource" => "Domains",
                "method_name" => "delete",
                "class" => "DubDomainsDelete",
                "method" => "DELETE",
                "path" => "/domains/{slug}",
                "type" => "write",
                "name" => "Domains Delete",
                "description" => "Delete a domain",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "slug",
                        "param" => "slug",
                        "required" => true,
                        "description" => "Slug path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_domains_list",
                "operation" => "domains_list",
                "resource" => "Domains",
                "method_name" => "list",
                "class" => "DubDomainsList",
                "method" => "GET",
                "path" => "/domains",
                "type" => "read",
                "name" => "Domains List",
                "description" => "List all domains",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_domains_register",
                "operation" => "domains_register",
                "resource" => "Domains",
                "method_name" => "register",
                "class" => "DubDomainsRegister",
                "method" => "POST",
                "path" => "/domains/register",
                "type" => "write",
                "name" => "Domains Register",
                "description" => "Register a domain",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_domains_update",
                "operation" => "domains_update",
                "resource" => "Domains",
                "method_name" => "update",
                "class" => "DubDomainsUpdate",
                "method" => "PATCH",
                "path" => "/domains/{slug}",
                "type" => "write",
                "name" => "Domains Update",
                "description" => "Update a domain",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "slug",
                        "param" => "slug",
                        "required" => true,
                        "description" => "Slug path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_embed_tokens_referrals",
                "operation" => "embed_tokens_referrals",
                "resource" => "EmbedTokens",
                "method_name" => "referrals",
                "class" => "DubEmbedTokensReferrals",
                "method" => "POST",
                "path" => "/tokens/embed/referrals",
                "type" => "write",
                "name" => "Embed Tokens Referrals",
                "description" => "Create a referrals embed token",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_events_list",
                "operation" => "events_list",
                "resource" => "Events",
                "method_name" => "list",
                "class" => "DubEventsList",
                "method" => "GET",
                "path" => "/events",
                "type" => "read",
                "name" => "Events List",
                "description" => "List all events",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_folders_create",
                "operation" => "folders_create",
                "resource" => "Folders",
                "method_name" => "create",
                "class" => "DubFoldersCreate",
                "method" => "POST",
                "path" => "/folders",
                "type" => "write",
                "name" => "Folders Create",
                "description" => "Create a folder",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_folders_delete",
                "operation" => "folders_delete",
                "resource" => "Folders",
                "method_name" => "delete",
                "class" => "DubFoldersDelete",
                "method" => "DELETE",
                "path" => "/folders/{id}",
                "type" => "write",
                "name" => "Folders Delete",
                "description" => "Delete a folder",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Id path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_folders_list",
                "operation" => "folders_list",
                "resource" => "Folders",
                "method_name" => "list",
                "class" => "DubFoldersList",
                "method" => "GET",
                "path" => "/folders",
                "type" => "read",
                "name" => "Folders List",
                "description" => "List all folders",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_folders_update",
                "operation" => "folders_update",
                "resource" => "Folders",
                "method_name" => "update",
                "class" => "DubFoldersUpdate",
                "method" => "PATCH",
                "path" => "/folders/{id}",
                "type" => "write",
                "name" => "Folders Update",
                "description" => "Update a folder",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Id path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_links_count",
                "operation" => "links_count",
                "resource" => "Links",
                "method_name" => "count",
                "class" => "DubLinksCount",
                "method" => "GET",
                "path" => "/links/count",
                "type" => "read",
                "name" => "Links Count",
                "description" => "Retrieve links count",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_links_create",
                "operation" => "links_create",
                "resource" => "Links",
                "method_name" => "create",
                "class" => "DubLinksCreate",
                "method" => "POST",
                "path" => "/links",
                "type" => "write",
                "name" => "Links Create",
                "description" => "Create a link",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_links_create_many",
                "operation" => "links_create_many",
                "resource" => "Links",
                "method_name" => "createMany",
                "class" => "DubLinksCreateMany",
                "method" => "POST",
                "path" => "/links/bulk",
                "type" => "write",
                "name" => "Links Create Many",
                "description" => "Bulk create links",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_links_delete",
                "operation" => "links_delete",
                "resource" => "Links",
                "method_name" => "delete",
                "class" => "DubLinksDelete",
                "method" => "DELETE",
                "path" => "/links/{linkId}",
                "type" => "write",
                "name" => "Links Delete",
                "description" => "Delete a link",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "linkId",
                        "param" => "link_id",
                        "required" => true,
                        "description" => "Link Id path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_links_delete_many",
                "operation" => "links_delete_many",
                "resource" => "Links",
                "method_name" => "deleteMany",
                "class" => "DubLinksDeleteMany",
                "method" => "DELETE",
                "path" => "/links/bulk",
                "type" => "write",
                "name" => "Links Delete Many",
                "description" => "Bulk delete links",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_links_get",
                "operation" => "links_get",
                "resource" => "Links",
                "method_name" => "get",
                "class" => "DubLinksGet",
                "method" => "GET",
                "path" => "/links/info",
                "type" => "read",
                "name" => "Links Get",
                "description" => "Retrieve a link",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_links_list",
                "operation" => "links_list",
                "resource" => "Links",
                "method_name" => "list",
                "class" => "DubLinksList",
                "method" => "GET",
                "path" => "/links",
                "type" => "read",
                "name" => "Links List",
                "description" => "List all links",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_links_update",
                "operation" => "links_update",
                "resource" => "Links",
                "method_name" => "update",
                "class" => "DubLinksUpdate",
                "method" => "PATCH",
                "path" => "/links/{linkId}",
                "type" => "write",
                "name" => "Links Update",
                "description" => "Update a link",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "linkId",
                        "param" => "link_id",
                        "required" => true,
                        "description" => "Link Id path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_links_update_many",
                "operation" => "links_update_many",
                "resource" => "Links",
                "method_name" => "updateMany",
                "class" => "DubLinksUpdateMany",
                "method" => "PATCH",
                "path" => "/links/bulk",
                "type" => "write",
                "name" => "Links Update Many",
                "description" => "Bulk update links",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_links_upsert",
                "operation" => "links_upsert",
                "resource" => "Links",
                "method_name" => "upsert",
                "class" => "DubLinksUpsert",
                "method" => "PUT",
                "path" => "/links/upsert",
                "type" => "write",
                "name" => "Links Upsert",
                "description" => "Upsert a link",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_partner_applications_approve",
                "operation" => "partner_applications_approve",
                "resource" => "PartnerApplications",
                "method_name" => "approve",
                "class" => "DubPartnerApplicationsApprove",
                "method" => "POST",
                "path" => "/partners/applications/approve",
                "type" => "write",
                "name" => "Partner Applications Approve",
                "description" => "Approve a partner application",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_partner_applications_list",
                "operation" => "partner_applications_list",
                "resource" => "PartnerApplications",
                "method_name" => "list",
                "class" => "DubPartnerApplicationsList",
                "method" => "GET",
                "path" => "/partners/applications",
                "type" => "read",
                "name" => "Partner Applications List",
                "description" => "List all pending partner applications",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_partner_applications_reject",
                "operation" => "partner_applications_reject",
                "resource" => "PartnerApplications",
                "method_name" => "reject",
                "class" => "DubPartnerApplicationsReject",
                "method" => "POST",
                "path" => "/partners/applications/reject",
                "type" => "write",
                "name" => "Partner Applications Reject",
                "description" => "Reject a partner application",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_partners_analytics",
                "operation" => "partners_analytics",
                "resource" => "Partners",
                "method_name" => "analytics",
                "class" => "DubPartnersAnalytics",
                "method" => "GET",
                "path" => "/partners/analytics",
                "type" => "read",
                "name" => "Partners Analytics",
                "description" => "Retrieve analytics for a partner",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_partners_ban",
                "operation" => "partners_ban",
                "resource" => "Partners",
                "method_name" => "ban",
                "class" => "DubPartnersBan",
                "method" => "POST",
                "path" => "/partners/ban",
                "type" => "write",
                "name" => "Partners Ban",
                "description" => "Ban a partner",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_partners_create",
                "operation" => "partners_create",
                "resource" => "Partners",
                "method_name" => "create",
                "class" => "DubPartnersCreate",
                "method" => "POST",
                "path" => "/partners",
                "type" => "write",
                "name" => "Partners Create",
                "description" => "Create or update a partner",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_partners_create_link",
                "operation" => "partners_create_link",
                "resource" => "Partners",
                "method_name" => "createLink",
                "class" => "DubPartnersCreateLink",
                "method" => "POST",
                "path" => "/partners/links",
                "type" => "write",
                "name" => "Partners Create Link",
                "description" => "Create a link for a partner",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_partners_deactivate",
                "operation" => "partners_deactivate",
                "resource" => "Partners",
                "method_name" => "deactivate",
                "class" => "DubPartnersDeactivate",
                "method" => "POST",
                "path" => "/partners/deactivate",
                "type" => "write",
                "name" => "Partners Deactivate",
                "description" => "Deactivate a partner",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_partners_list",
                "operation" => "partners_list",
                "resource" => "Partners",
                "method_name" => "list",
                "class" => "DubPartnersList",
                "method" => "GET",
                "path" => "/partners",
                "type" => "read",
                "name" => "Partners List",
                "description" => "List all partners",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_partners_retrieve_links",
                "operation" => "partners_retrieve_links",
                "resource" => "Partners",
                "method_name" => "retrieveLinks",
                "class" => "DubPartnersRetrieveLinks",
                "method" => "GET",
                "path" => "/partners/links",
                "type" => "read",
                "name" => "Partners Retrieve Links",
                "description" => "Retrieve a partner's links.",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_partners_upsert_link",
                "operation" => "partners_upsert_link",
                "resource" => "Partners",
                "method_name" => "upsertLink",
                "class" => "DubPartnersUpsertLink",
                "method" => "PUT",
                "path" => "/partners/links/upsert",
                "type" => "write",
                "name" => "Partners Upsert Link",
                "description" => "Upsert a link for a partner",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_payouts_list",
                "operation" => "payouts_list",
                "resource" => "Payouts",
                "method_name" => "list",
                "class" => "DubPayoutsList",
                "method" => "GET",
                "path" => "/payouts",
                "type" => "read",
                "name" => "Payouts List",
                "description" => "List all payouts",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_qr_codes_get",
                "operation" => "qr_codes_get",
                "resource" => "QRCodes",
                "method_name" => "get",
                "class" => "DubQRCodesGet",
                "method" => "GET",
                "path" => "/qr",
                "type" => "read",
                "name" => "QR Codes Get",
                "description" => "Retrieve a QR code",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_tags_create",
                "operation" => "tags_create",
                "resource" => "Tags",
                "method_name" => "create",
                "class" => "DubTagsCreate",
                "method" => "POST",
                "path" => "/tags",
                "type" => "write",
                "name" => "Tags Create",
                "description" => "Create a tag",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_tags_delete",
                "operation" => "tags_delete",
                "resource" => "Tags",
                "method_name" => "delete",
                "class" => "DubTagsDelete",
                "method" => "DELETE",
                "path" => "/tags/{id}",
                "type" => "write",
                "name" => "Tags Delete",
                "description" => "Delete a tag",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Id path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_tags_list",
                "operation" => "tags_list",
                "resource" => "Tags",
                "method_name" => "list",
                "class" => "DubTagsList",
                "method" => "GET",
                "path" => "/tags",
                "type" => "read",
                "name" => "Tags List",
                "description" => "List all tags",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null
            ],
            [
                "slug" => "dub_tags_update",
                "operation" => "tags_update",
                "resource" => "Tags",
                "method_name" => "update",
                "class" => "DubTagsUpdate",
                "method" => "PATCH",
                "path" => "/tags/{id}",
                "type" => "write",
                "name" => "Tags Update",
                "description" => "Update a tag",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "Id path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_track_lead",
                "operation" => "track_lead",
                "resource" => "Track",
                "method_name" => "lead",
                "class" => "DubTrackLead",
                "method" => "POST",
                "path" => "/track/lead",
                "type" => "write",
                "name" => "Track Lead",
                "description" => "Track a lead",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "dub_track_sale",
                "operation" => "track_sale",
                "resource" => "Track",
                "method_name" => "sale",
                "class" => "DubTrackSale",
                "method" => "POST",
                "path" => "/track/sale",
                "type" => "write",
                "name" => "Track Sale",
                "description" => "Track a sale",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json"
            ]
        ];
    }
}
