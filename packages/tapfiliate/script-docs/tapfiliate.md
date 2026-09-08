# Tapfiliate Ruby Reference

This integration targets Tapfiliate REST API v1.6 and authenticates with `X-Api-Key`. Use it for affiliate operations, conversion tracking, commission reconciliation, customer attribution, and program configuration lookups.

## Affiliates

```ruby
affiliates = app.integrations.tapfiliate.list_affiliates(email: "partner@example.test", referral_code: "PARTNER", limit: 50, page: 1)
affiliate = app.integrations.tapfiliate.get_affiliate(id: "aff_123")
```
Create and update affiliates:

```ruby
created = app.integrations.tapfiliate.create_affiliate(firstname: "Ada", lastname: "Lovelace", email: "ada@example.test", company: {name: "Example Partners"}, custom_fields: {channel: "newsletter"})
updated = app.integrations.tapfiliate.update_affiliate(affiliate_id: "aff_123", firstname: "Ada", custom_fields: {tier: "gold"})
```
Group and notes tools:

```ruby
app.integrations.tapfiliate.set_affiliate_group(affiliate_id: "aff_123", group_id: "group_1")
notes = app.integrations.tapfiliate.list_affiliate_notes(affiliate_id: "aff_123")
groups = app.integrations.tapfiliate.list_affiliate_groups()
```
## Conversions

List and retrieve conversions:

```ruby
conversions = app.integrations.tapfiliate.list_conversions(affiliate_id: "aff_123", program_id: "prog_1", status: "approved", date_from: "2026-01-01", date_to: "2026-01-31")
conversion = app.integrations.tapfiliate.get_conversion(conversion_id: "12345")
```
Create conversions by known affiliate, referral code, click/tracking id, coupon, or customer id:

```ruby
conversion = app.integrations.tapfiliate.create_conversion(external_id: "order_1001", amount: 149.99, currency: "USD", referral_code: "PARTNER", program_id: "prog_1", meta_data: {plan: "Pro"})
```
Add a commission line:

```ruby
commission = app.integrations.tapfiliate.add_conversion_commission(conversion_id: "12345", conversion_sub_amount: 49.99, commission_type: "default", comment: "Expansion revenue")
```
## Commissions

```ruby
commissions = app.integrations.tapfiliate.list_commissions(affiliate_id: "aff_123", status: "approved", date_from: "2026-01-01")
commission = app.integrations.tapfiliate.get_commission(commission_id: "98765")
```
## Customers

```ruby
customers = app.integrations.tapfiliate.list_customers(program_id: "prog_1", affiliate_id: "aff_123")
customer = app.integrations.tapfiliate.create_customer(customer_id: "cust_1001", referral_code: "PARTNER", program_id: "prog_1", meta_data: {email: "buyer@example.test"})
```
## Programs

```ruby
programs = app.integrations.tapfiliate.list_programs()
enrollment = app.integrations.tapfiliate.get_program_affiliate(program_id: "prog_1", affiliate_id: "aff_123")
app.integrations.tapfiliate.update_program_affiliate(program_id: "prog_1", affiliate_id: "aff_123", coupon: "PARTNER10")
types = app.integrations.tapfiliate.list_program_commission_types(program_id: "prog_1")
```
## Account Check

```ruby
user = app.integrations.tapfiliate.get_current_user()
```
## Multi-Account Usage

```ruby
app.integrations.tapfiliate.list_affiliates()
app.integrations.tapfiliate.default.list_affiliates()
app.integrations.tapfiliate.partner.list_affiliates()
```