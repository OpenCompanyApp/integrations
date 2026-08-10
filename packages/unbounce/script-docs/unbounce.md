# Unbounce JavaScript API Reference

Namespace: `app.integrations.unbounce`

Configure an Unbounce OAuth bearer `access_token`. The default API base URL is
`https://api.unbounce.com`.

## Accounts

```js
var accounts = app.integrations.unbounce.list_accounts({})
var account = app.integrations.unbounce.get_account({ account_id: "1456243" })

var sub_accounts = app.integrations.unbounce.list_sub_accounts({
  account_id: "1456243",
  limit: 50,
})

var sub_account = app.integrations.unbounce.get_sub_account({
  sub_account_id: "1552433",
})
```
## Pages

```js
var pages = app.integrations.unbounce.list_pages({
  limit: 20,
  offset: 0,
  sort: "-created_at",
})

var account_pages = app.integrations.unbounce.list_account_pages({
  account_id: "1456243",
  params: { limit: 20 },
})

var page = app.integrations.unbounce.get_page({
  page_id: "a2834fde-1234-5678-abcd-1234567890ab",
})

var fields = app.integrations.unbounce.list_page_form_fields({
  page_id: "a2834fde-1234-5678-abcd-1234567890ab",
})
```
## Leads

```js
var leads = app.integrations.unbounce.list_leads({
  page_id: "a2834fde-1234-5678-abcd-1234567890ab",
  limit: 25,
})

var lead = app.integrations.unbounce.get_lead({
  lead_id: "b3945gef-2345-6789-bcde-2345678901bc",
})

var created = app.integrations.unbounce.create_lead({
  page_id: "a2834fde-1234-5678-abcd-1234567890ab",
  payload: {
    conversion: true,
    visitor_id: "visitor-123",
    form_submission: {
      variant_id: "a",
      submitter_ip: "127.0.0.1",
      form_data: {
        email: "lead@example.test",
        first_name: "Ada",
      }
    }
  }
})
```
Lead deletion requests are asynchronous:

```js
var request = app.integrations.unbounce.create_lead_deletion_request({
  page_id: "a2834fde-1234-5678-abcd-1234567890ab",
  payload: { lead_ids: [ "b3945gef-2345-6789-bcde-2345678901bc" ] },
})

var status = app.integrations.unbounce.get_lead_deletion_request({
  page_id: "a2834fde-1234-5678-abcd-1234567890ab",
  lead_deletion_request_id: request.id,
})
```
## Domains And Page Groups

```js
var domains = app.integrations.unbounce.list_domains({
  sub_account_id: "1552433",
})

var domain_pages = app.integrations.unbounce.list_domain_pages({
  domain_id: "domain-123",
})

var groups = app.integrations.unbounce.list_page_groups({
  sub_account_id: "1552433",
})

var group_pages = app.integrations.unbounce.list_page_group_pages({
  page_group_id: "group-123",
})
```
## Raw API Helpers

Use raw helpers for documented Unbounce endpoints that do not yet have a named
tool. Paths must be relative; full URLs and parent-directory segments are
rejected.

```js
var raw = app.integrations.unbounce.api_get({
  path: "/accounts",
  params: { sort_order: "desc" },
})
```
## Multi-Account Usage

```js
app.integrations.unbounce.list_pages({})
app.integrations.unbounce.client_a.list_pages({})
```