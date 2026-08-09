# Dub Integration

Namespace: `app.integrations.dub`.

This integration follows the official Dub API surface exposed by the official PHP SDK. Use top-level snake_case arguments for path parameters, `query` for query-string filters, and `payload` for JSON request bodies.

### dub_analytics_retrieve
Retrieve analytics for a link, a domain, or the authenticated workspace.

- Method/path: `GET /analytics`
- Parameters: none
- Query: `query` object
- Body: none

### dub_bounties_approve_submission
Approve a bounty submission

- Method/path: `POST /bounties/{bountyId}/submissions/{submissionId}/approve`
- Parameters: `bounty_id`, `submission_id`
- Query: `query` object
- Body: `payload` object

### dub_bounties_list_submissions
List bounty submissions

- Method/path: `GET /bounties/{bountyId}/submissions`
- Parameters: `bounty_id`
- Query: `query` object
- Body: none

### dub_bounties_reject_submission
Reject a bounty submission

- Method/path: `POST /bounties/{bountyId}/submissions/{submissionId}/reject`
- Parameters: `bounty_id`, `submission_id`
- Query: `query` object
- Body: `payload` object

### dub_commissions_list
List all commissions

- Method/path: `GET /commissions`
- Parameters: none
- Query: `query` object
- Body: none

### dub_commissions_update
Update a commission

- Method/path: `PATCH /commissions/{id}`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object

### dub_commissions_update_many
Bulk update commissions

- Method/path: `PATCH /commissions/bulk`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_customers_delete
Delete a customer

- Method/path: `DELETE /customers/{id}`
- Parameters: `id`
- Query: `query` object
- Body: none

### dub_customers_get
Retrieve a customer

- Method/path: `GET /customers/{id}`
- Parameters: `id`
- Query: `query` object
- Body: none

### dub_customers_list
List all customers

- Method/path: `GET /customers`
- Parameters: none
- Query: `query` object
- Body: none

### dub_customers_update
Update a customer

- Method/path: `PATCH /customers/{id}`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object

### dub_domains_check_status
Check the availability of one or more domains

- Method/path: `GET /domains/status`
- Parameters: none
- Query: `query` object
- Body: none

### dub_domains_create
Create a domain

- Method/path: `POST /domains`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_domains_delete
Delete a domain

- Method/path: `DELETE /domains/{slug}`
- Parameters: `slug`
- Query: `query` object
- Body: none

### dub_domains_list
List all domains

- Method/path: `GET /domains`
- Parameters: none
- Query: `query` object
- Body: none

### dub_domains_register
Register a domain

- Method/path: `POST /domains/register`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_domains_update
Update a domain

- Method/path: `PATCH /domains/{slug}`
- Parameters: `slug`
- Query: `query` object
- Body: `payload` object

### dub_embed_tokens_referrals
Create a referrals embed token

- Method/path: `POST /tokens/embed/referrals`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_events_list
List all events

- Method/path: `GET /events`
- Parameters: none
- Query: `query` object
- Body: none

### dub_folders_create
Create a folder

- Method/path: `POST /folders`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_folders_delete
Delete a folder

- Method/path: `DELETE /folders/{id}`
- Parameters: `id`
- Query: `query` object
- Body: none

### dub_folders_list
List all folders

- Method/path: `GET /folders`
- Parameters: none
- Query: `query` object
- Body: none

### dub_folders_update
Update a folder

- Method/path: `PATCH /folders/{id}`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object

### dub_links_count
Retrieve links count

- Method/path: `GET /links/count`
- Parameters: none
- Query: `query` object
- Body: none

### dub_links_create
Create a link

- Method/path: `POST /links`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_links_create_many
Bulk create links

- Method/path: `POST /links/bulk`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_links_delete
Delete a link

- Method/path: `DELETE /links/{linkId}`
- Parameters: `link_id`
- Query: `query` object
- Body: none

### dub_links_delete_many
Bulk delete links

- Method/path: `DELETE /links/bulk`
- Parameters: none
- Query: `query` object
- Body: none

### dub_links_get
Retrieve a link

- Method/path: `GET /links/info`
- Parameters: none
- Query: `query` object
- Body: none

### dub_links_list
List all links

- Method/path: `GET /links`
- Parameters: none
- Query: `query` object
- Body: none

### dub_links_update
Update a link

- Method/path: `PATCH /links/{linkId}`
- Parameters: `link_id`
- Query: `query` object
- Body: `payload` object

### dub_links_update_many
Bulk update links

- Method/path: `PATCH /links/bulk`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_links_upsert
Upsert a link

- Method/path: `PUT /links/upsert`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_partner_applications_approve
Approve a partner application

- Method/path: `POST /partners/applications/approve`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_partner_applications_list
List all pending partner applications

- Method/path: `GET /partners/applications`
- Parameters: none
- Query: `query` object
- Body: none

### dub_partner_applications_reject
Reject a partner application

- Method/path: `POST /partners/applications/reject`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_partners_analytics
Retrieve analytics for a partner

- Method/path: `GET /partners/analytics`
- Parameters: none
- Query: `query` object
- Body: none

### dub_partners_ban
Ban a partner

- Method/path: `POST /partners/ban`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_partners_create
Create or update a partner

- Method/path: `POST /partners`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_partners_create_link
Create a link for a partner

- Method/path: `POST /partners/links`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_partners_deactivate
Deactivate a partner

- Method/path: `POST /partners/deactivate`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_partners_list
List all partners

- Method/path: `GET /partners`
- Parameters: none
- Query: `query` object
- Body: none

### dub_partners_retrieve_links
Retrieve a partner's links.

- Method/path: `GET /partners/links`
- Parameters: none
- Query: `query` object
- Body: none

### dub_partners_upsert_link
Upsert a link for a partner

- Method/path: `PUT /partners/links/upsert`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_payouts_list
List all payouts

- Method/path: `GET /payouts`
- Parameters: none
- Query: `query` object
- Body: none

### dub_qr_codes_get
Retrieve a QR code

- Method/path: `GET /qr`
- Parameters: none
- Query: `query` object
- Body: none

### dub_tags_create
Create a tag

- Method/path: `POST /tags`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_tags_delete
Delete a tag

- Method/path: `DELETE /tags/{id}`
- Parameters: `id`
- Query: `query` object
- Body: none

### dub_tags_list
List all tags

- Method/path: `GET /tags`
- Parameters: none
- Query: `query` object
- Body: none

### dub_tags_update
Update a tag

- Method/path: `PATCH /tags/{id}`
- Parameters: `id`
- Query: `query` object
- Body: `payload` object

### dub_track_lead
Track a lead

- Method/path: `POST /track/lead`
- Parameters: none
- Query: `query` object
- Body: `payload` object

### dub_track_sale
Track a sale

- Method/path: `POST /track/sale`
- Parameters: none
- Query: `query` object
- Body: `payload` object

## Examples

```js
var links = app.integrations.dub.links_list({ query: { pageSize: 10 } })
var created = app.integrations.dub.links_create({ payload: { url: 'https://example.test' } })
```