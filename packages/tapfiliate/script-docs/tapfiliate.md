# Tapfiliate JavaScript Reference

This integration targets Tapfiliate REST API v1.6 and authenticates with `X-Api-Key`. Use it for affiliate operations, conversion tracking, commission reconciliation, customer attribution, and program configuration lookups.

## Affiliates

```js
var affiliates = app.integrations.tapfiliate.list_affiliates({
  email: "partner@example.test",
  referral_code: "PARTNER",
  limit: 50,
  page: 1,
})

var affiliate = app.integrations.tapfiliate.get_affiliate({
  id: "aff_123",
})
```
Create and update affiliates:

```js
var created = app.integrations.tapfiliate.create_affiliate({
  firstname: "Ada",
  lastname: "Lovelace",
  email: "ada@example.test",
  company: { name: "Example Partners" },
  custom_fields: { channel: "newsletter" },
})

var updated = app.integrations.tapfiliate.update_affiliate({
  affiliate_id: "aff_123",
  firstname: "Ada",
  custom_fields: { tier: "gold" },
})
```
Group and notes tools:

```js
app.integrations.tapfiliate.set_affiliate_group({
  affiliate_id: "aff_123",
  group_id: "group_1",
})

var notes = app.integrations.tapfiliate.list_affiliate_notes({
  affiliate_id: "aff_123",
})

var groups = app.integrations.tapfiliate.list_affiliate_groups({})
```
## Conversions

List and retrieve conversions:

```js
var conversions = app.integrations.tapfiliate.list_conversions({
  affiliate_id: "aff_123",
  program_id: "prog_1",
  status: "approved",
  date_from: "2026-01-01",
  date_to: "2026-01-31",
})

var conversion = app.integrations.tapfiliate.get_conversion({
  conversion_id: "12345",
})
```
Create conversions by known affiliate, referral code, click/tracking id, coupon, or customer id:

```js
var conversion = app.integrations.tapfiliate.create_conversion({
  external_id: "order_1001",
  amount: 149.99,
  currency: "USD",
  referral_code: "PARTNER",
  program_id: "prog_1",
  meta_data: {
    plan: "Pro",
  }
})
```
Add a commission line:

```js
var commission = app.integrations.tapfiliate.add_conversion_commission({
  conversion_id: "12345",
  conversion_sub_amount: 49.99,
  commission_type: "default",
  comment: "Expansion revenue",
})
```
## Commissions

```js
var commissions = app.integrations.tapfiliate.list_commissions({
  affiliate_id: "aff_123",
  status: "approved",
  date_from: "2026-01-01",
})

var commission = app.integrations.tapfiliate.get_commission({
  commission_id: "98765",
})
```
## Customers

```js
var customers = app.integrations.tapfiliate.list_customers({
  program_id: "prog_1",
  affiliate_id: "aff_123",
})

var customer = app.integrations.tapfiliate.create_customer({
  customer_id: "cust_1001",
  referral_code: "PARTNER",
  program_id: "prog_1",
  meta_data: {
    email: "buyer@example.test",
  }
})
```
## Programs

```js
var programs = app.integrations.tapfiliate.list_programs({})

var enrollment = app.integrations.tapfiliate.get_program_affiliate({
  program_id: "prog_1",
  affiliate_id: "aff_123",
})

app.integrations.tapfiliate.update_program_affiliate({
  program_id: "prog_1",
  affiliate_id: "aff_123",
  coupon: "PARTNER10",
})

var types = app.integrations.tapfiliate.list_program_commission_types({
  program_id: "prog_1",
})
```
## Account Check

```js
var user = app.integrations.tapfiliate.get_current_user({})
```
## Multi-Account Usage

```js
app.integrations.tapfiliate.list_affiliates({})
app.integrations.tapfiliate.default.list_affiliates({})
app.integrations.tapfiliate.partner.list_affiliates({})
```