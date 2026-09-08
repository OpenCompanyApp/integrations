# Lemlist — Ruby API Reference

## list_campaigns

List all outreach campaigns in Lemlist.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `"active"`, `"draft"`, `"paused"`, `"completed"` |
| `limit` | integer | no | Maximum number of campaigns to return |
| `offset` | integer | no | Number of campaigns to skip for pagination |

### Examples

```ruby
# List all campaigns
result = app.integrations.lemlist.campaigns()
result.each do |campaign|
  puts((campaign.name).to_s + " (" + (campaign._id).to_s + ") - " + (campaign.status).to_s)
end
# Filter active campaigns
result = app.integrations.lemlist.campaigns(status: "active")
```
---

## get_campaign

Get details of a specific campaign by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to retrieve |

### Examples

```ruby
result = app.integrations.lemlist.get_campaign(campaign_id: "cam_abc123")
puts("Campaign: " + (result.name).to_s)
puts("Status: " + (result.status).to_s)
puts("Leads count: " + (result.leadsCount).to_s)
```
---

## list_leads

List leads in a specific campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign |
| `status` | string | no | Filter by lead status: `"interested"`, `"notInterested"`, `"bounced"`, `"sent"`, `"replied"`, `"autoreplied"`, `"clicked"`, `"opened"` |
| `limit` | integer | no | Maximum number of leads to return |
| `offset` | integer | no | Number of leads to skip for pagination |

### Examples

```ruby
# List all leads in a campaign
result = app.integrations.lemlist.leads(campaign_id: "cam_abc123")
result.each do |lead|
  puts((lead.email).to_s + " - " + (lead.status).to_s)
end
# Filter leads who replied
result = app.integrations.lemlist.leads(campaign_id: "cam_abc123", status: "replied")
```
---

## add_lead

Add a lead to a campaign. The lead will be queued for outreach according to the campaign schedule.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The ID of the campaign to add the lead to |
| `email` | string | yes | The lead's email address |
| `firstName` | string | no | The lead's first name |
| `lastName` | string | no | The lead's last name |
| `companyName` | string | no | The lead's company name |
| `phone` | string | no | The lead's phone number |
| `linkedinUrl` | string | no | The lead's LinkedIn profile URL |
| `variables` | object | no | Custom variables for campaign templates (key-value pairs) |

### Examples

```ruby
# Add a simple lead
result = app.integrations.lemlist.add_lead(campaign_id: "cam_abc123", email: "john@example.com")
# Add a lead with full details
result = app.integrations.lemlist.add_lead(campaign_id: "cam_abc123", email: "jane@acme.com", first_name: "Jane", last_name: "Smith", company_name: "Acme Inc", phone: "+1234567890")
# Add a lead with custom variables for personalization
result = app.integrations.lemlist.add_lead(campaign_id: "cam_abc123", email: "bob@startup.io", first_name: "Bob", variables: {industry: "SaaS", meeting_link: "https://cal.com/bob/30min"})
```
---

## list_teams

List all teams in the Lemlist account.

### Parameters

None.

### Examples

```ruby
result = app.integrations.lemlist.teams()
result.each do |team|
  puts((team.name).to_s + " - " + (team.members.length).to_s + " members")
end
```
---

## list_subaccounts

List all sub-accounts in the Lemlist account.

### Parameters

None.

### Examples

```ruby
result = app.integrations.lemlist.subaccounts()
result.each do |sub|
  puts((sub.name).to_s + " - " + (sub.status).to_s)
end
```
---

## get_current_user

Get the profile of the currently authenticated Lemlist user.

### Parameters

None.

### Examples

```ruby
result = app.integrations.lemlist.get_current_user()
puts("Logged in as: " + (result.email).to_s)
puts("Plan: " + (result.plan).to_s)
puts("Team: " + (result.teamName).to_s)
```
---

## Multi-Account Usage

If you have multiple Lemlist accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
